@extends('layouts.master')

@section('title', 'Dashboard - User')
@section('style')

@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> {{ $user->name }} </h4>
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Offcanvas to add new user -->
        <div class="card">
            <div class="card-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Update User</h5>
            </div>
            <div class="card-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-category pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
                    action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-name">Full Name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="add-user-name"
                            placeholder="johan ..." name="name" aria-label="johan ..." value="{{ $user->name }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-email">Email</label>
                        <input type="email" id="add-user-email" class="form-control  @error('email') is-invalid @enderror"
                            placeholder="johan@example.com" aria-label="johan@example.com" name="email"
                            value="{{ $user->email }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-password">Password</label>
                        <input type="password" id="add-user-password"
                            class="form-control  @error('password') is-invalid @enderror" placeholder="password"
                            aria-label="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="formFile" class="form-label">Upload Avatar </label>
                        <input class="form-control @error('avatar') is-invalid @enderror" name="avatar" type="file"
                            id="formFile" value="{{ old('avatar') }}">
                        @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div>Old Avatar: <a
                                href="{{ $user->getFirstMediaUrl('avatars') }}">{{ $oldImage ? $oldImage->file_name : null }}</a>
                        </div>
                    </div>


                    <button type="submit"
                        class="btn btn-primary me-sm-3 me-1 data-submit waves-effect waves-light">Submit</button>
                    <button type="reset" class="btn btn-label-secondary waves-effect"
                        data-bs-dismiss="offcanvas">Cancel</button>
                    <input type="hidden">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
