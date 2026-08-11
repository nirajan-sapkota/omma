<?php $__env->startSection('title', 'Booking Confirmed — Omma Health Center'); ?>

<?php $__env->startSection('content'); ?>

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
                <h3><?php echo e($booking->service_name); ?></h3>
            </div>

            <span class="status-badge">
                <?php echo e(ucfirst($booking->status)); ?>

            </span>
        </div>

        <div class="booking-details">

            <div class="detail">
                <span class="detail-icon">📅</span>
                <div>
                    <span class="detail-label">Date</span>
                    <strong>
                        <?php echo e($booking->appointment_date->format('l, F j, Y')); ?>

                    </strong>
                </div>
            </div>

            <div class="detail">
                <span class="detail-icon">🕐</span>
                <div>
                    <span class="detail-label">Time</span>
                    <strong>
                        <?php echo e(\Carbon\Carbon::parse($booking->appointment_time)->format('g:i A')); ?>

                    </strong>
                </div>
            </div>

            <div class="detail">
                <span class="detail-icon">
                    <?php echo e($booking->category === 'online' ? '🎥' : '📍'); ?>

                </span>

                <div>
                    <span class="detail-label">Appointment type</span>

                    <strong>
                        <?php echo e($booking->category === 'online' ? 'Online appointment' : 'In-person appointment'); ?>

                    </strong>
                </div>
            </div>

            <div class="detail">
                <span class="detail-icon">🧾</span>

                <div>
                    <span class="detail-label">Payment Status</span>

                    <strong>
                        <?php echo e(ucfirst($booking->payment_status ?? 'pending')); ?> Verification
                    </strong>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->payment_receipt_url): ?>
                        <div>
                            <a href="<?php echo e($booking->payment_receipt_url); ?>" target="_blank" style="font-size: 12px; color: #0f766e; font-weight: 700; text-decoration: none;">
                                View Uploaded Receipt ↗
                            </a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->category === 'online'): ?>

            <div class="online-box">

                <div>
                    <span class="detail-label">Google Meet</span>

                    <p>
                        Your online appointment will take place through Google Meet.
                    </p>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($booking->meet_link): ?>
                    <a
                        href="https://<?php echo e($booking->meet_link); ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-primary"
                    >
                        Join Google Meet →
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        <?php else: ?>

            <div class="location-box">

                <span class="detail-icon">📍</span>

                <div>
                    <span class="detail-label">Clinic location</span>

                    <strong><?php echo e($address); ?></strong>

                    <p>
                        Please arrive 10–15 minutes before your appointment.
                    </p>
                </div>

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>

    <div class="confirmation-actions">

        <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary">
            View my appointments
        </a>

        <a href="<?php echo e(route('home')); ?>" class="btn btn-outline">
            Return home
        </a>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\omma-health-center\resources\views/booking-confirmation.blade.php ENDPATH**/ ?>