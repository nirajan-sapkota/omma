@extends('layouts.app')

@section('title', 'Create an account — Omma Health Center')

@section('content')
<section class="view compact">
  <div class="container auth-wrap">
    <div class="section-title">
      <h2>Create your account</h2>
      <span class="tag">New patient</span>
    </div>

    <div class="panel">
      @if ($errors->any())
        <div class="result-box warn">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="field">
          <label for="name">Full name</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}"
                 class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                 placeholder="e.g. Aarav Sharma" required autofocus>
        </div>

        <div class="field">
          <label for="email">Email address</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}"
                 class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                 placeholder="you@example.com" required>
        </div>
        <div class="field">
          <label for="address">Address</label>
          <input id="address" type="text" name="address" value="{{ old('address') }}"
                 class="{{ $errors->has('address') ? 'is-invalid' : '' }}"
                 placeholder="Birendranagar" required>
        </div>
        <div class="field">
          <label for="phone">Phone</label>
          <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                 class="{{ $errors->has('phone') ? 'is-invalid' : '' }}"
                 placeholder="98XXXXXXXX" required>
        </div>
        
          <label for="gender">Gender</label><br><br>
          Male<input id="male" type="radio" name="gender" value="male" required>
          Female<input id="female" type="radio" name="gender" value="Female" required>

        <br><br>
        <div class="field-row" style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
          <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password"
                   class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="••••••••" required>
          </div>
          <div class="field">
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   placeholder="••••••••" required>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Create account</button>
      </form>

      <div class="auth-foot">
        Already have an account? <a href="{{ route('login') }}">Sign in</a>
      </div>
    </div>
  </div>
</section>
@endsection
