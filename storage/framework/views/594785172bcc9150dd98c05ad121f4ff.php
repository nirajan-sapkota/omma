<?php $__env->startSection('title', 'Dashboard — Omma Health Center'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================================
       OMMA PATIENT DASHBOARD
       ========================================================= */

    :root {
        --dash-primary: #0f766e;
        --dash-primary-dark: #115e59;
        --dash-accent: #14b8a6;
        --dash-blue: #2563eb;
        --dash-bg: #f5faf9;
        --dash-text: #102a2a;
        --dash-muted: #6b7f7e;
        --dash-border: rgba(15, 118, 110, .11);
        --dash-shadow: 0 20px 60px rgba(15, 118, 110, .09);
    }


    /* =========================================================
       PAGE
       ========================================================= */

    .dashboard-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        padding: 55px 6% 90px;
        background:
            radial-gradient(
                circle at 90% 5%,
                rgba(20,184,166,.12),
                transparent 25%
            ),
            radial-gradient(
                circle at 5% 35%,
                rgba(37,99,235,.07),
                transparent 25%
            ),
            var(--dash-bg);
    }


    .dashboard-orb {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .dashboard-orb.one {
        width: 250px;
        height: 250px;
        right: -90px;
        top: 100px;
        border: 1px solid rgba(20,184,166,.12);
        animation: dashOrb 8s ease-in-out infinite;
    }

    .dashboard-orb.two {
        width: 150px;
        height: 150px;
        left: -60px;
        bottom: 180px;
        background: rgba(37,99,235,.04);
        animation: dashOrb 10s ease-in-out infinite reverse;
    }


    .dashboard-container {
        position: relative;
        z-index: 2;
        max-width: 1180px;
        margin: auto;
    }


    /* =========================================================
       TOP HEADER
       ========================================================= */

    .dashboard-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 30px;
        margin-bottom: 38px;
        animation: dashReveal .8s cubic-bezier(.22,1,.36,1) both;
    }


    .dashboard-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 12px;
        color: var(--dash-primary);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .15em;
    }

    .dashboard-eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--dash-accent);
        box-shadow:
            0 0 0 5px rgba(20,184,166,.10);
        animation: statusPulse 2s infinite;
    }


    .dashboard-header h1 {
        margin: 0 0 10px;
        color: var(--dash-text);
        font-size: clamp(34px, 4vw, 52px);
        line-height: 1;
        letter-spacing: -.05em;
    }


    .dashboard-header p {
        margin: 0;
        color: var(--dash-muted);
        font-size: 16px;
        line-height: 1.6;
    }


    .header-action {
        flex-shrink: 0;
    }


    /* =========================================================
       BUTTONS
       ========================================================= */

    .dash-btn {
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 48px;
        padding: 0 20px;
        border-radius: 13px;
        border: 0;
        text-decoration: none;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        transition:
            transform .3s cubic-bezier(.22,1,.36,1),
            box-shadow .3s ease,
            background .3s ease;
    }


    .dash-btn::after {
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 70%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.3),
            transparent
        );
        transform: skewX(-20deg);
        transition: .65s;
    }

    .dash-btn:hover::after {
        left: 140%;
    }


    .dash-btn-primary {
        color: white;
        background:
            linear-gradient(
                135deg,
                var(--dash-primary),
                var(--dash-accent)
            );
        box-shadow:
            0 13px 28px rgba(15,118,110,.20);
    }


    .dash-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow:
            0 18px 35px rgba(15,118,110,.28);
    }


    .dash-btn-outline {
        color: var(--dash-text);
        background: white;
        border: 1px solid var(--dash-border);
    }


    .dash-btn-outline:hover {
        transform: translateY(-2px);
        border-color: rgba(15,118,110,.25);
        box-shadow: 0 10px 25px rgba(15,118,110,.08);
    }


    .dash-btn-sm {
        min-height: 39px;
        padding: 0 15px;
        font-size: 12px;
        border-radius: 10px;
    }


    /* =========================================================
       STATUS MESSAGE
       ========================================================= */

    .dashboard-status {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 25px;
        padding: 14px 17px;
        border-radius: 14px;
        color: var(--dash-primary-dark);
        background: rgba(20,184,166,.08);
        border: 1px solid rgba(20,184,166,.13);
        animation: dashReveal .6s ease both;
    }


    .dashboard-status-icon {
        width: 30px;
        height: 30px;
        display: grid;
        place-items: center;
        border-radius: 9px;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,.05);
    }


    /* =========================================================
       BOOKING HERO CARD
       ========================================================= */

    .booking-hero-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
        margin-bottom: 50px;
        padding: 38px 40px;
        border-radius: 27px;
        color: white;
        background:
            radial-gradient(
                circle at 90% 10%,
                rgba(255,255,255,.18),
                transparent 25%
            ),
            radial-gradient(
                circle at 5% 100%,
                rgba(20,184,166,.30),
                transparent 30%
            ),
            linear-gradient(
                135deg,
                #0f766e,
                #115e59 55%,
                #173f67
            );
        box-shadow:
            0 25px 65px rgba(15,118,110,.20);
        animation:
            dashReveal .9s
            cubic-bezier(.22,1,.36,1)
            .1s both;
    }


    .booking-hero-card::before {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        right: -100px;
        top: -160px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.15);
        animation: dashOrb 7s ease-in-out infinite;
    }


    .booking-hero-card::after {
        content: "✦";
        position: absolute;
        right: 28%;
        top: 25%;
        color: rgba(255,255,255,.18);
        font-size: 40px;
        animation: sparkle 3s ease-in-out infinite;
    }


    .booking-hero-content {
        position: relative;
        z-index: 2;
    }


    .booking-mini-label {
        display: block;
        margin-bottom: 10px;
        color: rgba(255,255,255,.68);
        font-size: 10px;
        font-weight: 900;
        letter-spacing: .15em;
    }


    .booking-hero-card h2 {
        margin: 0 0 10px;
        font-size: clamp(25px, 3vw, 35px);
        line-height: 1.1;
        letter-spacing: -.035em;
    }


    .booking-hero-card p {
        max-width: 650px;
        margin: 0;
        color: rgba(255,255,255,.75);
        line-height: 1.65;
        font-size: 14px;
    }


    .booking-hero-action {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }


    .booking-hero-action .dash-btn {
        background: white;
        color: var(--dash-primary);
    }


    .booking-hero-action .dash-btn:hover {
        box-shadow: 0 15px 35px rgba(0,0,0,.18);
    }


    /* =========================================================
       SECTION HEADER
       ========================================================= */

    .dashboard-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
    }


    .dashboard-section-header h2 {
        margin: 0;
        color: var(--dash-text);
        font-size: 23px;
        letter-spacing: -.025em;
    }


    .appointment-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 29px;
        height: 29px;
        padding: 0 9px;
        border-radius: 999px;
        color: var(--dash-primary);
        background: rgba(20,184,166,.10);
        font-size: 12px;
        font-weight: 900;
    }


    /* =========================================================
       APPOINTMENT CARDS
       ========================================================= */

    .appointments-list {
        display: grid;
        gap: 14px;
        margin-bottom: 55px;
    }


    .appt-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        padding: 20px;
        border-radius: 20px;
        background: rgba(255,255,255,.82);
        border: 1px solid var(--dash-border);
        box-shadow: 0 8px 25px rgba(15,118,110,.045);
        backdrop-filter: blur(10px);
        transition:
            transform .35s cubic-bezier(.22,1,.36,1),
            box-shadow .35s ease,
            border-color .35s ease;
        animation: dashReveal .7s cubic-bezier(.22,1,.36,1) both;
    }


    .appt-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 15px;
        bottom: 15px;
        width: 3px;
        border-radius: 999px;
        background:
            linear-gradient(
                180deg,
                var(--dash-primary),
                var(--dash-accent)
            );
        transform: scaleY(.3);
        transition: .35s;
    }


    .appt-card:hover {
        transform: translateY(-4px) translateX(3px);
        border-color: rgba(20,184,166,.22);
        box-shadow:
            0 20px 45px rgba(15,118,110,.10);
    }


    .appt-card:hover::before {
        transform: scaleY(1);
    }


    .appt-left {
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }


    .appt-ico {
        flex-shrink: 0;
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        border-radius: 16px;
        background:
            linear-gradient(
                135deg,
                #e4faf7,
                #edf5ff
            );
        font-size: 22px;
        box-shadow: 0 8px 20px rgba(15,118,110,.07);
        transition: .35s cubic-bezier(.22,1,.36,1);
    }


    .appt-card:hover .appt-ico {
        transform: rotate(-5deg) scale(1.08);
    }


    .appt-left h4 {
        margin: 0 0 5px;
        color: var(--dash-text);
        font-size: 15px;
        line-height: 1.4;
    }


    .when {
        display: block;
        color: var(--dash-muted);
        font-size: 12px;
        line-height: 1.5;
    }


    .appt-right {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }


    .patient-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 12px;
        border-radius: 999px;
        color: var(--dash-primary);
        background: rgba(20,184,166,.09);
        font-size: 11px;
        font-weight: 800;
    }


    .patient-chip::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }


    .pending-chip {
        color: #b7791f;
        background: rgba(245,158,11,.10);
    }


    .pending-chip::before {
        animation: statusPulse 1.8s infinite;
    }


    /* =========================================================
       EMPTY STATE
       ========================================================= */

    .empty-state {
        position: relative;
        overflow: hidden;
        padding: 55px 30px;
        text-align: center;
        border-radius: 23px;
        background: rgba(255,255,255,.75);
        border: 1px dashed rgba(15,118,110,.20);
        color: var(--dash-muted);
        margin-bottom: 55px;
    }


    .empty-icon {
        width: 65px;
        height: 65px;
        display: grid;
        place-items: center;
        margin: 0 auto 17px;
        border-radius: 20px;
        background: linear-gradient(135deg, #e5faf7, #edf4ff);
        font-size: 28px;
        animation: emptyFloat 4s ease-in-out infinite;
    }


    .empty-state h3 {
        margin: 0 0 8px;
        color: var(--dash-text);
        font-size: 19px;
    }


    .empty-state p {
        max-width: 450px;
        margin: 0 auto 22px;
        line-height: 1.65;
        font-size: 13px;
    }


    /* =========================================================
       ACCOUNT CARD
       ========================================================= */

    .account-card {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
        padding: 28px;
        border-radius: 22px;
        background: white;
        border: 1px solid var(--dash-border);
        box-shadow: var(--dash-shadow);
        animation: dashReveal .8s ease .3s both;
    }


    .account-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }


    .account-avatar {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border-radius: 16px;
        color: white;
        background:
            linear-gradient(
                135deg,
                var(--dash-primary),
                var(--dash-accent)
            );
        font-size: 21px;
        box-shadow:
            0 10px 25px rgba(15,118,110,.18);
    }


    .account-info small {
        display: block;
        margin-bottom: 4px;
        color: var(--dash-muted);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
    }


    .account-info strong {
        display: block;
        color: var(--dash-text);
        font-size: 14px;
        word-break: break-word;
    }


    /* =========================================================
       ANIMATIONS
       ========================================================= */

    @keyframes dashReveal {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    @keyframes dashOrb {
        0%, 100% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(12px, -18px);
        }
    }


    @keyframes statusPulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.45);
            opacity: .55;
        }
    }


    @keyframes sparkle {
        0%, 100% {
            opacity: .2;
            transform: scale(.9) rotate(0deg);
        }

        50% {
            opacity: .65;
            transform: scale(1.15) rotate(15deg);
        }
    }


    @keyframes emptyFloat {
        0%, 100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-8px);
        }
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 800px) {

        .dashboard-page {
            padding: 40px 5% 70px;
        }

        .dashboard-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .header-action {
            width: 100%;
        }

        .header-action .dash-btn {
            width: 100%;
        }

        .booking-hero-card {
            align-items: flex-start;
            flex-direction: column;
            padding: 30px;
        }

        .booking-hero-action {
            width: 100%;
        }

        .booking-hero-action .dash-btn {
            width: 100%;
        }

        .account-card {
            align-items: flex-start;
            flex-direction: column;
        }
    }


    @media (max-width: 600px) {

        .dashboard-header h1 {
            font-size: 38px;
        }

        .appt-card {
            align-items: flex-start;
            flex-direction: column;
        }

        .appt-right {
            width: 100%;
        }

        .appt-right .dash-btn {
            flex: 1;
        }

        .patient-chip {
            flex: 1;
            justify-content: center;
        }

        .account-info {
            width: 100%;
        }

        .account-card form,
        .account-card .dash-btn {
            width: 100%;
        }
    }


    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>


