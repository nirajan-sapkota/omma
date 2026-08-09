@extends('layouts.app')

@section('title', 'Sign in — Omma Health Center')

@section('content')
<section class="view compact">
  <div class="container auth-wrap">
    <div class="section-title">
      <h2>Sign in</h2>
      <span class="tag">Patient login</span>
    </div>

    <div class="panel">
      @if (session('status'))
        <div class="result-box good"><p>{{ session('status') }}</p></div>
      @endif

      @if ($errors->any())
        <div class="result-box warn">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login.attempt') }}">
        @csrf

        <div class="field">
          <label for="email">Email address</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}"
                 class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                 placeholder="you@example.com" required autofocus>
        </div>

        <div class="field">
          <label for="password">Password</label>
          <input id="password" type="password" name="password"
                 class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                 placeholder="••••••••" required>
        </div>

        <div class="field-check">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember" style="margin:0; font-weight:400; color:var(--ink-soft);">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
      </form>

      <div class="auth-foot">
        Don't have an account? <a href="{{ route('register') }}">Create one</a>
      </div>
    </div>
  </div>
</section>
@endsection
