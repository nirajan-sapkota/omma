@extends('layouts.app')

@section('title', 'Omma Health Center — Vision & Hearing Care')

@section('content')
<section class="view" id="view-home">
  <div class="hero">
    <div class="container hero-grid">
      <div>
        <span class="eyebrow">Omma · Greek for "eye"</span>
        <h1>Vision, hearing &amp; doctor care, tested and booked in one place.</h1>
        <p class="lead">Take a free eye, colour‑vision and hearing screening, then book a video consultation with our doctor — you'll get a unique meeting link instantly.</p>
        <div class="cta-row">
            <a href="{{ route('register') }}" class="btn btn-primary">Create an account</a>
            <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
          
        </div>
      </div>
      <div class="hero-visual">
        <div class="snellen-card">
          <div class="row">O M M A</div>
          <div class="row">E F P T</div>
          <div class="row">D E C F P</div>
          <div class="row">L E F O D P C T</div>
          <div class="row">F E L O P Z D</div>
          <div class="snellen-caption">SNELLEN‑STYLE ACUITY CHART · SAMPLE</div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="services">
      <div class="svc-card">
        <div class="ico">👁️</div>
        <h3>Eye Test</h3>
        <p>A quick Snellen‑style acuity check to estimate how clearly you're seeing today.</p>
        @auth
          <a class="btn btn-ghost" href="#">Take test →</a>
        @else
          <a class="btn btn-ghost" href="{{ route('login') }}">Sign in to take test →</a>
        @endauth
      </div>
      <div class="svc-card">
        <div class="ico">🎨</div>
        <h3>Colourblindness Test</h3>
        <p>Ishihara‑style plates that screen for red‑green colour vision deficiency.</p>
        @auth
          <a class="btn btn-ghost" href="#">Take test →</a>
        @else
          <a class="btn btn-ghost" href="{{ route('login') }}">Sign in to take test →</a>
        @endauth
      </div>
      <div class="svc-card">
        <div class="ico">👂</div>
        <h3>Hearing Test</h3>
        <p>Tone‑based screening across frequencies for each ear, right in your browser.</p>
        @auth
          <a class="btn btn-ghost" href="#">Take test →</a>
        @else
          <a class="btn btn-ghost" href="{{ route('login') }}">Sign in to take test →</a>
        @endauth
      </div>
      <div class="svc-card">
        <div class="ico">🩺</div>
        <h3>Doctor Video Visit</h3>
        <p>Book a slot and receive a unique video‑call link to meet your doctor.</p>
        @auth
          <a class="btn btn-ghost" href="#">Book now →</a>
        @else
          <a class="btn btn-ghost" href="{{ route('register') }}">Register to book →</a>
        @endauth
      </div>
    </div>
  </div>
</section>
@endsection
