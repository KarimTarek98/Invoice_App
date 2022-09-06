

@extends('layouts.master2')
@section('title')
    Sign in - Invoices System
@stop
@section('content')
<style>

</style>
@if (session()->has('loginFailed'))
    <h2>{{ session()->get('loginFailed') }}</h2>
@endif
<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              <label class="form-label" for="form1Example13">{{ __('Email Address') }}</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              <label class="form-label" for="form1Example23">{{ __('Password') }}</label>
            </div>

            <div class="d-flex justify-content-around align-items-center mb-4">
              <!-- Checkbox -->
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="form1Example3">{{ __('Remember Me') }}</label>
              </div>
              @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>





          </form>
        </div>
      </div>
    </div>
  </section>
