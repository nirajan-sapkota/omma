<?php $__env->startSection('title', 'Omma Health Center — Complete Biometric & Physical Assessment'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================================
       OMMA — PREMIUM ASSESSMENT HOMEPAGE
       ========================================================= */

    :root {
        --omma-primary: #0f766e;
        --omma-primary-dark: #115e59;
        --omma-accent: #14b8a6;
        --omma-blue: #2563eb;
        --omma-bg: #f5fbfa;
        --omma-text: #102a2a;
        --omma-muted: #647878;
        --omma-border: rgba(15, 118, 110, .12);
        --omma-shadow: 0 25px 70px rgba(15, 118, 110, .12);
    }

    /* =========================================================
       HERO
       ========================================================= */

    .omma-hero {
        position: relative;
        min-height: 720px;
        overflow: hidden;
        padding: 90px 7% 80px;
        display: flex;
        align-items: center;
        background:
            radial-gradient(circle at 10% 20%, rgba(20,184,166,.15), transparent 30%),
            radial-gradient(circle at 85% 15%, rgba(37,99,235,.12), transparent 30%),
            linear-gradient(135deg, #f7fffe 0%, #eefaf9 50%, #f5f8ff 100%);
    }

    .hero-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(1px);
        pointer-events: none;
    }

    .hero-orb.one {
        width: 280px;
        height: 280px;
        top: -90px;
        right: 8%;
        background: rgba(20,184,166,.10);
        animation: orbFloat 8s ease-in-out infinite;
    }

    .hero-orb.two {
        width: 180px;
        height: 180px;
        bottom: 8%;
        left: -50px;
        background: rgba(37,99,235,.08);
        animation: orbFloat 10s ease-in-out infinite reverse;
    }

    .hero-orb.three {
        width: 90px;
        height: 90px;
        top: 35%;
        left: 48%;
        background: rgba(20,184,166,.08);
        animation: orbPulse 5s ease-in-out infinite;
    }

    .omma-hero-inner {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 1250px;
        margin: auto;
        display: grid;
        grid-template-columns: 1.05fr .95fr;
        gap: 70px;
        align-items: center;
    }

    .hero-copy {
        animation: heroReveal .9s cubic-bezier(.22,1,.36,1) both;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(255,255,255,.72);
        border: 1px solid rgba(15,118,110,.12);
        color: var(--omma-primary);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: .12em;
        box-shadow: 0 8px 25px rgba(15,118,110,.06);
        backdrop-filter: blur(14px);
    }

    .hero-eyebrow::before {
        content: "";
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: var(--omma-accent);
        box-shadow: 0 0 0 5px rgba(20,184,166,.12);
        animation: statusPulse 2s infinite;
    }

    .hero-copy h1 {
        margin: 24px 0 20px;
        font-size: clamp(44px, 5.5vw, 78px);
        line-height: .98;
        letter-spacing: -.055em;
        color: var(--omma-text);
    }

    .hero-copy h1 span {
        display: inline-block;
        background: linear-gradient(
            120deg,
            var(--omma-primary),
            var(--omma-accent),
            var(--omma-blue)
        );
        background-size: 200% auto;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: gradientMove 5s linear infinite;
    }

    .hero-copy > p {
        max-width: 650px;
        color: var(--omma-muted);
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
    }

    .hero-btn {
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 54px;
        padding: 0 25px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 800;
        transition: .3s cubic-bezier(.22,1,.36,1);
    }

    .hero-btn.primary {
        color: white;
        background: linear-gradient(135deg, var(--omma-primary), var(--omma-accent));
        box-shadow: 0 15px 30px rgba(15,118,110,.22);
    }

    .hero-btn.secondary {
        color: var(--omma-text);
        background: rgba(255,255,255,.72);
        border: 1px solid var(--omma-border);
        backdrop-filter: blur(10px);
    }

    .hero-btn:hover {
        transform: translateY(-4px);
    }

    .hero-btn.primary:hover {
        box-shadow: 0 22px 40px rgba(15,118,110,.28);
    }

    .hero-btn::after {
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 70%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255,255,255,.35),
            transparent
        );
        transform: skewX(-20deg);
        transition: .7s;
    }

    .hero-btn:hover::after {
        left: 140%;
    }

    /* =========================================================
       HERO VISUAL
       ========================================================= */

    .hero-visual {
        position: relative;
        min-height: 520px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: visualReveal 1s cubic-bezier(.22,1,.36,1) .2s both;
    }

    .assessment-orbit {
        position: absolute;
        width: 460px;
        height: 460px;
        border: 1px dashed rgba(15,118,110,.18);
        border-radius: 50%;
        animation: orbitRotate 22s linear infinite;
    }

    .assessment-orbit::before,
    .assessment-orbit::after {
        content: "";
        position: absolute;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: var(--omma-accent);
        box-shadow: 0 0 0 7px rgba(20,184,166,.12);
    }

    .assessment-orbit::before {
        top: 30px;
        left: 75px;
    }

    .assessment-orbit::after {
        bottom: 55px;
        right: 30px;
        background: var(--omma-blue);
    }

    .assessment-panel {
        position: relative;
        z-index: 3;
        width: min(420px, 90%);
        padding: 30px;
        border-radius: 30px;
        background: rgba(255,255,255,.78);
        border: 1px solid rgba(255,255,255,.85);
        box-shadow: var(--omma-shadow);
        backdrop-filter: blur(25px);
        animation: panelFloat 6s ease-in-out infinite;
    }

    .assessment-panel::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: inherit;
        padding: 1px;
        background: linear-gradient(
            135deg,
            rgba(20,184,166,.3),
            transparent,
            rgba(37,99,235,.2)
        );
        -webkit-mask:
            linear-gradient(#fff 0 0) content-box,
            linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }

    .panel-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .panel-icon {
        width: 54px;
        height: 54px;
        display: grid;
        place-items: center;
        border-radius: 17px;
        background: linear-gradient(135deg, #dffaf6, #edf5ff);
        font-size: 25px;
        animation: iconHeartbeat 3s ease-in-out infinite;
    }

    .panel-status {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        font-weight: 800;
        color: var(--omma-primary);
    }

    .panel-status::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #22c55e;
        animation: statusPulse 1.8s infinite;
    }

    .assessment-panel h2 {
        font-size: 28px;
        line-height: 1.15;
        margin: 0 0 10px;
        color: var(--omma-text);
    }

    .assessment-panel > p {
        color: var(--omma-muted);
        line-height: 1.65;
        margin-bottom: 24px;
    }

    .assessment-progress {
        height: 7px;
        border-radius: 999px;
        background: #e9f2f1;
        overflow: hidden;
        margin-bottom: 23px;
    }

    .assessment-progress span {
        display: block;
        width: 100%;
        height: 100%;
        border-radius: inherit;
        background: linear-gradient(
            90deg,
            var(--omma-primary),
            var(--omma-accent),
            var(--omma-blue)
        );
        background-size: 200% 100%;
        animation: progressMove 3s linear infinite;
    }

    .assessment-list {
        display: grid;
        gap: 10px;
    }

    .assessment-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 13px;
        border-radius: 13px;
        background: rgba(245,250,250,.85);
        color: var(--omma-text);
        font-size: 14px;
        font-weight: 700;
        transition: .25s;
    }

    .assessment-item:hover {
        transform: translateX(6px);
        background: #effaf8;
    }

    .assessment-item-icon {
        width: 30px;
        height: 30px;
        display: grid;
        place-items: center;
        border-radius: 9px;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,.06);
    }

    /* =========================================================
       TRUST STRIP
       ========================================================= */

    .trust-strip {
        overflow: hidden;
        background: var(--omma-text);
        color: white;
        padding: 17px 0;
    }

    .trust-track {
        width: max-content;
        display: flex;
        align-items: center;
        gap: 38px;
        animation: marquee 25s linear infinite;
    }

    .trust-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .04em;
        white-space: nowrap;
        opacity: .9;
    }

    .trust-item span {
        color: var(--omma-accent);
        font-size: 18px;
    }

    /* =========================================================
       COMPLETE ASSESSMENT SECTION
       ========================================================= */

    .complete-section {
        padding: 110px 7%;
        background: white;
    }

    .complete-container {
        max-width: 1200px;
        margin: auto;
    }

    .section-heading {
        max-width: 750px;
        margin-bottom: 55px;
    }

    .section-heading .eyebrow {
        color: var(--omma-primary);
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .15em;
    }

    .section-heading h2 {
        margin: 12px 0 16px;
        font-size: clamp(35px, 4vw, 56px);
        line-height: 1.05;
        letter-spacing: -.045em;
        color: var(--omma-text);
    }

    .section-heading p {
        color: var(--omma-muted);
        line-height: 1.8;
        font-size: 17px;
    }

    .assessment-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .assessment-feature {
        position: relative;
        overflow: hidden;
        padding: 27px;
        min-height: 220px;
        border-radius: 24px;
        background: linear-gradient(145deg, #fbfefe, #f3f9f8);
        border: 1px solid var(--omma-border);
        transition: .4s cubic-bezier(.22,1,.36,1);
    }

    .assessment-feature::before {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        right: -45px;
        top: -45px;
        border-radius: 50%;
        background: rgba(20,184,166,.08);
        transition: .5s;
    }

    .assessment-feature:hover {
        transform: translateY(-9px);
        border-color: rgba(20,184,166,.28);
        box-shadow: 0 25px 50px rgba(15,118,110,.10);
    }

    .assessment-feature:hover::before {
        transform: scale(1.8);
    }

    .feature-icon {
        position: relative;
        z-index: 1;
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        border-radius: 16px;
        background: white;
        box-shadow: 0 10px 25px rgba(0,0,0,.06);
        font-size: 23px;
        margin-bottom: 25px;
        transition: .35s cubic-bezier(.22,1,.36,1);
    }

    .assessment-feature:hover .feature-icon {
        transform: rotate(-6deg) scale(1.1);
    }

    .assessment-feature h3 {
        position: relative;
        z-index: 1;
        margin: 0 0 9px;
        color: var(--omma-text);
        font-size: 19px;
    }

    .assessment-feature p {
        position: relative;
        z-index: 1;
        margin: 0;
        color: var(--omma-muted);
        line-height: 1.65;
        font-size: 14px;
    }

    /* =========================================================
       PROCESS
       ========================================================= */

    .process-section {
        padding: 110px 7%;
        background:
            radial-gradient(circle at 80% 20%, rgba(37,99,235,.07), transparent 25%),
            #f7fbfb;
    }

    .process-container {
        max-width: 1150px;
        margin: auto;
    }

    .process-grid {
        position: relative;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .process-line {
        position: absolute;
        top: 32px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: linear-gradient(
            90deg,
            var(--omma-primary),
            var(--omma-accent),
            var(--omma-blue)
        );
        opacity: .18;
    }

    .process-step {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .process-number {
        width: 64px;
        height: 64px;
        margin: auto auto 20px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: white;
        border: 2px solid rgba(20,184,166,.18);
        color: var(--omma-primary);
        font-weight: 900;
        box-shadow: 0 12px 30px rgba(15,118,110,.10);
        transition: .35s;
    }

    .process-step:hover .process-number {
        transform: scale(1.15);
        background: var(--omma-primary);
        color: white;
        box-shadow: 0 15px 35px rgba(15,118,110,.25);
    }

    .process-step h3 {
        margin-bottom: 8px;
        color: var(--omma-text);
        font-size: 17px;
    }

    .process-step p {
        margin: 0;
        color: var(--omma-muted);
        font-size: 13px;
        line-height: 1.6;
    }

    /* =========================================================
       CTA
       ========================================================= */

    .booking-cta {
        position: relative;
        overflow: hidden;
        margin: 100px auto;
        max-width: 1120px;
        padding: 65px;
        border-radius: 35px;
        color: white;
        background:
            radial-gradient(circle at 90% 10%, rgba(255,255,255,.18), transparent 25%),
            radial-gradient(circle at 10% 90%, rgba(20,184,166,.35), transparent 30%),
            linear-gradient(135deg, #0f766e, #115e59 55%, #173f67);
        box-shadow: 0 30px 80px rgba(15,118,110,.22);
    }

    .cta-orb {
        position: absolute;
        width: 220px;
        height: 220px;
        right: -70px;
        bottom: -90px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.18);
        animation: orbFloat 7s ease-in-out infinite;
    }

    .booking-cta h2 {
        position: relative;
        z-index: 2;
        max-width: 700px;
        margin: 0 0 15px;
        font-size: clamp(32px, 4vw, 50px);
        line-height: 1.05;
        letter-spacing: -.04em;
    }

    .booking-cta p {
        position: relative;
        z-index: 2;
        max-width: 650px;
        color: rgba(255,255,255,.78);
        line-height: 1.7;
        margin-bottom: 28px;
    }

    .cta-button {
        position: relative;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 23px;
        border-radius: 13px;
        background: white;
        color: var(--omma-primary);
        text-decoration: none;
        font-weight: 900;
        transition: .3s;
    }

    .cta-button:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(0,0,0,.18);
    }

    /* =========================================================
       ANIMATIONS
       ========================================================= */

    @keyframes heroReveal {
        from {
            opacity: 0;
            transform: translateY(35px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes visualReveal {
        from {
            opacity: 0;
            transform: translateX(40px) scale(.94);
        }
        to {
            opacity: 1;
            transform: translateX(0) scale(1);
        }
    }

    @keyframes panelFloat {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }
        50% {
            transform: translateY(-12px) rotate(.5deg);
        }
    }

    @keyframes orbFloat {
        0%, 100% {
            transform: translate(0, 0);
        }
        50% {
            transform: translate(15px, -20px);
        }
    }

    @keyframes orbPulse {
        0%, 100% {
            transform: scale(1);
            opacity: .7;
        }
        50% {
            transform: scale(1.35);
            opacity: .3;
        }
    }

    @keyframes orbRotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes statusPulse {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.5);
            opacity: .55;
        }
    }

    @keyframes iconHeartbeat {
        0%, 100% {
            transform: scale(1);
        }
        8% {
            transform: scale(1.08);
        }
        16% {
            transform: scale(1);
        }
    }

    @keyframes gradientMove {
        0% {
            background-position: 0% center;
        }
        100% {
            background-position: 200% center;
        }
    }

    @keyframes progressMove {
        from {
            background-position: 0% center;
        }
        to {
            background-position: 200% center;
        }
    }

    @keyframes marquee {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(-50%);
        }
    }

    /* =========================================================
       SCROLL REVEAL
       ========================================================= */

    .reveal {
        opacity: 0;
        transform: translateY(35px);
        transition:
            opacity .8s ease,
            transform .8s cubic-bezier(.22,1,.36,1);
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal.delay-1 {
        transition-delay: .1s;
    }

    .reveal.delay-2 {
        transition-delay: .2s;
    }

    .reveal.delay-3 {
        transition-delay: .3s;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 950px) {

        .omma-hero-inner {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .hero-copy {
            text-align: center;
        }

        .hero-copy > p {
            margin-left: auto;
            margin-right: auto;
        }

        .hero-actions {
            justify-content: center;
        }

        .hero-visual {
            min-height: 470px;
        }

        .assessment-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .process-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
        }

        .process-line {
            display: none;
        }
    }

    @media (max-width: 650px) {

        .omma-hero {
            min-height: auto;
            padding: 65px 5% 60px;
        }

        .hero-copy h1 {
            font-size: 45px;
        }

        .hero-copy > p {
            font-size: 16px;
        }

        .hero-visual {
            min-height: 390px;
        }

        .assessment-orbit {
            width: 330px;
            height: 330px;
        }

        .assessment-panel {
            padding: 23px;
            border-radius: 24px;
        }

        .assessment-panel h2 {
            font-size: 24px;
        }

        .complete-section,
        .process-section {
            padding: 75px 5%;
        }

        .assessment-grid,
        .process-grid {
            grid-template-columns: 1fr;
        }

        .booking-cta {
            margin: 65px 5%;
            padding: 38px 25px;
            border-radius: 27px;
        }

        .booking-cta h2 {
            font-size: 34px;
        }

        .hero-btn {
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
            scroll-behavior: auto !important;
        }
    }
</style>




<section class="omma-hero">

    <div class="hero-orb one"></div>
    <div class="hero-orb two"></div>
    <div class="hero-orb three"></div>

    <div class="omma-hero-inner">

        <div class="hero-copy">

            <span class="hero-eyebrow">
                OMMA HEALTH CENTER
            </span>

            <h1>
                One appointment.
                <span>Complete assessment.</span>
            </h1>

            <p>
                Get your biometric and physical ability requirements
                assessed in one streamlined appointment. Our complete
                assessment covers the essential tests you need without
                making you move from one service to another.
            </p>

            <div class="hero-actions">

                <a
                    href="<?php echo e(route('booking.create')); ?>"
                    class="hero-btn primary"
                >
                    Book an appointment
                    <span>→</span>
                </a>

                <a
                    href="#assessment"
                    class="hero-btn secondary"
                >
                    Explore the assessment
                    <span>↓</span>
                </a>

            </div>

        </div>


        
        <div class="hero-visual">

            <div class="assessment-orbit"></div>

            <div class="assessment-panel">

                <div class="panel-top">

                    <div class="panel-icon">
                        🩺
                    </div>

                    <div class="panel-status">
                        Complete assessment
                    </div>

                </div>

                <h2>
                    Everything covered in one visit.
                </h2>

                <p>
                    A structured assessment designed around your
                    biometric and physical ability requirements.
                </p>

                <div class="assessment-progress">
                    <span></span>
                </div>

                <div class="assessment-list">

                    <div class="assessment-item">
                        <span class="assessment-item-icon">👁️</span>
                        Vision assessment
                    </div>

                    <div class="assessment-item">
                        <span class="assessment-item-icon">👂</span>
                        Hearing assessment
                    </div>

                    <div class="assessment-item">
                        <span class="assessment-item-icon">🗣️</span>
                        Speech assessment
                    </div>

                    <div class="assessment-item">
                        <span class="assessment-item-icon">🎨</span>
                        Colour vision
                    </div>

                    <div class="assessment-item">
                        <span class="assessment-item-icon">🫀</span>
                        Physical ability checks
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>




<section class="trust-strip">

    <div class="trust-track">

        <div class="trust-item">
            <span>✦</span>
            COMPLETE ASSESSMENT
        </div>

        <div class="trust-item">
            <span>✦</span>
            VISION & HEARING
        </div>

        <div class="trust-item">
            <span>✦</span>
            SPEECH & COLOUR VISION
        </div>

        <div class="trust-item">
            <span>✦</span>
            PHYSICAL ABILITY
        </div>

        <div class="trust-item">
            <span>✦</span>
            ONLINE & IN-PERSON
        </div>

        <div class="trust-item">
            <span>✦</span>
            EASY APPOINTMENT BOOKING
        </div>

        
        <div class="trust-item">
            <span>✦</span>
            COMPLETE ASSESSMENT
        </div>

        <div class="trust-item">
            <span>✦</span>
            VISION & HEARING
        </div>

        <div class="trust-item">
            <span>✦</span>
            SPEECH & COLOUR VISION
        </div>

        <div class="trust-item">
            <span>✦</span>
            PHYSICAL ABILITY
        </div>

        <div class="trust-item">
            <span>✦</span>
            ONLINE & IN-PERSON
        </div>

        <div class="trust-item">
            <span>✦</span>
            EASY APPOINTMENT BOOKING
        </div>

    </div>

</section>




<section
    class="complete-section"
    id="assessment"
>

    <div class="complete-container">

        <div class="section-heading reveal">

            <span class="eyebrow">
                ONE COMPLETE SERVICE
            </span>

            <h2>
                Everything you need.
                Nothing unnecessary.
            </h2>

            <p>
                Instead of navigating separate services, your appointment
                brings the required assessment areas together into one
                coordinated experience.
            </p>

        </div>


        <div class="assessment-grid">

            <article class="assessment-feature reveal delay-1">

                <div class="feature-icon">
                    👁️
                </div>

                <h3>
                    Vision
                </h3>

                <p>
                    Vision and visual acuity checks to assess your
                    required visual ability.
                </p>

            </article>


            <article class="assessment-feature reveal delay-2">

                <div class="feature-icon">
                    👂
                </div>

                <h3>
                    Hearing
                </h3>

                <p>
                    Hearing assessment designed to evaluate your
                    required auditory ability.
                </p>

            </article>


            <article class="assessment-feature reveal delay-3">

                <div class="feature-icon">
                    🗣️
                </div>

                <h3>
                    Speech
                </h3>

                <p>
                    Speech-related assessment as part of your
                    overall physical ability requirements.
                </p>

            </article>


            <article class="assessment-feature reveal delay-1">

                <div class="feature-icon">
                    🎨
                </div>

                <h3>
                    Colour Vision
                </h3>

                <p>
                    Colour vision screening included as part of
                    the complete assessment.
                </p>

            </article>


            <article class="assessment-feature reveal delay-2">

                <div class="feature-icon">
                    🩺
                </div>

                <h3>
                    Physical Ability
                </h3>

                <p>
                    Relevant physical ability checks coordinated
                    within the same assessment.
                </p>

            </article>


            <article class="assessment-feature reveal delay-3">

                <div class="feature-icon">
                    ✓
                </div>

                <h3>
                    One Assessment
                </h3>

                <p>
                    One appointment, one coordinated process and
                    a clear path toward completing your requirements.
                </p>

            </article>

        </div>

    </div>

</section>




<section class="process-section">

    <div class="process-container">

        <div class="section-heading reveal">

            <span class="eyebrow">
                SIMPLE PROCESS
            </span>

            <h2>
                Book it. Attend it. Get assessed.
            </h2>

            <p>
                We've kept the process straightforward so you can
                focus on what matters.
            </p>

        </div>


        <div class="process-grid">

            <div class="process-line"></div>


            <div class="process-step reveal">

                <div class="process-number">
                    01
                </div>

                <h3>
                    Choose your appointment
                </h3>

                <p>
                    Select online or in-person attendance.
                </p>

            </div>


            <div class="process-step reveal delay-1">

                <div class="process-number">
                    02
                </div>

                <h3>
                    Pick your time
                </h3>

                <p>
                    Choose an available date and time that works for you.
                </p>

            </div>


            <div class="process-step reveal delay-2">

                <div class="process-number">
                    03
                </div>

                <h3>
                    Complete your assessment
                </h3>

                <p>
                    Complete the required assessment areas in one appointment.
                </p>

            </div>


            <div class="process-step reveal delay-3">

                <div class="process-number">
                    04
                </div>

                <h3>
                    Move forward
                </h3>

                <p>
                    Leave with your assessment process completed and clear.
                </p>

            </div>

        </div>

    </div>


    

    <div class="booking-cta reveal">

        <div class="cta-orb"></div>

        <h2>
            Ready to complete your assessment?
        </h2>

        <p>
            Choose your preferred appointment type and reserve an
            available time at Omma Health Center.
        </p>

        <a
            href="<?php echo e(route('booking.create')); ?>"
            class="cta-button"
        >
            Schedule your appointment
            <span>→</span>
        </a>

    </div>

</section>




<script>

document.addEventListener('DOMContentLoaded', () => {

    const revealElements =
        document.querySelectorAll('.reveal');

    if (!revealElements.length) {
        return;
    }


    const observer =
        new IntersectionObserver(
            (entries, observer) => {

                entries.forEach(entry => {

                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.classList.add('visible');

                    observer.unobserve(entry.target);

                });

            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -50px 0px'
            }
        );


    revealElements.forEach(element => {
        observer.observe(element);
    });


    /*
     * Small parallax effect for the hero orbs.
     */
    const hero =
        document.querySelector('.omma-hero');

    if (hero && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {

        window.addEventListener(
            'mousemove',
            event => {

                const x =
                    (event.clientX / window.innerWidth - .5);

                const y =
                    (event.clientY / window.innerHeight - .5);


                const orbOne =
                    document.querySelector('.hero-orb.one');

                const orbTwo =
                    document.querySelector('.hero-orb.two');


                if (orbOne) {

                    orbOne.style.transform =
                        `translate(${x * 22}px, ${y * 18}px)`;
                }


                if (orbTwo) {

                    orbTwo.style.transform =
                        `translate(${x * -14}px, ${y * -12}px)`;
                }

            },
            {
                passive: true
            }
        );

    }

});

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\omma-health-center\resources\views/home.blade.php ENDPATH**/ ?>