@extends('layouts.app')

@section('title', 'Dashboard — Omma Health Center')

@section('content')
<section class="view compact">
  <div class="container" style="max-width:760px;">
    <div class="section-title">
      <h2>Welcome, {{ Auth::user()->name }}</h2>
      <span class="tag">Patient dashboard</span>
    </div>

    @if (session('status'))
      <div class="result-box good"><p>{{ session('status') }}</p></div>
    @endif

    <div class="book-cta">
      <div>
        <span class="eyebrow">Feeling off, or overdue for a check-in?</span>
        <h2>Book your next visit</h2>
      </div>
      <a href="{{ route('booking.create') }}" class="btn btn-primary">Book now →</a>
    </div>

    <span class="step-label" style="margin-top:0;">Upcoming appointments</span>
    <div class="appt-list">
      @forelse ($upcoming as $appt)
        <div class="appt-card">
          <div class="appt-left">
            <div class="appt-ico">{{ $appt->is_online ? '🎥' : '📍' }}</div>
            <div>
              <h4>{{ $appt->service_name }}</h4>
              <span class="when">{{ $appt->formatted_date }} · {{ $appt->formatted_time }}</span>
            </div>
          </div>
          @if ($appt->is_online)
            <a href="https://{{ $appt->meet_link }}" target="_blank" rel="noreferrer" class="btn btn-primary btn-sm">Join</a>
          @else
            <span class="patient-chip" style="background:var(--blue-50);">In person</span>
          @endif
        </div>
      @empty
        <div class="empty-state">Nothing on the calendar yet. Book your first visit above.</div>
      @endforelse
    </div>

    <div class="panel" style="margin-top:32px;">
      <p>You're signed in as <strong>{{ Auth::user()->email }}</strong>.</p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline">Log out</button>
      </form>
    </div>
  </div>
</section>
@endsection
