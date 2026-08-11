@extends('layouts.app')

@section('title', 'Book an Appointment — Omma Health Center')

@section('content')

<style>
    /* =========================================================
       OMMA BOOKING EXPERIENCE
       ========================================================= */

    :root {
        --book-primary: #0f766e;
        --book-primary-dark: #115e59;
        --book-accent: #14b8a6;
        --book-blue: #2563eb;
        --book-bg: #f4faf9;
        --book-text: #102a2a;
        --book-muted: #6b7f7e;
        --book-border: rgba(15,118,110,.12);
        --book-card: rgba(255,255,255,.88);
        --book-shadow: 0 25px 70px rgba(15,118,110,.08);
    }


    /* =========================================================
       PAGE
       ========================================================= */

    .booking-page {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
        padding: 55px 5% 90px;

        background:
            radial-gradient(
                circle at 90% 5%,
                rgba(20,184,166,.14),
                transparent 26%
            ),
            radial-gradient(
                circle at 0% 40%,
                rgba(37,99,235,.08),
                transparent 28%
            ),
            linear-gradient(
                180deg,
                #f8fcfb 0%,
                #f1f8f7 100%
            );
    }


    /* =========================================================
       BACKGROUND ANIMATION
       ========================================================= */

    .booking-bg-orb {
        position: absolute;
        pointer-events: none;
        border-radius: 50%;
        border: 1px solid rgba(20,184,166,.12);
    }


    .booking-bg-orb.one {
        width: 420px;
        height: 420px;
        right: -190px;
        top: 80px;
        animation: floatOrb 10s ease-in-out infinite;
    }


    .booking-bg-orb.two {
        width: 230px;
        height: 230px;
        left: -110px;
        bottom: 120px;
        border-color: rgba(37,99,235,.10);
        animation: floatOrb 8s ease-in-out infinite reverse;
    }


    .booking-bg-orb.three {
        width: 90px;
        height: 90px;
        right: 27%;
        top: 17%;
        background: rgba(20,184,166,.035);
        border: 0;
        animation: tinyFloat 5s ease-in-out infinite;
    }


    /* =========================================================
       CONTAINER
       ========================================================= */

    .booking-container {
        position: relative;
        z-index: 2;
        max-width: 1220px;
        margin: auto;
    }


    /* =========================================================
       HEADER
       ========================================================= */

    .booking-header {
        max-width: 760px;
        margin: 0 auto 42px;
        text-align: center;
        animation: revealUp .8s cubic-bezier(.22,1,.36,1) both;
    }


    .booking-header .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 15px;
        color: var(--book-primary);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .18em;
    }


    .booking-header .eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--book-accent);
        box-shadow: 0 0 0 5px rgba(20,184,166,.10);
        animation: pulse 2s infinite;
    }


    .booking-header h1 {
        margin: 0 0 14px;
        color: var(--book-text);
        font-size: clamp(38px, 5vw, 62px);
        line-height: .98;
        letter-spacing: -.055em;
    }


    .booking-header p {
        max-width: 650px;
        margin: auto;
        color: var(--book-muted);
        font-size: 15px;
        line-height: 1.75;
    }


    /* =========================================================
       PROGRESS
       ========================================================= */

    .booking-progress {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 650px;
        margin: 0 auto 40px;
    }


    .progress-step {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #9aabaa;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: .08em;
        white-space: nowrap;
    }


    .progress-number {
        width: 32px;
        height: 32px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: white;
        border: 1px solid var(--book-border);
        color: var(--book-muted);
        transition: .35s ease;
    }


    .progress-step.active {
        color: var(--book-primary);
    }


    .progress-step.active .progress-number {
        color: white;
        background:
            linear-gradient(
                135deg,
                var(--book-primary),
                var(--book-accent)
            );
        border-color: transparent;
        box-shadow: 0 8px 20px rgba(15,118,110,.18);
    }


    .progress-line {
        width: 75px;
        height: 1px;
        margin: 0 13px;
        background: rgba(15,118,110,.13);
    }


    /* =========================================================
       ERROR
       ========================================================= */

    .booking-error {
        position: relative;
        max-width: 900px;
        margin: 0 auto 25px;
        padding: 18px 20px;
        border-radius: 17px;
        color: #991b1b;
        background: #fff5f5;
        border: 1px solid #fecaca;
        box-shadow: 0 12px 35px rgba(153,27,27,.06);
        animation: shakeIn .5s ease both;
    }


    .booking-error strong {
        display: block;
        margin-bottom: 8px;
    }


    .booking-error ul {
        margin: 0;
        padding-left: 20px;
        font-size: 13px;
        line-height: 1.7;
    }


    /* =========================================================
       LAYOUT
       ========================================================= */

    .booking-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.55fr) minmax(330px, .75fr);
        gap: 25px;
        align-items: start;
    }


    /* =========================================================
       MAIN CARD
       ========================================================= */

    .booking-card {
        overflow: hidden;
        border-radius: 28px;
        background: var(--book-card);
        border: 1px solid var(--book-border);
        box-shadow: var(--book-shadow);
        backdrop-filter: blur(18px);
        animation:
            revealUp .8s
            cubic-bezier(.22,1,.36,1)
            .12s both;
    }


    .booking-card-header {
        position: relative;
        overflow: hidden;
        padding: 30px 32px;
        border-bottom: 1px solid rgba(15,118,110,.08);
        background:
            radial-gradient(
                circle at 100% 0%,
                rgba(20,184,166,.10),
                transparent 25%
            ),
            white;
    }


    .booking-card-header::after {
        content: "✦";
        position: absolute;
        right: 35px;
        top: 24px;
        color: rgba(20,184,166,.16);
        font-size: 30px;
        animation: sparkle 3s ease-in-out infinite;
    }


    .booking-card-header h2 {
        margin: 0 0 7px;
        color: var(--book-text);
        font-size: 23px;
        letter-spacing: -.025em;
    }


    .booking-card-header p {
        margin: 0;
        color: var(--book-muted);
        font-size: 13px;
    }


    /* =========================================================
       SECTIONS
       ========================================================= */

    .booking-section {
        padding: 31px 32px;
        border-bottom: 1px solid rgba(15,118,110,.07);
    }


    .booking-section:last-child {
        border-bottom: 0;
    }


    .section-title {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-bottom: 22px;
    }


    .section-number {
        width: 34px;
        height: 34px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 11px;
        color: white;
        background:
            linear-gradient(
                135deg,
                var(--book-primary),
                var(--book-accent)
            );
        font-size: 13px;
        font-weight: 900;
        box-shadow: 0 8px 18px rgba(15,118,110,.14);
    }


    .section-title h3 {
        margin: 1px 0 4px;
        color: var(--book-text);
        font-size: 16px;
    }


    .section-title p {
        margin: 0;
        color: var(--book-muted);
        font-size: 12px;
        line-height: 1.5;
    }


    /* =========================================================
       HIDDEN RADIO
       ========================================================= */

    .hidden-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }


    /* =========================================================
       APPOINTMENT OPTIONS
       ========================================================= */

    .appointment-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 13px;
    }


    .appointment-option {
        position: relative;
        display: flex;
        align-items: center;
        gap: 13px;
        min-height: 105px;
        padding: 17px;
        border-radius: 17px;
        background: white;
        border: 1.5px solid rgba(15,118,110,.10);
        cursor: pointer;
        transition:
            transform .3s cubic-bezier(.22,1,.36,1),
            border-color .3s ease,
            box-shadow .3s ease,
            background .3s ease;
    }


    .appointment-option:hover {
        transform: translateY(-3px);
        border-color: rgba(20,184,166,.32);
        box-shadow: 0 14px 30px rgba(15,118,110,.08);
    }


    .hidden-radio:checked + .appointment-option {
        border-color: var(--book-accent);
        background:
            linear-gradient(
                135deg,
                rgba(20,184,166,.07),
                rgba(37,99,235,.035)
            );
        box-shadow:
            0 15px 35px rgba(15,118,110,.11),
            inset 0 0 0 1px rgba(20,184,166,.08);
        transform: translateY(-2px);
    }


    .option-icon {
        width: 48px;
        height: 48px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 14px;
        background: linear-gradient(135deg, #e7faf7, #eef5ff);
        font-size: 21px;
        transition: transform .35s cubic-bezier(.22,1,.36,1);
    }


    .appointment-option:hover .option-icon,
    .hidden-radio:checked + .appointment-option .option-icon {
        transform: scale(1.08) rotate(-4deg);
    }


    .option-content {
        padding-right: 20px;
    }


    .option-content h4 {
        margin: 0 0 5px;
        color: var(--book-text);
        font-size: 14px;
    }


    .option-content p {
        margin: 0;
        color: var(--book-muted);
        font-size: 11px;
        line-height: 1.55;
    }


    .option-check {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 17px;
        height: 17px;
        border-radius: 50%;
        border: 1.5px solid #ccd9d7;
        transition: .3s ease;
    }


    .hidden-radio:checked + .appointment-option .option-check {
        border-color: var(--book-accent);
        background: var(--book-accent);
        box-shadow: 0 0 0 4px rgba(20,184,166,.10);
    }


    .hidden-radio:checked + .appointment-option .option-check::after {
        content: "✓";
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-53%);
        color: white;
        font-size: 10px;
        font-weight: 900;
    }


    /* =========================================================
       ASSESSMENT BOX
       ========================================================= */

    .assessment-box {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        margin-top: 18px;
        padding: 16px;
        border-radius: 15px;
        background: rgba(37,99,235,.045);
        border: 1px solid rgba(37,99,235,.08);
    }


    .assessment-icon {
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 11px;
        background: white;
        box-shadow: 0 6px 15px rgba(37,99,235,.07);
    }


    .assessment-box strong {
        display: block;
        margin-bottom: 4px;
        color: var(--book-text);
        font-size: 12px;
    }


    .assessment-box p {
        margin: 0;
        color: var(--book-muted);
        font-size: 11px;
        line-height: 1.65;
    }


    /* =========================================================
       DATE GRID
       ========================================================= */

    .date-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 9px;
    }


    .date-option {
        min-height: 91px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 3px;
        border-radius: 15px;
        background: white;
        border: 1.5px solid rgba(15,118,110,.09);
        cursor: pointer;
        transition:
            transform .3s cubic-bezier(.22,1,.36,1),
            background .3s ease,
            border-color .3s ease,
            box-shadow .3s ease;
    }


    .date-option:hover {
        transform: translateY(-4px);
        border-color: rgba(20,184,166,.30);
        box-shadow: 0 12px 25px rgba(15,118,110,.08);
    }


    .hidden-radio:checked + .date-option {
        color: white;
        border-color: transparent;
        background:
            linear-gradient(
                145deg,
                var(--book-primary),
                var(--book-accent)
            );
        box-shadow:
            0 13px 27px rgba(15,118,110,.19);
        transform: translateY(-3px);
    }


    .date-day {
        color: var(--book-muted);
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
    }


    .date-number {
        color: var(--book-text);
        font-size: 23px;
        font-weight: 900;
        line-height: 1;
    }


    .date-month {
        color: var(--book-muted);
        font-size: 9px;
        font-weight: 700;
    }


    .hidden-radio:checked + .date-option .date-day,
    .hidden-radio:checked + .date-option .date-number,
    .hidden-radio:checked + .date-option .date-month {
        color: white;
    }


    /* =========================================================
       AVAILABILITY
       ========================================================= */

    .availability {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
        padding: 8px 11px;
        border-radius: 999px;
        color: var(--book-primary);
        background: rgba(20,184,166,.07);
        font-size: 10px;
        font-weight: 800;
    }


    .availability-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 0 4px rgba(34,197,94,.10);
        animation: pulse 1.8s infinite;
    }


    /* =========================================================
       TIME GRID
       ========================================================= */

    .time-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 9px;
    }


    .time-option {
        min-height: 47px;
        display: grid;
        place-items: center;
        padding: 8px;
        border-radius: 12px;
        color: var(--book-text);
        background: white;
        border: 1.5px solid rgba(15,118,110,.09);
        cursor: pointer;
        font-size: 11px;
        font-weight: 800;
        transition:
            transform .25s ease,
            border-color .25s ease,
            background .25s ease,
            color .25s ease,
            box-shadow .25s ease;
    }


    .time-option:hover {
        transform: translateY(-3px);
        border-color: rgba(20,184,166,.30);
        box-shadow: 0 10px 20px rgba(15,118,110,.07);
    }


    .hidden-radio:checked + .time-option {
        color: white;
        border-color: transparent;
        background:
            linear-gradient(
                135deg,
                var(--book-primary),
                var(--book-accent)
            );
        box-shadow: 0 10px 22px rgba(15,118,110,.17);
        transform: translateY(-2px);
    }


    /* =========================================================
       NO SLOTS
       ========================================================= */

    .no-slots {
        margin-top: 15px;
        padding: 28px;
        text-align: center;
        border-radius: 17px;
        background: rgba(245,158,11,.06);
        border: 1px dashed rgba(245,158,11,.25);
        color: #92711b;
    }


    .no-slots strong {
        display: block;
        margin: 8px 0 4px;
    }


    .no-slots p {
        margin: 0;
        font-size: 12px;
    }


    /* =========================================================
       SUMMARY
       ========================================================= */

    .summary-card {
        position: sticky;
        top: 25px;
        overflow: hidden;
        padding: 29px;
        border-radius: 28px;
        color: white;
        background:
            radial-gradient(
                circle at 90% 5%,
                rgba(255,255,255,.17),
                transparent 26%
            ),
            radial-gradient(
                circle at 0% 100%,
                rgba(20,184,166,.25),
                transparent 30%
            ),
            linear-gradient(
                145deg,
                #0f766e,
                #115e59 55%,
                #173f67
            );
        box-shadow:
            0 28px 70px rgba(15,118,110,.21);
        animation:
            revealRight .9s
            cubic-bezier(.22,1,.36,1)
            .25s both;
    }


    .summary-card::before {
        content: "";
        position: absolute;
        width: 210px;
        height: 210px;
        right: -105px;
        bottom: -110px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,.12);
        animation: floatOrb 8s ease-in-out infinite;
    }


    .summary-label {
        position: relative;
        z-index: 1;
        display: block;
        margin-bottom: 10px;
        color: rgba(255,255,255,.62);
        font-size: 9px;
        font-weight: 900;
        letter-spacing: .16em;
    }


    .summary-card h2.summary-label {
        margin-bottom: 10px;
        color: white;
        font-size: 22px;
        line-height: 1.2;
        letter-spacing: -.025em;
        text-transform: none;
    }


    .summary-subtitle {
        position: relative;
        z-index: 1;
        margin-bottom: 22px;
        color: rgba(255,255,255,.68);
        font-size: 11px;
        line-height: 1.65;
    }


    .summary-type {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 999px;
        color: white;
        background: rgba(255,255,255,.11);
        border: 1px solid rgba(255,255,255,.10);
        font-size: 10px;
        font-weight: 800;
        backdrop-filter: blur(10px);
        transition: .35s ease;
    }


    .summary-divider {
        height: 1px;
        margin: 23px 0;
        background: rgba(255,255,255,.12);
    }


    .summary-row {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }


    .summary-row-icon {
        width: 41px;
        height: 41px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border-radius: 12px;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.09);
        font-size: 17px;
    }


    .summary-row small {
        display: block;
        margin-bottom: 3px;
        color: rgba(255,255,255,.47);
        font-size: 8px;
        font-weight: 900;
        letter-spacing: .12em;
    }


    .summary-row strong {
        display: block;
        color: white;
        font-size: 12px;
    }


    /* =========================================================
       SUBMIT
       ========================================================= */

    .submit-btn {
        position: relative;
        z-index: 2;
        width: 100%;
        min-height: 55px;
        margin-top: 15px;
        overflow: hidden;
        border: 0;
        border-radius: 15px;
        color: var(--book-primary-dark);
        background: white;
        font-size: 13px;
        font-weight: 900;
        cursor: pointer;
        box-shadow: 0 14px 30px rgba(0,0,0,.12);
        transition:
            transform .3s cubic-bezier(.22,1,.36,1),
            box-shadow .3s ease;
    }


    .submit-btn::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 70%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(20,184,166,.15),
            transparent
        );
        transform: skewX(-20deg);
        transition: .65s;
    }


    .submit-btn:hover::before {
        left: 130%;
    }


    .submit-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 38px rgba(0,0,0,.17);
    }


    .submit-btn:active {
        transform: translateY(0);
    }


    .secure-note {
        position: relative;
        z-index: 1;
        margin-top: 14px;
        text-align: center;
        color: rgba(255,255,255,.48);
        font-size: 9px;
    }


    /* =========================================================
       JAVASCRIPT SELECTION EFFECT
       ========================================================= */

    .selection-pop {
        animation: selectionPop .35s ease;
    }


    @keyframes selectionPop {
        0% {
            transform: scale(.97);
        }

        55% {
            transform: scale(1.025);
        }

        100% {
            transform: scale(1);
        }
    }


    /* =========================================================
       ANIMATIONS
       ========================================================= */

    @keyframes revealUp {
        from {
            opacity: 0;
            transform: translateY(28px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    @keyframes revealRight {
        from {
            opacity: 0;
            transform: translateX(35px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }


    @keyframes floatOrb {
        0%, 100% {
            transform: translate(0, 0);
        }

        50% {
            transform: translate(14px, -18px);
        }
    }


    @keyframes tinyFloat {
        0%, 100% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-15px) rotate(8deg);
        }
    }


    @keyframes pulse {
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


    @keyframes shakeIn {
        0% {
            opacity: 0;
            transform: translateX(-8px);
        }

        30% {
            transform: translateX(8px);
        }

        60% {
            transform: translateX(-4px);
        }

        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 950px) {

        .booking-layout {
            grid-template-columns: 1fr;
        }

        .summary-card {
            position: relative;
            top: auto;
        }
    }


    @media (max-width: 700px) {

        .booking-page {
            padding: 40px 4% 70px;
        }

        .booking-header h1 {
            font-size: 42px;
        }

        .booking-progress {
            transform: scale(.85);
        }

        .appointment-options {
            grid-template-columns: 1fr;
        }

        .date-grid {
            grid-template-columns: repeat(4, 1fr);
        }

        .time-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .booking-section,
        .booking-card-header,
        .summary-card {
            padding: 24px;
        }
    }


    @media (max-width: 460px) {

        .booking-progress {
            display: none;
        }

        .booking-header {
            margin-bottom: 30px;
        }

        .booking-header h1 {
            font-size: 36px;
        }

        .date-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .time-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .date-option {
            min-height: 82px;
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


<section class="booking-page">

    {{-- Animated background --}}

    <div class="booking-bg-orb one"></div>
    <div class="booking-bg-orb two"></div>
    <div class="booking-bg-orb three"></div>


    <div class="booking-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="booking-header">

            <span class="eyebrow">
                OMMA HEALTH CENTER
            </span>

            <h1>
                Schedule your appointment
            </h1>

            <p>
                Book your biometric and physical ability assessment.
                Choose how you would like to attend, then select a
                convenient date and time.
            </p>

        </header>


        {{-- =====================================================
             PROGRESS
        ====================================================== --}}

        <div class="booking-progress">

            <div class="progress-step active">

                <span class="progress-number">
                    1
                </span>

                Details

            </div>


            <div class="progress-line"></div>


            <div class="progress-step">

                <span class="progress-number">
                    2
                </span>

                Payment

            </div>


            <div class="progress-line"></div>


            <div class="progress-step">

                <span class="progress-number">
                    3
                </span>

                Confirmation

            </div>

        </div>


        {{-- =====================================================
             ERRORS
        ====================================================== --}}

        @if ($errors->any())

            <div class="booking-error">

                <strong>
                    We couldn't complete your booking.
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             FORM
        ====================================================== --}}

        <form
            method="POST"
            action="{{ route('booking.store') }}"
            id="booking-form"
        >

            @csrf


            <div class="booking-layout">


                {{-- =================================================
                     LEFT
                ================================================== --}}

                <div class="booking-card">


                    {{-- Card header --}}

                    <div class="booking-card-header">

                        <h2>
                            Appointment details
                        </h2>

                        <p>
                            Complete the steps below to reserve your slot.
                        </p>

                    </div>


                    {{-- =================================================
                         TYPE
                    ================================================== --}}

                    <section class="booking-section">

                        <div class="section-title">

                            <span class="section-number">
                                1
                            </span>

                            <div>

                                <h3>
                                    How would you like to attend?
                                </h3>

                                <p>
                                    Select online or in-person attendance.
                                </p>
                            

@if (old('category', 'online') === 'online')

    <div class="google-connect-box">

     

        <div class="google-connect-content">

            <strong>
                Connect Google Calendar
            </strong>

            <p>
                Connect your Google account to automatically create
                a Google Meet link for your online appointment.
            </p>

            @if (session('google_token'))

                <div class="google-connected">
                    <span class="google-status-dot"></span>
                    Google Calendar connected
                </div>

            @else

                <a
                    href="{{ route('google.connect') }}"
                    class="google-connect-btn"
                >
                    Connect Google Calendar
                    <span>→</span>
                </a>

            @endif

        </div>

    </div>

@endif

                            </div>

                        </div>


                        <div class="appointment-options">


                            {{-- ONLINE --}}

                            <input
                                type="radio"
                                name="category"
                                id="online"
                                value="online"
                                class="hidden-radio"
                                required
                                {{ old('category', 'online') === 'online'
                                    ? 'checked'
                                    : '' }}
                            >


                            <label
                                for="online"
                                class="appointment-option"
                            >

                                <div class="option-icon">
                                    🎥
                                </div>

                                <div class="option-content">

                                    <h4>
                                        Online appointment
                                    </h4>

                                    <p>
                                        Join remotely using a Google Meet link.
                                    </p>

                                </div>

                                <span class="option-check"></span>

                            </label>


                            {{-- PHYSICAL --}}

                            <input
                                type="radio"
                                name="category"
                                id="physical"
                                value="physical"
                                class="hidden-radio"
                                {{ old('category') === 'physical'
                                    ? 'checked'
                                    : '' }}
                            >


                            <label
                                for="physical"
                                class="appointment-option"
                            >

                                <div class="option-icon">
                                    📍
                                </div>

                                <div class="option-content">

                                    <h4>
                                        In-person appointment
                                    </h4>

                                    <p>
                                        Visit our health center for your assessment.
                                    </p>

                                </div>

                                <span class="option-check"></span>

                            </label>


                        </div>


                        {{-- Assessment information --}}

                        <div class="assessment-box">

                            <div class="assessment-icon">
                                🩺
                            </div>

                            <div>

                                <strong>
                                    Complete biometric assessment
                                </strong>

                                <p>
                                    Your appointment covers vision, hearing,
                                    speech, colour vision and other required
                                    physical ability tests.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         DATE
                    ================================================== --}}

                    <section class="booking-section">

                        <div class="section-title">

                            <span class="section-number">
                                2
                            </span>

                            <div>

                                <h3>
                                    Select a date
                                </h3>

                                <p>
                                    Choose from the available dates below.
                                </p>

                            </div>

                        </div>


                        <div class="date-grid">

                            @for ($i = 0; $i < 14; $i++)

                                @php

                                    $d = now()->addDays($i);

                                    $date = $d->toDateString();

                                @endphp


                                <input
                                    type="radio"
                                    name="appointment_date"
                                    id="date-{{ $i }}"
                                    value="{{ $date }}"
                                    class="hidden-radio"
                                    required
                                    data-date="{{ $date }}"

                                    {{ old('appointment_date') === $date ||
                                       (!old('appointment_date') && $i === 0)
                                        ? 'checked'
                                        : '' }}
                                >


                                <label
                                    for="date-{{ $i }}"
                                    class="date-option"
                                >

                                    <span class="date-day">
                                        {{ $d->format('D') }}
                                    </span>

                                    <span class="date-number">
                                        {{ $d->format('j') }}
                                    </span>

                                    <span class="date-month">
                                        {{ $d->format('M') }}
                                    </span>

                                </label>

                            @endfor

                        </div>

                    </section>


                    {{-- =================================================
                         TIME
                    ================================================== --}}

                    <section class="booking-section">

                        <div class="section-title">

                            <span class="section-number">
                                3
                            </span>

                            <div>

                                <h3>
                                    Select a time
                                </h3>

                                <p>
                                    Green slots are available for booking.
                                </p>

                            </div>

                        </div>


                        <div class="availability">

                            <span class="availability-dot"></span>

                            Available appointment times

                        </div>


                        <div
                            class="time-grid"
                            id="time-grid"
                        >

                            @foreach ($timeSlots as $slot)

                                @php
                                    $timeId = str_replace(':', '-', $slot);
                                @endphp


                                <input
                                    type="radio"
                                    name="appointment_time"
                                    id="time-{{ $timeId }}"
                                    value="{{ $slot }}"
                                    class="hidden-radio"
                                    required
                                    data-time="{{ $slot }}"
                                >


                                <label
                                    for="time-{{ $timeId }}"
                                    class="time-option"
                                    data-time="{{ $slot }}"
                                >

                                    {{ \Carbon\Carbon::createFromFormat('H:i', $slot)->format('g:i A') }}

                                </label>

                            @endforeach

                        </div>


                        <div
                            id="no-slots"
                            class="no-slots"
                            style="display:none;"
                        >

                            <div style="font-size:24px;">
                                ⏰
                            </div>

                            <strong>
                                No slots available
                            </strong>

                            <p>
                                Please choose another date.
                            </p>

                        </div>

                    </section>

                </div>


                {{-- =================================================
                     RIGHT SUMMARY
                ================================================== --}}

                <aside class="summary-card">

                    <span class="summary-label">
                        APPOINTMENT SUMMARY
                    </span>


                    <h2 class="summary-label">
                        Biometric & Physical Ability Assessment
                    </h2>


                    <div class="summary-subtitle">
                        Complete assessment for your required
                        physical abilities and biometric requirements.
                    </div>


                    <div
                        id="summary-type"
                        class="summary-type"
                    >
                        🎥 Online appointment
                    </div>


                    <div class="summary-divider"></div>


                    {{-- DATE --}}

                    <div class="summary-row">

                        <div class="summary-row-icon">
                            📅
                        </div>

                        <div>

                            <small>
                                DATE
                            </small>

                            <strong id="summary-date">
                                Select a date
                            </strong>

                        </div>

                    </div>


                    {{-- TIME --}}

                    <div class="summary-row">

                        <div class="summary-row-icon">
                            ⏰
                        </div>

                        <div>

                            <small>
                                TIME
                            </small>

                            <strong id="summary-time">
                                Select a time
                            </strong>

                        </div>

                    </div>


                    <button
                        type="submit"
                        class="submit-btn"
                    >
                        Proceed to Payment
                        &nbsp; →
                    </button>


                    <div class="secure-note">
                        🔒 Your appointment information is secure.
                    </div>

                </aside>

            </div>

        </form>

    </div>

</section>

@endsection


@section('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('booking-form');

    if (!form) {
        return;
    }


    const summaryType = document.getElementById('summary-type');
    const summaryDate = document.getElementById('summary-date');
    const summaryTime = document.getElementById('summary-time');


    /*
     * ---------------------------------------------------------
     * SUMMARY ANIMATION
     * ---------------------------------------------------------
     */

    function animateSummary(element) {

        element.classList.remove('selection-pop');

        void element.offsetWidth;

        element.classList.add('selection-pop');

    }


    /*
     * ---------------------------------------------------------
     * APPOINTMENT TYPE
     * ---------------------------------------------------------
     */

    const categoryInputs = form.querySelectorAll(
        'input[name="category"]'
    );


    categoryInputs.forEach(function (input) {

        input.addEventListener('change', function () {

            if (this.value === 'online') {

                summaryType.textContent =
                    '🎥 Online appointment';

            } else {

                summaryType.textContent =
                    '📍 In-person appointment';

            }


            animateSummary(summaryType);

        });

    });


    /*
     * ---------------------------------------------------------
     * DATE
     * ---------------------------------------------------------
     */

    const dateInputs = form.querySelectorAll(
        'input[name="appointment_date"]'
    );


    dateInputs.forEach(function (input) {

        input.addEventListener('change', function () {

            const selectedDate = new Date(
                this.value + 'T00:00:00'
            );


            if (!isNaN(selectedDate.getTime())) {

                summaryDate.textContent =
                    selectedDate.toLocaleDateString(
                        'en-US',
                        {
                            weekday: 'short',
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        }
                    );

            }


            animateSummary(summaryDate);

        });

    });


    /*
     * ---------------------------------------------------------
     * TIME
     * ---------------------------------------------------------
     */

    const timeInputs = form.querySelectorAll(
        'input[name="appointment_time"]'
    );


    timeInputs.forEach(function (input) {

        input.addEventListener('change', function () {

            const parts = this.value.split(':');

            let hour = parseInt(parts[0], 10);

            const minute = parts[1];

            const suffix = hour >= 12
                ? 'PM'
                : 'AM';

            hour = hour % 12 || 12;


            summaryTime.textContent =
                hour + ':' + minute + ' ' + suffix;


            animateSummary(summaryTime);

        });

    });


    /*
     * ---------------------------------------------------------
     * BUTTON LOADING STATE
     * ---------------------------------------------------------
     */

    form.addEventListener('submit', function () {

        const button = form.querySelector('.submit-btn');

        if (!button) {
            return;
        }


        if (!form.checkValidity()) {
            return;
        }


        button.disabled = true;

        button.innerHTML =
            'Confirming appointment <span>•••</span>';

        button.style.opacity = '.8';

    });


    /*
     * ---------------------------------------------------------
     * INITIAL SUMMARY
     * ---------------------------------------------------------
     */

    const checkedCategory =
        form.querySelector(
            'input[name="category"]:checked'
        );

    if (checkedCategory) {

        checkedCategory.dispatchEvent(
            new Event('change')
        );

    }


    const checkedDate =
        form.querySelector(
            'input[name="appointment_date"]:checked'
        );

    if (checkedDate) {

        checkedDate.dispatchEvent(
            new Event('change')
        );

    }


    /*
     * ---------------------------------------------------------
     * DATE / TIME HOVER MAGNETIC EFFECT
     * ---------------------------------------------------------
     */

    const interactiveOptions =
        form.querySelectorAll(
            '.appointment-option, .date-option, .time-option'
        );


    interactiveOptions.forEach(function (element) {

        element.addEventListener(
            'mousemove',
            function (event) {

                const rect =
                    element.getBoundingClientRect();

                const x =
                    event.clientX - rect.left;

                const y =
                    event.clientY - rect.top;

                const moveX =
                    (x / rect.width - .5) * 3;

                const moveY =
                    (y / rect.height - .5) * 3;


                element.style.transform =
                    `translate(${moveX}px, ${moveY}px)`;

            }
        );


        element.addEventListener(
            'mouseleave',
            function () {

                element.style.transform = '';

            }
        );

    });

});
</script>

@endsection