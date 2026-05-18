@extends('layouts.app')

@section('content')
<style>
    .neo-login-wrap {
        min-height: calc(100vh - 130px);
        padding: 2rem 1rem;
    }

    .neo-login-shell {
        border-radius: 24px;
        overflow: hidden;
        background: linear-gradient(140deg, #033a4d 0%, #065f7f 45%, #0b89ab 100%);
        box-shadow: 0 24px 60px rgba(0, 23, 34, 0.35);
        position: relative;
    }

    .neo-login-shell::after {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 78% 22%, rgba(138, 250, 255, 0.2), transparent 34%);
        pointer-events: none;
    }

    .matrix-panel {
        position: relative;
        min-height: 100%;
        padding: 2.5rem 2rem;
        color: #baf7ff;
        background: linear-gradient(180deg, rgba(2, 27, 40, 0.8), rgba(0, 57, 78, 0.72));
        isolation: isolate;
    }

    .matrix-panel::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(to bottom, rgba(80, 249, 255, 0.2) 1px, transparent 1px),
            linear-gradient(to right, rgba(80, 249, 255, 0.14) 1px, transparent 1px);
        background-size: 100% 26px, 26px 100%;
        opacity: 0.4;
        z-index: -1;
    }

    .matrix-rain {
        font-size: 0.78rem;
        line-height: 1.45;
        letter-spacing: 0.16rem;
        margin-top: 1.5rem;
        color: rgba(128, 255, 245, 0.92);
        text-shadow: 0 0 10px rgba(80, 249, 255, 0.55);
        word-break: break-all;
    }

    .hello-chip {
        display: inline-block;
        margin-bottom: 1rem;
        padding: 0.4rem 0.9rem;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.8rem;
        color: #0a4254;
        background: #8af7ff;
    }

    .login-panel {
        padding: 2.5rem 2rem;
        background: rgba(255, 255, 255, 0.98);
        position: relative;
        z-index: 1;
    }

    .cute-title {
        color: #07445a;
        font-weight: 800;
        margin-bottom: 0.35rem;
    }

    .cute-subtitle {
        color: #4c7180;
        margin-bottom: 1.5rem;
        font-size: 0.96rem;
    }

    .neo-login-shell .form-label {
        color: #145065;
        font-weight: 700;
    }

    .neo-login-shell .form-control {
        border-radius: 14px;
        border: 1px solid #b2ddeb;
        padding: 0.75rem 0.95rem;
    }

    .neo-login-shell .form-control:focus {
        border-color: #2ac4de;
        box-shadow: 0 0 0 0.2rem rgba(42, 196, 222, 0.2);
    }

    .btn-neo {
        border: none;
        border-radius: 14px;
        padding: 0.7rem 1.2rem;
        font-weight: 700;
        background: linear-gradient(90deg, #0a95b4, #00bfd6);
        color: #fff;
        box-shadow: 0 10px 20px rgba(10, 149, 180, 0.28);
    }

    .btn-neo:hover {
        color: #fff;
        transform: translateY(-1px);
    }

    .forgot-link {
        color: #0c7997;
        text-decoration: none;
        font-weight: 600;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 767.98px) {
        .neo-login-wrap {
            padding: 1.25rem 0.65rem;
            min-height: auto;
        }

        .matrix-panel,
        .login-panel {
            padding: 1.75rem 1.25rem;
        }
    }
</style>

<div class="container-fluid neo-login-wrap d-flex align-items-center justify-content-center">
    <div class="col-12 col-xl-10 col-xxl-9">
        <div class="row g-0 neo-login-shell">
            <div class="col-md-6">
                <div class="matrix-panel h-100 d-flex flex-column justify-content-center">
                    <span class="hello-chip">Future Ready Access</span>
                    <h2 class="fw-bold mb-3">Welcome Back, Explorer!</h2>
                    <p class="mb-0">
                        Secure, friendly, and lightning fast sign in for your visitor registration system.
                        Your gateway to smarter check-ins starts right here.
                    </p>
                    <div class="matrix-rain">
                        101110 010101 110100 001101 010101 111001 101001 010110 111001 010110<br>
                        011010 110011 001001 101010 010110 111100 000111 110010 010011 100111<br>
                        110101 001010 101110 010011 111000 010110 001101 100010 111001 011011
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="login-panel h-100 d-flex flex-column justify-content-center">
                    <h3 class="cute-title">Log In</h3>
                    <p class="cute-subtitle">Stay connected with your team and visitors in one adorable dashboard.</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <button type="submit" class="btn btn-neo">{{ __('Login') }}</button>

                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
