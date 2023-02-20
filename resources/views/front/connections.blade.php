@extends('layouts.master-front')

@section('title', 'Connections')
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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User Profile /</span> Connections</h4>
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
        <div class="row g-4 justify-content-center">

            @foreach ($users as $user)
                <div class="col-xl-4 col-lg-6 col-md-6 d-grid">
                    <div class="card">
                        <div class="card-body text-center">
                            {{-- <div class="dropdown btn-pinned">
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
                            </div> --}}
                            <div class="mx-auto my-3">
                                <a href="{{ route('home.profile-show', ['id' => $user->id]) }}">
                                    <img src="{{ optional($user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                        alt="Avatar Image" class="rounded-circle w-px-100" />
                                </a>
                            </div>
                            <h4 class="mb-1 card-title">{{ $user->name }}</h4>
                            {{-- <span class="pb-1">
                                @if (empty($user->bio->job))
                                    {{ 'NULL ' }}
                                @else
                                    {{ $user->bio->job }}
                                @endif
                            </span> --}}
                            <div class="d-flex align-items-center justify-content-center my-3 gap-2">
                                <a href="javascript:;" class="me-1"><span class="badge bg-label-danger">Angular</span></a>
                                <a href="javascript:;"><span class="badge bg-label-info">React</span></a>
                            </div>

                            <div class="d-flex align-items-center justify-content-around my-3 py-1">
                                <div>
                                    <h4 class="mb-0">{{ $user->posts()->count() }}</h4>
                                    <span>Posts</span>
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ $user->followers()->count() }}</h4>
                                    <span>Followers</span>
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ $user->following()->count() }}</h4>
                                    <span>Followed</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <form action="{{ route('users.follow', $user->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-label-primary d-flex align-items-center me-3" type="submit"> <i
                                            class="ti-xs me-1 ti ti-user-plus"></i>Follow</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="py-4">
                {{ $users->links('front.pagination') }}
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
