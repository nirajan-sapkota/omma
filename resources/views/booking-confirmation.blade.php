@extends('layouts.app')

@section('title', 'Booking confirmed — Omma Health Center')

@section('content')
<section class="view compact">
  <div class="container confirm-wrap">
    <div class="confirm-check">✓</div>
    <h2 style="margin-bottom:6px;">You're booked</h2>
    <p style="margin-bottom:28px;">{{ $booking->service_name }} · {{ $booking->formatted_date }} · {{ $booking->formatted_time }}</p>

    @if ($booking->is_online)
      <div class="meet-box">
        <div class="meet-label">Google Meet link</div>
        <div class="meet-link-row">
          <code>{{ $booking->meet_link }}</code>
          <a href="https://{{ $booking->meet_link }}" target="_blank" rel="noreferrer">Copy / open</a>
        </div>
        <a href="https://{{ $booking->meet_link }}" target="_blank" rel="noreferrer" class="btn btn-primary btn-block">Join meeting →</a>
      </div>
    @else
      <div class="address-box">
        <div class="addr-label">Clinic location</div>
        <p style="margin:0; color:var(--ink);">{{ $address }}</p>
      </div>
    @endif

    @php
      [$h, $m] = array_map('intval', explode(':', $booking->appointment_time));
      $start = $booking->appointment_date->copy()->setTime($h, $m);
      $end = $start->copy()->addMinutes(30);
      $details = $booking->is_online
          ? 'Video visit with Omma Health Center. Join: https://' . $booking->meet_link
          : 'In-person visit at ' . $address . '.';
      $calendarUrl = 'https://calendar.google.com/calendar/render?' . http_build_query([
          'action' => 'TEMPLATE',
          'text' => 'Omma Health Center — ' . $booking->service_name,
          'dates' => $start->utc()->format('Ymd\THis\Z') . '/' . $end->utc()->format('Ymd\THis\Z'),
          'details' => $details,
          'location' => $booking->is_online ? ('https://' . $booking->meet_link) : $address,
      ]);
    @endphp

    <a href="{{ $calendarUrl }}" target="_blank" rel="noreferrer" class="btn btn-outline btn-block" style="margin-bottom:14px;">Add to Google Calendar</a>
    <a href="{{ route('dashboard') }}" class="btn btn-ghost">Back to dashboard</a>
  </div>
</section>
@endsection
