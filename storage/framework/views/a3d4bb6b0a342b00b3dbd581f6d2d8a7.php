<?php $__env->startSection('title', 'Book an appointment — Omma Health Center'); ?>

<?php $__env->startSection('content'); ?>
<section class="view compact">
  <div class="container" style="max-width:640px;">
    <div class="section-title">
      <h2>Book an appointment</h2>
      <span class="tag">New booking</span>
    </div>

    <?php if($errors->any()): ?>
      <div class="result-box warn">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <div class="step-nav">
      <div class="step"><span class="step-num">1</span> Category</div>
      <div class="step"><span class="step-num">2</span> Service</div>
      <div class="step"><span class="step-num">3</span> Date &amp; time</div>
    </div>

    <form method="POST" action="<?php echo e(route('booking.store')); ?>" id="booking-form">
      <?php echo csrf_field(); ?>

      <span class="step-label" style="margin-top:0;">1. Choose a category</span>
      <div class="pick-grid">
        <input type="radio" name="category" id="cat-online" value="online" style="display:none;" required
               <?php echo e(old('category', 'online') === 'online' ? 'checked' : ''); ?>>
        <label for="cat-online" class="pick-card">
          <span class="pick-ico">🎥</span>
          <h4>Online visit</h4>
          <p>Video call via Google Meet</p>
        </label>

        <input type="radio" name="category" id="cat-physical" value="physical" style="display:none;"
               <?php echo e(old('category') === 'physical' ? 'checked' : ''); ?>>
        <label for="cat-physical" class="pick-card">
          <span class="pick-ico">📍</span>
          <h4>In person</h4>
          <p>Visit our Kathmandu clinic</p>
        </label>
      </div>

      <span class="step-label">2. Choose a service</span>
      <div class="svc-pick-grid">
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $svc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <input type="radio" name="service" id="svc-<?php echo e($key); ?>" value="<?php echo e($key); ?>" style="display:none;" required
                 <?php echo e(old('service') === $key ? 'checked' : ''); ?>>
          <label for="svc-<?php echo e($key); ?>" class="pick-card">
            <h4><?php echo e($svc['name']); ?></h4>
            <p><?php echo e($svc['duration']); ?></p>
          </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <span class="step-label">3. Pick a date</span>
      <div class="day-strip">
        <?php for($i = 0; $i < 14; $i++): ?>
          <?php $d = now()->addDays($i); ?>
          <input type="radio" name="appointment_date" id="day-<?php echo e($i); ?>" value="<?php echo e($d->toDateString()); ?>"
                 style="display:none;" required data-date="<?php echo e($d->toDateString()); ?>"
                 <?php echo e(old('appointment_date') === $d->toDateString() || (!old('appointment_date') && $i === 0) ? 'checked' : ''); ?>>
          <label for="day-<?php echo e($i); ?>" class="day-chip">
            <span class="dow"><?php echo e($d->format('D')); ?></span>
            <span class="dom"><?php echo e($d->format('j')); ?></span>
          </label>
        <?php endfor; ?>
      </div>

      <span class="step-label">Pick a time</span>
      <div class="time-grid" id="time-grid">
        <?php $__currentLoopData = $timeSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <input type="radio" name="appointment_time" id="time-<?php echo e($slot); ?>" value="<?php echo e($slot); ?>"
                 style="display:none;" required data-time="<?php echo e($slot); ?>"
                 <?php echo e(old('appointment_time') === $slot ? 'checked' : ''); ?>>
          <label for="time-<?php echo e($slot); ?>" class="time-slot" data-time="<?php echo e($slot); ?>">
            <?php echo e(\Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A')); ?>

          </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="book-summary">
        <p id="booking-summary">Complete each step to confirm your booking</p>
        <button type="submit" class="btn btn-primary">Confirm booking</button>
      </div>
    </form>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
(function () {
  var busy = <?php echo $busyJson; ?>; // [{date:'2026-08-10', time:'09:00'}, ...]
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo Loq\OneDrive\Desktop\xampp\htdocs\omma-health-center\resources\views/booking.blade.php ENDPATH**/ ?>