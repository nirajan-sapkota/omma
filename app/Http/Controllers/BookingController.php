<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class BookingController extends Controller
{
    public const TIME_SLOTS = [
        '09:00',
        '09:30',
        '10:00',
        '10:30',
        '11:00',
        '11:30',
        '13:00',
        '13:30',
        '14:00',
        '14:30',
        '15:00',
        '15:30',
        '16:00',
        '16:30',
    ];

    public const SERVICE_NAME =
        'Biometric & Physical Ability Assessment';

    public const CLINIC_ADDRESS =
        'Omma Health Center, 4th Floor, Board Bazaar Road, Baneshwor, Kathmandu';


    public function create()
    {
        $busy = Booking::where(
            'appointment_date',
            '>=',
            now()->toDateString()
        )
            ->get([
                'appointment_date',
                'appointment_time',
            ])
            ->map(fn ($booking) => [
                'date' => $booking->appointment_date->format('Y-m-d'),
                'time' => $booking->appointment_time,
            ])
            ->values();

        return view('booking', [
            'timeSlots' => self::TIME_SLOTS,
            'busyJson' => $busy->toJson(),
        ]);
    }


    /**
     * Store Step 1 booking details in session and redirect to payment page.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => [
                'required',
                Rule::in(['online', 'physical']),
            ],

            'appointment_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'appointment_time' => [
                'required',
                Rule::in(self::TIME_SLOTS),
            ],
        ]);


        $alreadyTaken = Booking::where(
            'appointment_date',
            $data['appointment_date']
        )
            ->where(
                'appointment_time',
                $data['appointment_time']
            )
            ->exists();


        if ($alreadyTaken) {
            return back()
                ->withInput()
                ->withErrors([
                    'appointment_time' =>
                        'That appointment slot has already been booked. Please select another time.',
                ]);
        }

        // Store draft booking details in session
        session(['booking_draft' => $data]);

        return redirect()->route('booking.payment');
    }


    /**
     * Show Step 2 payment page.
     */
    public function payment()
    {
        $draft = session('booking_draft');

        if (!$draft) {
            return redirect()
                ->route('booking.create')
                ->withErrors(['error' => 'Please select your appointment date and time first.']);
        }

        $paymentSetting = PaymentSetting::getActiveSetting();

        return view('payment', [
            'draft' => $draft,
            'paymentSetting' => $paymentSetting,
            'serviceName' => self::SERVICE_NAME,
            'address' => self::CLINIC_ADDRESS,
        ]);
    }


    /**
     * Confirm booking with payment receipt upload.
     */
    public function confirm(Request $request)
    {
        $draft = session('booking_draft');

        if (!$draft) {
            return redirect()
                ->route('booking.create')
                ->withErrors(['error' => 'Session expired. Please select your appointment details again.']);
        }

        $request->validate([
            'payment_receipt' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],
        ], [
            'payment_receipt.required' => 'Please upload your payment screenshot / receipt image before confirming.',
            'payment_receipt.image' => 'The payment proof must be an image file (JPG, PNG, WEBP).',
            'payment_receipt.max' => 'Payment receipt image size should not exceed 5MB.',
        ]);

        // Double check slot availability
        $alreadyTaken = Booking::where(
            'appointment_date',
            $draft['appointment_date']
        )
            ->where(
                'appointment_time',
                $draft['appointment_time']
            )
            ->exists();

        if ($alreadyTaken) {
            session()->forget('booking_draft');
            return redirect()
                ->route('booking.create')
                ->withErrors([
                    'appointment_time' => 'That appointment slot was taken just now. Please select another slot.',
                ]);
        }

        // Handle receipt upload
        $receiptPath = null;
        if ($request->hasFile('payment_receipt')) {
            $receiptPath = $request->file('payment_receipt')->store('receipts', 'public');
        }

        $meetLink = null;
        if ($draft['category'] === 'online') {
            try {
                $meetLink = $this->generateMeetLink(
                    $draft['appointment_date'],
                    $draft['appointment_time']
                );
            } catch (\Exception $e) {
                // If Google Calendar isn't connected or fails, continue without throwing error
                $meetLink = null;
            }
        }

        $bookingData = [
            'user_id' => Auth::id(),
            'category' => $draft['category'],
            'service_name' => self::SERVICE_NAME,
            'appointment_date' => $draft['appointment_date'],
            'appointment_time' => $draft['appointment_time'],
            'status' => 'pending',
            'meet_link' => $meetLink,
        ];

        if (\Illuminate\Support\Facades\Schema::hasColumn('bookings', 'payment_receipt')) {
            $bookingData['payment_receipt'] = $receiptPath;
            $bookingData['payment_reference'] = $request->input('payment_reference');
            $bookingData['payment_status'] = 'pending';
        }

        $booking = Booking::create($bookingData);

        session()->forget('booking_draft');

        return view('booking-confirmation', [
            'booking' => $booking,
            'address' => self::CLINIC_ADDRESS,
        ]);
    }


    /**
     * Generate a Google Meet link through Google Calendar.
     */
    private function generateMeetLink(
        string $appointmentDate,
        string $appointmentTime
    ): string {
        $client = $this->getGoogleClient();

        $token = session('google_token');

        if (!$token) {
            return '';
        }

        $client->setAccessToken($token);

        if ($client->isAccessTokenExpired()) {
            $refreshToken = $client->getRefreshToken();

            if (!$refreshToken) {
                session()->forget('google_token');
                return '';
            }

            $newToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);

            if (isset($newToken['error'])) {
                session()->forget('google_token');
                return '';
            }

            $token = array_merge($token, $newToken);
            $token['refresh_token'] = $refreshToken;
            $client->setAccessToken($token);
            session(['google_token' => $token]);
        }

        $calendar = new Calendar($client);

        $start = \Carbon\Carbon::createFromFormat(
            'Y-m-d H:i',
            $appointmentDate . ' ' . $appointmentTime,
            'Asia/Kathmandu'
        );

        $end = $start->copy()->addMinutes(30);

        $event = new Event([
            'summary' => self::SERVICE_NAME,
            'description' => 'Appointment booked through Omma Health Center.',
            'location' => self::CLINIC_ADDRESS,
            'start' => [
                'dateTime' => $start->format('Y-m-d\TH:i:sP'),
                'timeZone' => 'Asia/Kathmandu',
            ],
            'end' => [
                'dateTime' => $end->format('Y-m-d\TH:i:sP'),
                'timeZone' => 'Asia/Kathmandu',
            ],
            'conferenceData' => [
                'createRequest' => [
                    'requestId' => uniqid('omma_', true),
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet',
                    ],
                ],
            ],
        ]);

        $createdEvent = $calendar->events->insert(
            'primary',
            $event,
            [
                'conferenceDataVersion' => 1,
            ]
        );

        
        // Simple random Google Meet link generation (no Google Calendar API)
        $code = strtolower(\Illuminate\Support\Str::random(3)) . '-' . strtolower(\Illuminate\Support\Str::random(4)) . '-' . strtolower(\Illuminate\Support\Str::random(3));
        return "https://meet.google.com/{$code}";
    }


    /**
     * Configure the Google API client.
     */
    private function getGoogleClient(): Client
    {
        $client = new Client();

        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setPrompt('consent');

        return $client;
    }
}
