@extends('layouts.master-front')

@section('title', 'Profile')
@section('style')
    <!-- Vendors2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

    <!-- Page2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('front')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        @if ($message = Session::get('success'))
            <div class="row d-flex justify-content-end">
                <div class="col-4 ">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @elseif ($message = Session::get('error'))
            <div class="row d-flex justify-content-end">
                <div class="col-4 ">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Profile</h4>
        {{-- header --}}
        @include('front.head_profile')
        {{-- /header --}}
        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.profile') }}"><i class="ti ti-user-check ti-xs me-1"></i>
                            Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="ti ti-link ti-xs me-1"></i>
                            Connections</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- Connection Cards -->
        <div class="row g-4">

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="dropdown btn-pinned">
                            <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-dots-vertical text-muted"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0);">Share connection</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Block connection</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a></li>
                            </ul>
                        </div>
                        <div class="mx-auto my-3">
                            <img src="../../assets/img/avatars/12.png" alt="Avatar Image" class="rounded-circle w-px-100" />
                        </div>
                        <h4 class="mb-1 card-title">Eugenia Parsons</h4>
                        <span class="pb-1">Developer</span>
                        <div class="d-flex align-items-center justify-content-center my-3 gap-2">
                            <a href="javascript:;" class="me-1"><span class="badge bg-label-danger">Angular</span></a>
                            <a href="javascript:;"><span class="badge bg-label-info">React</span></a>
                        </div>

                        <div class="d-flex align-items-center justify-content-around my-3 py-1">
                            <div>
                                <h4 class="mb-0">112</h4>
                                <span>Projects</span>
                            </div>
                            <div>
                                <h4 class="mb-0">23.1k</h4>
                                <span>Tasks</span>
                            </div>
                            <div>
                                <h4 class="mb-0">1.28k</h4>
                                <span>Connections</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="javascript:;" class="btn btn-label-primary d-flex align-items-center me-3"><i
                                    class="ti-xs me-1 ti ti-user-plus me-1"></i>Connect</a>
                            <a href="javascript:;" class="btn btn-label-secondary btn-icon"><i
                                    class="ti ti-mail ti-sm"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--/ Connection Cards -->
    </div>
    <!--/ Content -->
@endsection

@section('script')

    <!-- Vendors2 JS -->

    <!-- Page2 JS -->
    <script src="{{ asset('assets/js/pages-profile.js') }}"></script>
@endsection
