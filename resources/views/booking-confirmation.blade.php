@extends('layouts.app')

@section('title', 'Booking Confirmed — Omma Health Center')

@section('content')

<div class="confirmation-page">

    <div class="confirmation-icon">
        ✓
    </div>

    <span class="eyebrow">Appointment confirmed</span>

    <h1>Your appointment is booked!</h1>

    <p class="confirmation-message">
        Your biometric and physical ability assessment has been successfully scheduled.
    </p>

    <div class="booking-card">

        <div class="booking-card-header">
            <div>
                <span class="small-label">SERVICE</span>
                <h3>{{ $booking->service_name }}</h3>
            </div>

            <span class="status-badge">
                {{ ucfirst($booking->status) }}
            </span>
        </div>

        <div class="booking-details">

            <div class="detail">
                <span class="detail-icon">📅</span>
                <div>
                    <span class="detail-label">Date</span>
                    <strong>
                        {{ $booking->appointment_date->format('l, F j, Y') }}
                    </strong>
                </div>
            </div>

            <div class="detail">
                <span class="detail-icon">🕐</span>
                <div>
                    <span class="detail-label">Time</span>
                    <strong>
                        {{ \Carbon\Carbon::parse($booking->appointment_time)->format('g:i A') }}
                    </strong>
                </div>
            </div>

            <div class="detail">
                <span class="detail-icon">
                    {{ $booking->category === 'online' ? '🎥' : '📍' }}
                </span>

                <div>
                    <span class="detail-label">Appointment type</span>

                    <strong>
                        {{ $booking->category === 'online' ? 'Online appointment' : 'In-person appointment' }}
                    </strong>
                </div>
            </div>

            <div class="detail">
                <span class="detail-icon">🧾</span>

                <div>
                    <span class="detail-label">Payment Status</span>

                    <strong>
                        {{ ucfirst($booking->payment_status ?? 'pending') }} Verification
                    </strong>

                    @if ($booking->payment_receipt_url)
                        <div>
                            <a href="{{ $booking->payment_receipt_url }}" target="_blank" style="font-size: 12px; color: #0f766e; font-weight: 700; text-decoration: none;">
                                View Uploaded Receipt ↗
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        @if ($booking->category === 'online')

            <div class="online-box">

                <div>
                    <span class="detail-label">Google Meet</span>

                    <p>
                        Your online appointment will take place through Google Meet.
                    </p>
                </div>

                @if ($booking->meet_link)
                    <a
                        href="https://{{ $booking->meet_link }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-primary"
                    >
                        Join Google Meet →
                    </a>
                @endif

            </div>

        @else

            <div class="location-box">

                <span class="detail-icon">📍</span>

                <div>
                    <span class="detail-label">Clinic location</span>

                    <strong>{{ $address }}</strong>

                    <p>
                        Please arrive 10–15 minutes before your appointment.
                    </p>
                </div>

            </div>

        @endif

    </div>

    <div class="confirmation-actions">

        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            View my appointments
        </a>

        <a href="{{ route('home') }}" class="btn btn-outline">
            Return home
        </a>

    </div>

</div>

@endsection