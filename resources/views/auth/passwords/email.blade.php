@extends('layouts.app')

@section('content')
    <!-- Content -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">

                    <img src="{{ asset('assets/img/illustrations/auth-forgot-password-illustration-light.png') }}"
                        alt="auth image" class="img-fluid my-5 auth-illustration">
                    <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth image"
                        class="platform-bg">

                </div>
            </div>
            <!-- /Left Text -->

            <!-- Forgot Password -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="{{ url('home') }}" class="app-brand-link gap-2">
                            <span class="app-brand-text demo menu-text fw-bold"><img
                                    src="{{ asset('images/EgyGuide.png') }}" alt="EgyGuide" width="120px"></span>
                        </a>

                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1 fw-bold">Forgot Password? 🔒</h3>
                    <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
                    <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Enter your email" autofocus />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('login') }}"
                            class="d-flex text-decoration-none align-items-center justify-content-center">
                            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>

    <!-- / Content -->
@endsection