<section class="dashboard-page">

    <div class="dashboard-orb one"></div>
    <div class="dashboard-orb two"></div>


    <div class="dashboard-container">


        

        <header class="dashboard-header">

            <div>

                <span class="dashboard-eyebrow">
                    PATIENT DASHBOARD
                </span>

                <h1>
                    Welcome back,
                    <?php echo e(Str::before(Auth::user()->email, '@')); ?>.
                </h1>

                <p>
                    Here's everything you need for your upcoming
                    Omma Health Center appointments.
                </p>

            </div>


            <div class="header-action">

                <a
                    href="<?php echo e(route('booking.create')); ?>"
                    class="dash-btn dash-btn-primary"
                >
                    <span>＋</span>
                    New appointment
                </a>

            </div>

        </header>


        

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>

            <div class="dashboard-status">

                <span class="dashboard-status-icon">
                    ✓
                </span>

                <strong>
                    <?php echo e(session('status')); ?>

                </strong>

            </div>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        

        <section class="booking-hero-card">

            <div class="booking-hero-content">

                <span class="booking-mini-label">
                    OMMA HEALTH CENTER
                </span>

                <h2>
                    Need a new assessment?
                </h2>

                <p>
                    Book your biometric and physical ability assessment
                    online or choose an in-person visit at the health center.
                </p>

            </div>


            <div class="booking-hero-action">

                <a
                    href="<?php echo e(route('booking.create')); ?>"
                    class="dash-btn"
                >
                    Book an appointment
                    <span>→</span>
                </a>

            </div>

        </section>


        

        <section>

            <div class="dashboard-section-header">

                <h2>
                    Upcoming appointments
                </h2>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($upcoming->count()): ?>

                    <span class="appointment-count">
                        <?php echo e($upcoming->count()); ?>

                    </span>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>


            <div class="appointments-list">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $appt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

                    <article
                        class="appt-card"
                        style="animation-delay: <?php echo e($index * 80); ?>ms;"
                    >

                        <div class="appt-left">

                            <div class="appt-ico">
                                <?php echo e($appt->is_online ? '🎥' : '📍'); ?>

                            </div>


                            <div>

                                <h4>
                                    <?php echo e($appt->service_name); ?>

                                </h4>

                                <span class="when">

                                    <?php echo e($appt->formatted_date); ?>


                                    <span>·</span>

                                    <?php echo e($appt->formatted_time); ?>


                                </span>

                            </div>

                        </div>


                        <div class="appt-right">

                            

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($appt->is_online): ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($appt->meet_link): ?>

                                    <a
                                        href="<?php echo e(str_starts_with($appt->meet_link, 'http')
                                            ? $appt->meet_link
                                            : 'https://' . $appt->meet_link); ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="dash-btn dash-btn-primary dash-btn-sm"
                                    >
                                        🎥
                                        Join appointment
                                    </a>

                                <?php else: ?>

                                    <span class="patient-chip pending-chip">
                                        Link pending
                                    </span>

                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


                            

                            <?php else: ?>

                                <span class="patient-chip">
                                    📍
                                    In person
                                </span>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>

                    </article>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                    <div class="empty-state">

                        <div class="empty-icon">
                            📅
                        </div>

                        <h3>
                            Your calendar is clear
                        </h3>

                        <p>
                            You don't have any upcoming appointments yet.
                            When you're ready, schedule your complete
                            assessment with Omma Health Center.
                        </p>

                        <a
                            href="<?php echo e(route('booking.create')); ?>"
                            class="dash-btn dash-btn-primary"
                        >
                            Book your first appointment
                            <span>→</span>
                        </a>

                    </div>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </section>


        

        <section>

            <div class="dashboard-section-header">

                <h2>
                    Your account
                </h2>

            </div>


            <div class="account-card">

                <div class="account-info">

                    <div class="account-avatar">
                        👤
                    </div>

                    <div>

                        <small>
                            Signed in as
                        </small>

                        <strong>
                            <?php echo e(Auth::user()->email); ?>

                        </strong>

                    </div>

                </div>


                <form
                    method="POST"
                    action="<?php echo e(route('logout')); ?>"
                >

                    <?php echo csrf_field(); ?>

                    <button
                        type="submit"
                        class="dash-btn dash-btn-outline"
                    >
                        Log out
                        <span>↗</span>
                    </button>

                </form>

            </div>

        </section>


    </div>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\omma-health-center\resources\views/dashboard.blade.php ENDPATH**/ ?>