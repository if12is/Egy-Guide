@extends('layouts.master-front')

@section('title', 'Account Settings-Security')
@section('front')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Security</h4>

        <div class="row">
            <div class="col-md-12">

                <!-- Change Password -->
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="row d-flex justify-content-center">
                                <div class="col-6 ">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        @elseif ($message = Session::get('error'))
                            <div class="row d-flex justify-content-center">
                                <div class="col-6 ">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form id="setting" method="POST" action="{{ route('home.setting-update') }}">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="old_password">Current Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('old_password') is-invalid @enderror"
                                            onfocus="this.value=''" type="password" id="old_password" name="old_password"
                                            placeholder="Write Old Password" value="{{ old('old_password') }}" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        @error('old_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('newPassword') is-invalid @enderror"
                                            type="password" id="newPassword" name="newPassword"
                                            placeholder="Write A New Password" value="{{ old('newPassword') }}" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        @error('newPassword')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword_confirmation">Confirm New Password</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('newPassword_confirmation') is-invalid @enderror"
                                            type="password" name="newPassword_confirmation" id="newPassword_confirmation"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            value="{{ old('newPassword_confirmation') }}" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                        @error('newPassword_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <h6>Password Requirements:</h6>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                        <li class="mb-1">At least one lowercase character</li>
                                        <li>At least one number, symbol, or whitespace character</li>
                                    </ul>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->


            </div>
        </div>
    </div>
    <!--/ Content -->
@endsection
