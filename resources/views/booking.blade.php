@extends('layouts.app')

@section('title', 'Book an appointment — Omma Health Center')

@section('content')
<section class="view compact">
  <div class="container" style="max-width:640px;">
    <div class="section-title">
      <h2>Book an appointment</h2>
      <span class="tag">New booking</span>
    </div>

    @if ($errors->any())
      <div class="result-box warn">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="step-nav">
      <div class="step"><span class="step-num">1</span> Category</div>
      <div class="step"><span class="step-num">2</span> Service</div>
      <div class="step"><span class="step-num">3</span> Date &amp; time</div>
    </div>

    <form method="POST" action="{{ route('booking.store') }}" id="booking-form">
      @csrf

      <span class="step-label" style="margin-top:0;">1. Choose a category</span>
      <div class="pick-grid">
        <input type="radio" name="category" id="cat-online" value="online" style="display:none;" required
               {{ old('category', 'online') === 'online' ? 'checked' : '' }}>
        <label for="cat-online" class="pick-card">
          <span class="pick-ico">🎥</span>
          <h4>Online visit</h4>
          <p>Video call via Google Meet</p>
        </label>

        <input type="radio" name="category" id="cat-physical" value="physical" style="display:none;"
               {{ old('category') === 'physical' ? 'checked' : '' }}>
        <label for="cat-physical" class="pick-card">
          <span class="pick-ico">📍</span>
          <h4>In person</h4>
          <p>Visit our Kathmandu clinic</p>
        </label>
      </div>

      <span class="step-label">2. Choose a service</span>
      <div class="svc-pick-grid">
        @foreach ($services as $key => $svc)
          <input type="radio" name="service" id="svc-{{ $key }}" value="{{ $key }}" style="display:none;" required
                 {{ old('service') === $key ? 'checked' : '' }}>
          <label for="svc-{{ $key }}" class="pick-card">
            <h4>{{ $svc['name'] }}</h4>
            <p>{{ $svc['duration'] }}</p>
          </label>
        @endforeach
      </div>

      <span class="step-label">3. Pick a date</span>
      <div class="day-strip">
        @for ($i = 0; $i < 14; $i++)
          @php $d = now()->addDays($i); @endphp
          <input type="radio" name="appointment_date" id="day-{{ $i }}" value="{{ $d->toDateString() }}"
                 style="display:none;" required data-date="{{ $d->toDateString() }}"
                 {{ old('appointment_date') === $d->toDateString() || (!old('appointment_date') && $i === 0) ? 'checked' : '' }}>
          <label for="day-{{ $i }}" class="day-chip">
            <span class="dow">{{ $d->format('D') }}</span>
            <span class="dom">{{ $d->format('j') }}</span>
          </label>
        @endfor
      </div>

      <span class="step-label">Pick a time</span>
      <div class="time-grid" id="time-grid">
        @foreach ($timeSlots as $slot)
          <input type="radio" name="appointment_time" id="time-{{ $slot }}" value="{{ $slot }}"
                 style="display:none;" required data-time="{{ $slot }}"
                 {{ old('appointment_time') === $slot ? 'checked' : '' }}>
          <label for="time-{{ $slot }}" class="time-slot" data-time="{{ $slot }}">
            {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}
          </label>
        @endforeach
      </div>

      <div class="book-summary">
        <p id="booking-summary">Complete each step to confirm your booking</p>
        <button type="submit" class="btn btn-primary">Confirm booking</button>
      </div>
    </form>
  </div>
</section>
@endsection

@section('scripts')
<script>
(function () {
  var busy = {!! $busyJson !!}; // [{date:'2026-08-10', time:'09:00'}, ...]
  var form = document.getElementById('booking-form');
  var summary = document.getElementById('booking-summary');

  function busyTimesFor(date) {
    return busy.filter(function (b) { return b.date === date; }).map(function (b) { return b.time; });
  }

  function refreshTimeGrid() {
    var dateInput = form.querySelector('input[name="appointment_date"]:checked');
    if (!dateInput) return;
    var taken = busyTimesFor(dateInput.value);

    form.querySelectorAll('input[name="appointment_time"]').forEach(function (input) {
      var label = form.querySelector('label[for="' + input.id + '"]');
      var isBooked = taken.indexOf(input.dataset.time) !== -1;
      label.classList.toggle('is-booked', isBooked);
      if (isBooked && input.checked) input.checked = false;
    });
  }

  function refreshSummary() {
    var cat = form.querySelector('input[name="category"]:checked');
    var svc = form.querySelector('input[name="service"]:checked');
    var date = form.querySelector('input[name="appointment_date"]:checked');
    var time = form.querySelector('input[name="appointment_time"]:checked');

    if (cat && svc && date && time) {
      var svcLabel = form.querySelector('label[for="' + svc.id + '"] h4').textContent;
      var dateLabel = form.querySelector('label[for="' + date.id + '"]').textContent.trim().replace(/\s+/g, ' ');
      var timeLabel = form.querySelector('label[for="' + time.id + '"]').textContent.trim();
      summary.textContent = svcLabel + ' · ' + (cat.value === 'online' ? 'Online' : 'In person') + ' · ' + dateLabel + ', ' + timeLabel;
    } else {
      summary.textContent = 'Complete each step to confirm your booking';
    }
  }

  form.addEventListener('change', function (e) {
    if (e.target.name === 'appointment_date') refreshTimeGrid();
    refreshSummary();
  });

  refreshTimeGrid();
  refreshSummary();
})();
</script>
@endsection
