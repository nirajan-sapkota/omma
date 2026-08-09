<?php $__env->startSection('title', 'Booking confirmed — Omma Health Center'); ?>

<?php $__env->startSection('content'); ?>
<section class="view compact">
  <div class="container confirm-wrap">
    <div class="confirm-check">✓</div>
    <h2 style="margin-bottom:6px;">You're booked</h2>
    <p style="margin-bottom:28px;"><?php echo e($booking->service_name); ?> · <?php echo e($booking->formatted_date); ?> · <?php echo e($booking->formatted_time); ?></p>

    <?php if($booking->is_online): ?>
      <div class="meet-box">
        <div class="meet-label">Google Meet link</div>
        <div class="meet-link-row">
          <code><?php echo e($booking->meet_link); ?></code>
          <a href="https://<?php echo e($booking->meet_link); ?>" target="_blank" rel="noreferrer">Copy / open</a>
        </div>
        <a href="https://<?php echo e($booking->meet_link); ?>" target="_blank" rel="noreferrer" class="btn btn-primary btn-block">Join meeting →</a>
      </div>
    <?php else: ?>
      <div class="address-box">
        <div class="addr-label">Clinic location</div>
        <p style="margin:0; color:var(--ink);"><?php echo e($address); ?></p>
      </div>
    <?php endif; ?>

    <?php
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
    ?>

    <a href="<?php echo e($calendarUrl); ?>" target="_blank" rel="noreferrer" class="btn btn-outline btn-block" style="margin-bottom:14px;">Add to Google Calendar</a>
    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-ghost">Back to dashboard</a>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo Loq\OneDrive\Desktop\xampp\htdocs\omma-health-center\resources\views/booking-confirmation.blade.php ENDPATH**/ ?>