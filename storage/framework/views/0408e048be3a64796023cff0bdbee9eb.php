<?php $__env->startSection('title', 'Dashboard — Omma Health Center'); ?>

<?php $__env->startSection('content'); ?>
<section class="view compact">
  <div class="container" style="max-width:760px;">
    <div class="section-title">
      <h2>Welcome, <?php echo e(Auth::user()->name); ?></h2>
      <span class="tag">Patient dashboard</span>
    </div>

    <?php if(session('status')): ?>
      <div class="result-box good"><p><?php echo e(session('status')); ?></p></div>
    <?php endif; ?>

    <div class="book-cta">
      <div>
        <span class="eyebrow">Feeling off, or overdue for a check-in?</span>
        <h2>Book your next visit</h2>
      </div>
      <a href="<?php echo e(route('booking.create')); ?>" class="btn btn-primary">Book now →</a>
    </div>

    <span class="step-label" style="margin-top:0;">Upcoming appointments</span>
    <div class="appt-list">
      <?php $__empty_1 = true; $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="appt-card">
          <div class="appt-left">
            <div class="appt-ico"><?php echo e($appt->is_online ? '🎥' : '📍'); ?></div>
            <div>
              <h4><?php echo e($appt->service_name); ?></h4>
              <span class="when"><?php echo e($appt->formatted_date); ?> · <?php echo e($appt->formatted_time); ?></span>
            </div>
          </div>
          <?php if($appt->is_online): ?>
            <a href="https://<?php echo e($appt->meet_link); ?>" target="_blank" rel="noreferrer" class="btn btn-primary btn-sm">Join</a>
          <?php else: ?>
            <span class="patient-chip" style="background:var(--blue-50);">In person</span>
          <?php endif; ?>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-state">Nothing on the calendar yet. Book your first visit above.</div>
      <?php endif; ?>
    </div>

    <div class="panel" style="margin-top:32px;">
      <p>You're signed in as <strong><?php echo e(Auth::user()->email); ?></strong>.</p>
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-outline">Log out</button>
      </form>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo Loq\OneDrive\Desktop\xampp\htdocs\omma-health-center\resources\views/dashboard.blade.php ENDPATH**/ ?>