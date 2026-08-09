<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    /** Services offered — keyed for validation, labelled for display. */
    public const SERVICES = [
        'eye'     => ['name' => 'Eye Specialist Consultation', 'duration' => '30 min'],
        'hearing' => ['name' => 'Hearing Specialist Consultation', 'duration' => '30 min'],
        'general' => ['name' => 'General Doctor Consultation', 'duration' => '20 min'],
        'followup' => ['name' => 'Follow-up Review', 'duration' => '15 min'],
    ];

    /** Bookable time slots, 24h "H:i". */
    public const TIME_SLOTS = [
        '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
        '13:00', '13:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30',
    ];

    public const CLINIC_ADDRESS = 'Omma Health Center, 4th Floor, Board Bazaar Road, Baneshwor, Kathmandu';

    /**
     * Show the booking flow.
     */
    public function create(Request $request)
    {
        // Slots already taken by anyone, for any date from today onward,
        // so the picker can grey them out per selected day.
        $busy = Booking::where('appointment_date', '>=', now()->toDateString())
            ->get(['appointment_date', 'appointment_time'])
            ->map(fn ($b) => [
                'date' => $b->appointment_date->format('Y-m-d'),
                'time' => $b->appointment_time,
            ])
            ->values();

        return view('booking', [
            'services'  => self::SERVICES,
            'timeSlots' => self::TIME_SLOTS,
            'busyJson'  => $busy->toJson(),
        ]);
    }

    /**
     * Validate, persist, and (for online visits) generate a meeting link.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category'          => ['required', Rule::in(['online', 'physical'])],
            'service'            => ['required', Rule::in(array_keys(self::SERVICES))],
            'appointment_date'   => ['required', 'date', 'after_or_equal:today'],
            'appointment_time'   => ['required', Rule::in(self::TIME_SLOTS)],
        ]);

        $alreadyTaken = Booking::where('appointment_date', $data['appointment_date'])
            ->where('appointment_time', $data['appointment_time'])
            ->exists();

        if ($alreadyTaken) {
            return back()
                ->withInput()
                ->withErrors(['appointment_time' => 'That slot was just taken — please pick another time.']);
        }

        $booking = Booking::create([
            'user_id'          => Auth::id(),
            'category'         => $data['category'],
            'service_key'      => $data['service'],
            'service_name'     => self::SERVICES[$data['service']]['name'],
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'meet_link'        => $data['category'] === 'online' ? $this->generateMeetLink() : null,
        ]);

        return view('booking-confirmation', [
            'booking' => $booking,
            'address' => self::CLINIC_ADDRESS,
        ]);
    }

    /**
     * Mimic a Google Meet code (xxx-xxxx-xxx). A real integration swaps this
     * for a Google Calendar API call — see docs/google-meet-integration.md.
     */
    private function generateMeetLink(): string
    {
        $seg = fn (int $n) => collect(range(1, $n))
            ->map(fn () => chr(random_int(97, 122)))
            ->implode('');

        return sprintf('meet.google.com/%s-%s-%s', $seg(3), $seg(4), $seg(3));
    }
}
