@extends('layouts.app')

@section('content')
<style>
    #app > nav {
        display: none;
    }

    #app main.py-4 {
        padding: 0 !important;
    }

    .login-page {
        min-height: 100vh;
        background: radial-gradient(circle at 10% 20%, #19c7c4 0%, #0d6f9d 45%, #073b65 100%);
        color: #e9fbff;
    }

    .login-navbar {
        position: sticky;
        top: 0;
        z-index: 10;
        backdrop-filter: blur(8px);
        background: rgba(1, 34, 61, 0.45);
        border-bottom: 1px solid rgba(173, 255, 255, 0.28);
    }

    .brand-mark {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #63fff2, #1eb4d9);
        color: #06334f;
        font-weight: 700;
    }

    .login-shell {
        padding: 3rem 1rem;
    }

    .hero-copy h1 {
        font-size: clamp(2rem, 4vw, 3.1rem);
        font-weight: 700;
        line-height: 1.2;
    }

    .hero-copy p {
        font-size: 1rem;
        max-width: 560px;
        color: #d4f7ff;
    }

    .feature-pill {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        padding: .45rem .8rem;
        margin: .2rem .3rem .2rem 0;
        border-radius: 999px;
        font-size: .86rem;
        background: rgba(180, 255, 255, 0.18);
        border: 1px solid rgba(227, 255, 255, 0.36);
        color: #e8ffff;
    }

    .login-card {
        border-radius: 20px;
        border: 1px solid rgba(222, 255, 255, 0.35);
        background: rgba(2, 33, 58, 0.6);
        box-shadow: 0 12px 30px rgba(1, 18, 34, 0.28);
        backdrop-filter: blur(8px);
    }

    .login-card .form-label {
        color: #bff8ff;
        font-weight: 600;
    }

    .login-card .form-control {
        border-radius: 12px;
        border: 1px solid rgba(142, 235, 255, 0.45);
        background: rgba(5, 59, 88, 0.58);
        color: #f2feff;
        padding: .72rem .85rem;
    }

    .login-card .form-control::placeholder {
        color: #b8ecf7;
    }

    .login-card .form-control:focus {
        border-color: #64fff4;
        box-shadow: 0 0 0 .2rem rgba(100, 255, 244, 0.2);
        background: rgba(5, 59, 88, 0.76);
        color: #fff;
    }

    .login-btn {
        border: none;
        border-radius: 12px;
        padding: .75rem 1rem;
        font-weight: 700;
        color: #063349;
        background: linear-gradient(90deg, #89fff7, #58d2ff);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .login-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(66, 218, 255, 0.35);
        color: #03222f;
    }

    .forgot-link {
        color: #c4f8ff;
        text-decoration: none;
        font-weight: 600;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .form-check-input:checked {
        background-color: #64fff4;
        border-color: #64fff4;
    }

    .form-check-label {
        color: #d8fbff;
    }

    .invalid-feedback {
        color: #ffd2d2;
    }

    @media (max-width: 991.98px) {
        .login-shell {
            padding: 2rem 1rem 2.5rem;
        }

        .hero-copy {
            margin-bottom: 1.3rem;
        }
    }
</style>

<div class="login-page">
    <nav class="login-navbar">
        <div class="container py-3 d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center gap-2">
                <span class="brand-mark">VR</span>
                <span class="fw-bold text-white">Visitor Portal</span>
            </a>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('login') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-semibold">Login</a>
                <a href="{{ route('register') }}" class="text-decoration-none text-white-50">Sign Up</a>
            </div>
        </div>
    </nav>

    <section class="login-shell">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="hero-copy">
                        <p class="text-uppercase fw-semibold mb-2 small">Future-ready guest management</p>
                        <h1 class="mb-3">Welcome back to your smart visitor hub.</h1>
                        <p class="mb-4">Log in to continue managing check-ins, security, and visitor flow with a clean, adorable, and user-friendly dashboard.</p>
                        <div>
                            <span class="feature-pill">💙 Friendly workflow</span>
                            <span class="feature-pill">⚡ Quick access</span>
                            <span class="feature-pill">🔒 Secure sign-in</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login-card p-4 p-md-5">
                        <h3 class="fw-bold mb-1">Log In</h3>
                        <p class="text-info-emphasis mb-4">Pick up where you left off.</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                            </div>

                            <button type="submit" class="login-btn w-100 mb-3">{{ __('Login') }}</button>

                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
