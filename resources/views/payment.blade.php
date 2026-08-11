@extends('layouts.app')

@section('title', 'Complete Payment — Omma Health Center')

@section('content')

<style>
    /* =========================================================
       OMMA PAYMENT EXPERIENCE
       ========================================================= */

    :root {
        --pay-primary: #0f766e;
        --pay-primary-dark: #115e59;
        --pay-accent: #14b8a6;
        --pay-blue: #2563eb;
        --pay-bg: #f4faf9;
        --pay-text: #102a2a;
        --pay-muted: #6b7f7e;
        --pay-border: rgba(15,118,110,.12);
        --pay-card: rgba(255,255,255,.92);
        --pay-shadow: 0 25px 70px rgba(15,118,110,.08);
    }

    .payment-page {
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

    .payment-container {
        position: relative;
        z-index: 2;
        max-width: 1140px;
        margin: auto;
    }

    .payment-header {
        max-width: 760px;
        margin: 0 auto 35px;
        text-align: center;
        animation: revealUp .8s cubic-bezier(.22,1,.36,1) both;
    }

    .payment-header .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 12px;
        color: var(--pay-primary);
        font-size: 11px;
        font-weight: 900;
        letter-spacing: .18em;
        text-transform: uppercase;
    }

    .payment-header .eyebrow::before {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--pay-accent);
        box-shadow: 0 0 0 5px rgba(20,184,166,.10);
        animation: pulse 2s infinite;
    }

    .payment-header h1 {
        margin: 0 0 10px;
        color: var(--pay-text);
        font-size: clamp(32px, 4.5vw, 52px);
        line-height: 1.05;
        letter-spacing: -.04em;
    }

    .payment-header p {
        max-width: 600px;
        margin: auto;
        color: var(--pay-muted);
        font-size: 15px;
        line-height: 1.6;
    }

    /* PROGRESS BAR */
    .payment-progress {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 600px;
        margin: 0 auto 35px;
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
        border: 1px solid var(--pay-border);
        color: var(--pay-muted);
        transition: .35s ease;
    }

    .progress-step.done {
        color: var(--pay-primary);
    }

    .progress-step.done .progress-number {
        background: #e6f4f1;
        color: var(--pay-primary);
        border-color: var(--pay-accent);
    }

    .progress-step.active {
        color: var(--pay-primary);
    }

    .progress-step.active .progress-number {
        color: white;
        background: linear-gradient(135deg, var(--pay-primary), var(--pay-accent));
        border-color: transparent;
        box-shadow: 0 8px 20px rgba(15,118,110,.18);
    }

    .progress-line {
        width: 65px;
        height: 1px;
        margin: 0 13px;
        background: rgba(15,118,110,.15);
    }

    /* ERROR ALERT */
    .payment-error {
        max-width: 900px;
        margin: 0 auto 25px;
        padding: 16px 22px;
        border-radius: 16px;
        color: #991b1b;
        background: #fef2f2;
        border: 1px solid #fecaca;
        box-shadow: 0 10px 30px rgba(153,27,27,.05);
    }

    .payment-error ul {
        margin: 5px 0 0;
        padding-left: 20px;
        font-size: 13px;
    }

    /* LAYOUT */
    .payment-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.25fr) minmax(360px, 1fr);
        gap: 28px;
        align-items: start;
    }

    /* CARDS */
    .pay-card {
        overflow: hidden;
        border-radius: 24px;
        background: var(--pay-card);
        border: 1px solid var(--pay-border);
        box-shadow: var(--pay-shadow);
        backdrop-filter: blur(16px);
        padding: 30px;
    }

    .pay-card-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid rgba(15,118,110,.08);
    }

    .pay-card-title h2 {
        margin: 0;
        font-size: 20px;
        color: var(--pay-text);
        letter-spacing: -.02em;
    }

    .amount-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 20px;
        background: rgba(20,184,166,.10);
        color: var(--pay-primary-dark);
        font-size: 15px;
        font-weight: 800;
    }

    /* QR IMAGE WRAPPER */
    .qr-container {
        text-align: center;
        margin: 20px 0;
        padding: 24px;
        border-radius: 20px;
        background: white;
        border: 2px dashed rgba(15,118,110,.18);
        transition: transform .3s ease, border-color .3s ease;
    }

    .qr-container:hover {
        border-color: var(--pay-accent);
        transform: translateY(-2px);
    }

    .qr-img {
        max-width: 260px;
        width: 100%;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
        border: 1px solid rgba(0,0,0,.05);
    }

    .qr-placeholder {
        padding: 35px 20px;
        background: linear-gradient(135deg, #f0fdfa 0%, #e0f2fe 100%);
        border-radius: 16px;
        color: var(--pay-primary-dark);
    }

    .qr-placeholder-icon {
        font-size: 44px;
        margin-bottom: 10px;
    }

    .account-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin: 20px 0;
    }

    .account-info-item {
        padding: 14px 16px;
        background: #f8fafc;
        border-radius: 14px;
        border: 1px solid rgba(15,118,110,.07);
    }

    .account-info-item small {
        display: block;
        color: var(--pay-muted);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin-bottom: 4px;
    }

    .account-info-item strong {
        color: var(--pay-text);
        font-size: 14px;
        word-break: break-all;
    }

    .instructions-box {
        padding: 16px 20px;
        background: rgba(15,118,110,.04);
        border-radius: 14px;
        border-left: 4px solid var(--pay-primary);
        font-size: 13px;
        color: var(--pay-text);
        line-height: 1.6;
        white-space: pre-line;
    }

    /* SUMMARY RIGHT CARD */
    .summary-mini {
        padding: 18px 20px;
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(15,118,110,.09);
        margin-bottom: 22px;
    }

    .summary-mini-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px dashed rgba(0,0,0,.06);
        font-size: 13px;
    }

    .summary-mini-item:last-child {
        border-bottom: 0;
    }

    .summary-mini-label {
        color: var(--pay-muted);
        font-weight: 600;
    }

    .summary-mini-val {
        color: var(--pay-text);
        font-weight: 700;
    }

    /* UPLOAD DROPZONE */
    .upload-zone {
        position: relative;
        border: 2px dashed rgba(15,118,110,.25);
        border-radius: 18px;
        padding: 30px 20px;
        text-align: center;
        background: white;
        cursor: pointer;
        transition: all .3s ease;
    }

    .upload-zone:hover, .upload-zone.dragover {
        border-color: var(--pay-accent);
        background: rgba(20,184,166,.03);
    }

    .upload-file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .upload-icon {
        font-size: 38px;
        margin-bottom: 8px;
        color: var(--pay-primary);
    }

    .upload-title {
        color: var(--pay-text);
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .upload-sub {
        color: var(--pay-muted);
        font-size: 12px;
    }

    .preview-container {
        display: none;
        margin-top: 15px;
        padding: 12px;
        background: #f8fafc;
        border-radius: 14px;
        border: 1px solid rgba(15,118,110,.1);
        align-items: center;
        gap: 14px;
    }

    .preview-thumb {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,.1);
    }

    .preview-info {
        flex: 1;
        text-align: left;
        overflow: hidden;
    }

    .preview-info strong {
        display: block;
        font-size: 13px;
        color: var(--pay-text);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .preview-info small {
        color: var(--pay-muted);
        font-size: 11px;
    }

    .form-group {
        margin-top: 20px;
    }

    .form-label {
        display: block;
        margin-bottom: 7px;
        font-size: 13px;
        font-weight: 700;
        color: var(--pay-text);
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 12px;
        border: 1px solid var(--pay-border);
        font-size: 14px;
        background: white;
        transition: border-color .25s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--pay-accent);
        box-shadow: 0 0 0 4px rgba(20,184,166,.10);
    }

    .submit-pay-btn {
        width: 100%;
        margin-top: 25px;
        padding: 16px;
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--pay-primary), var(--pay-accent));
        color: white;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 12px 30px rgba(15,118,110,.25);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .submit-pay-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(15,118,110,.32);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 16px;
        color: var(--pay-muted);
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: color .2s ease;
    }

    .back-link:hover {
        color: var(--pay-primary);
    }

    @media (max-width: 860px) {
        .payment-layout {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="payment-page">
    <div class="payment-container">

        {{-- HEADER --}}
        <div class="payment-header">
            <span class="eyebrow">Step 2 of 3 — Payment Details</span>
            <h1>Scan QR & Upload Receipt</h1>
            <p>Please complete your payment using the QR code below and upload a copy of your transaction receipt to finalize your appointment.</p>
        </div>

        {{-- PROGRESS --}}
        <div class="payment-progress">
            <div class="progress-step done">
                <span class="progress-number">✓</span>
                Details
            </div>
            <div class="progress-line"></div>
            <div class="progress-step active">
                <span class="progress-number">2</span>
                Payment
            </div>
            <div class="progress-line"></div>
            <div class="progress-step">
                <span class="progress-number">3</span>
                Confirmation
            </div>
        </div>

        {{-- ERRORS --}}
        @if ($errors->any())
            <div class="payment-error">
                <strong>Please correct the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- MAIN LAYOUT --}}
        <div class="payment-layout">

            {{-- LEFT: ADMIN PAYMENT QR & DETAILS CARD --}}
            <div class="pay-card">
                <div class="pay-card-title">
                    <h2>{{ $paymentSetting->title ?? 'Fonepay / eSewa Payment QR' }}</h2>
                    <span class="amount-badge">
                        {{ $paymentSetting->amount ?? 'NPR 1,000' }}
                    </span>
                </div>

                {{-- QR IMAGE DISPLAY --}}
                <div class="qr-container">
                    @if ($paymentSetting && $paymentSetting->image_url)
                        <img
                            src="{{ $paymentSetting->image_url }}"
                            alt="Payment QR Code"
                            class="qr-img"
                        >
                        <div style="margin-top: 10px;">
                            <a href="{{ $paymentSetting->image_url }}" target="_blank" style="color: var(--pay-primary); font-size: 12px; font-weight: 700; text-decoration: none;">
                                🔍 Click to view full image
                            </a>
                        </div>
                    @else
                        <div class="qr-placeholder">
                            <div class="qr-placeholder-icon">📱</div>
                            <h3 style="margin: 0 0 6px;">Scan & Pay</h3>
                            <p style="margin: 0; font-size: 13px;">Please make payment to the clinic account listed below and attach your payment proof screenshot.</p>
                        </div>
                    @endif
                </div>

                {{-- ACCOUNT INFO GRID --}}
                @if ($paymentSetting && ($paymentSetting->account_name || $paymentSetting->account_number))
                    <div class="account-info-grid">
                        @if ($paymentSetting->account_name)
                            <div class="account-info-item">
                                <small>ACCOUNT NAME</small>
                                <strong>{{ $paymentSetting->account_name }}</strong>
                            </div>
                        @endif

                        @if ($paymentSetting->account_number)
                            <div class="account-info-item">
                                <small>ACCOUNT / PHONE NO.</small>
                                <strong>{{ $paymentSetting->account_number }}</strong>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- INSTRUCTIONS --}}
                <div class="instructions-box">
                    <strong>Payment Instructions:</strong><br>
                    {{ $paymentSetting->instructions ?? "1. Scan the QR code using Fonepay or eSewa.\n2. Enter the fee amount and confirm payment.\n3. Take a screenshot of the payment receipt.\n4. Upload the screenshot on the right form to complete booking." }}
                </div>
            </div>

            {{-- RIGHT: UPLOAD PROOF & CONFIRM FORM --}}
            <div class="pay-card">
                <div class="pay-card-title">
                    <h2>Confirm Appointment</h2>
                </div>

                {{-- MINI SUMMARY --}}
                <div class="summary-mini">
                    <div class="summary-mini-item">
                        <span class="summary-mini-label">Service</span>
                        <span class="summary-mini-val">{{ $serviceName }}</span>
                    </div>
                    <div class="summary-mini-item">
                        <span class="summary-mini-label">Type</span>
                        <span class="summary-mini-val">
                            {{ $draft['category'] === 'online' ? '🎥 Online' : '📍 In-Person' }}
                        </span>
                    </div>
                    <div class="summary-mini-item">
                        <span class="summary-mini-label">Date</span>
                        <span class="summary-mini-val">
                            {{ \Carbon\Carbon::parse($draft['appointment_date'])->format('D, M j, Y') }}
                        </span>
                    </div>
                    <div class="summary-mini-item">
                        <span class="summary-mini-label">Time</span>
                        <span class="summary-mini-val">
                            {{ \Carbon\Carbon::parse($draft['appointment_time'])->format('g:i A') }}
                        </span>
                    </div>
                </div>

                {{-- CONFIRMATION FORM --}}
                <form
                    action="{{ route('booking.confirm') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    id="payment-form"
                >
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Upload Proof of Payment *</label>
                        <div class="upload-zone" id="upload-dropzone">
                            <input
                                type="file"
                                name="payment_receipt"
                                id="payment_receipt"
                                class="upload-file-input"
                                accept="image/jpeg,image/png,image/webp"
                                required
                            >
                            <div class="upload-icon">🧾</div>
                            <div class="upload-title">Click or drag & drop payment screenshot</div>
                            <div class="upload-sub">Supports JPG, PNG, WEBP (Max 5MB)</div>
                        </div>

                        <div class="preview-container" id="preview-box">
                            <img src="" alt="Receipt Preview" class="preview-thumb" id="preview-img">
                            <div class="preview-info">
                                <strong id="preview-name">receipt.jpg</strong>
                                <small id="preview-size">0 KB</small>
                            </div>
                            <span style="color: var(--pay-primary); font-size: 12px; font-weight: 700;">✓ Selected</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payment_reference" class="form-label">Transaction Reference ID / Notes (Optional)</label>
                        <input
                            type="text"
                            name="payment_reference"
                            id="payment_reference"
                            class="form-input"
                            placeholder="e.g. Fonepay Txn ID #12345678"
                            value="{{ old('payment_reference') }}"
                        >
                    </div>

                    <button type="submit" class="submit-pay-btn">
                        Confirm Booking & Submit Payment &nbsp; →
                    </button>

                    <div style="text-align: center;">
                        <a href="{{ route('booking.create') }}" class="back-link">
                            ← Edit appointment details
                        </a>
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('payment_receipt');
    const dropzone = document.getElementById('upload-dropzone');
    const previewBox = document.getElementById('preview-box');
    const previewImg = document.getElementById('preview-img');
    const previewName = document.getElementById('preview-name');
    const previewSize = document.getElementById('preview-size');

    if (!fileInput) return;

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            previewName.textContent = file.name;
            previewSize.textContent = (file.size / 1024).toFixed(1) + ' KB';

            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewBox.style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, e => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, e => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
        }, false);
    });
});
</script>
@endsection
