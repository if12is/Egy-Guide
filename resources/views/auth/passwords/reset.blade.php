@extends('layouts.app')

@section('title', 'Reset Password 🔒')
@section('style')

@endsection
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
                    <img src="{{ asset('assets/img/illustrations/auth-reset-password-illustration-light.png') }}"
                        alt="auth image" class="img-fluid my-5 auth-illustration">
                    <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth image"
                        class="platform-bg">

                </div>
            </div>
            <!-- /Left Text -->

            <!-- Forgot Password -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center p-4 p-sm-5">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="{{ url('home') }}" class="app-brand-link gap-2">
                            <span class="app-brand-text demo menu-text fw-bold"><img
                                    src="{{ asset('images/EgyGuide.png') }}" alt="EgyGuide" width="120px"></span>
                        </a>

                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1 fw-bold">Reset Password 🔒</h3>
                    <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework"
                        action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                            <label for="password" class="form-label">New Password</label>
                            <div class="input-group input-group-merge has-validation">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <div class="input-group input-group-merge has-validation">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
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
