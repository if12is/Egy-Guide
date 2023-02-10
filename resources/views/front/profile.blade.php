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
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src=" {{ $user->getFirstMediaUrl('avatars') }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                            {{-- @if (empty($user->hasFile('avatars'))) {{ asset('assets/img/avatars/unknown-avatar.jpeg') }}
                                            @else
                                                {{ $user->getFirstMediaUrl('avatars') }} @endif --}}
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4 class="text-capitalize">{{ $user->name }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item d-inline-flex"><i class="ti ti-color-swatch"></i>
                                            @if (empty($user->bio->job))
                                                {{ 'NULL ' }}
                                            @else
                                                {{ $user->bio->job }}
                                            @endif
                                        </li>
                                        <li class="list-inline-item text-capitalize d-inline-flex"><i
                                                class="ti ti-map-pin"></i>
                                            <span>
                                                {{-- {{ $user->bio->city ? $user->bio->city : 'Null' }} --}}
                                                @if (empty($user->bio->city))
                                                    {{ 'NULL ' }}
                                                @else
                                                    {{ $user->bio->city }}
                                                @endif
                                            </span>
                                        </li>
                                        <li class="list-inline-item d-inline-flex"><i class="ti ti-calendar"></i>
                                            Joined {{ $user->created_at->format('M  Y') }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="javascript:void(0)"
                                    class="btn btn-primary {{ $user->id == Auth::id() ? 'd-none' : '' }}">
                                    <i class="ti ti-user-check me-1"></i>Connected
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-user-check me-1"></i>
                            Profile</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.connections') }}"><i class="ti-xs ti ti-link me-1"></i>
                            Connections</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- User Profile Content -->
        <div class="row justify-content-between">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col"><small class="card-text text-uppercase">About</small></div>
                            <div class="col-2">
                                <div class="bio">
                                    <!-- Button trigger modal -->
                                    <button type="button"
                                        class="btn btn-xs btn-info waves-effect waves-light {{ $user->id == Auth::user()->id ? '' : 'd-none' }}"
                                        data-bs-toggle="modal" data-bs-target="#basicModal">
                                        edit
                                    </button>

                                    <!-- Modal -->
                                    <form id="" method="POST" action="{{ route('home.profile-update') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel1">
                                                            Bio Information</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-2">
                                                            <div class="col mb-3">
                                                                <label for="country" class="form-label">Country</label>
                                                                <input type="text" id="country" class="form-control"
                                                                    placeholder="Enter Country" name="country"
                                                                    value="@if (empty($user->bio->country)) {{ 'NULL ' }}@else{{ $user->bio->country }} @endif">
                                                            </div>

                                                            <div class="col mb-3">
                                                                <label for="city" class="form-label">City</label>
                                                                <input type="text" id="city" class="form-control"
                                                                    placeholder="Enter City" name="city"
                                                                    value="@if (empty($user->bio->city)) {{ 'NULL ' }}@else{{ $user->bio->city }} @endif">
                                                            </div>
                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="emailBasic" class="form-label">Email</label>
                                                                <input type="email" id="emailBasic"
                                                                    class="form-control" placeholder="xxxx@xxx.xx"
                                                                    name="extra_email"
                                                                    value="@if (empty($user->bio->extra_email)) {{ 'NULL ' }}@else{{ $user->bio->extra_email }} @endif">
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="phone_number" class="form-label">Phone
                                                                    Number</label>
                                                                <input type="tel" id="phone_number"
                                                                    class="form-control" placeholder="123-45-789"
                                                                    name="contact_number"
                                                                    value="@if (empty($user->bio->contact_number)) {{ 'NULL ' }}@else{{ $user->bio->contact_number }} @endif">
                                                            </div>

                                                        </div>
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="dobBasic" class="form-label">DOB</label>
                                                                <input type="date" id="dobBasic" class="form-control"
                                                                    placeholder="DD / MM / YY" name="dob"
                                                                    value="@if (empty($user->bio->dob)) {{ 'NULL ' }}@else{{ $user->bio->dob }} @endif">
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="job" class="form-label">Job Title</label>
                                                                <input type="tel" id="job" class="form-control"
                                                                    placeholder="Enter your job title" name="job"
                                                                    value="@if (empty($user->bio->job)) {{ 'NULL ' }}@else{{ $user->bio->job }} @endif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-label-secondary waves-effect"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>


                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span>
                                <span>
                                    {{ $user->name }}
                                </span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span>
                                <span>
                                    {{ $user->is_admin == 0 ? 'Active' : 'Not Active' }}
                                </span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-crown"></i><span class="fw-bold mx-2">Role:</span>
                                <span>
                                    {{ $user->is_admin == 0 ? 'User' : 'Admin' }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-flag"></i><span class="fw-bold mx-2">Country:</span>
                                <span>
                                    @if (empty($user->bio->country))
                                        {{ 'NULL ' }}
                                    @else
                                        {{ $user->bio->country }}
                                    @endif
                                </span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase">Contacts</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span>
                                <span>
                                    @if (empty($user->bio->contact_number))
                                        {{ 'NULL ' }}
                                    @else
                                        {{ $user->bio->contact_number }}
                                    @endif
                                </span>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-album"></i><span class="fw-bold mx-2">age:</span>
                                <span>
                                    @if (empty($user->bio->dob))
                                        {{ 'NULL ' }}
                                    @else
                                        {{ $years }}
                                    @endif
                                </span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>
                                <span>
                                    @if (empty($user->bio->extra_email))
                                        {{ 'NULL ' }}
                                    @else
                                        {{ $user->bio->extra_email }}
                                    @endif
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ About User -->
                <!-- Profile Overview -->
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text text-uppercase">Overview</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-users"></i><span class="fw-bold mx-2">Followers:</span>
                                <span>13.5k</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-users"></i><span class="fw-bold mx-2">Followed:</span> <span>897</span>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <i class="ti ti-movie"></i><span class="fw-bold mx-2">Posts:</span>
                                <span>{{ $user->posts_count }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ Profile Overview -->
            </div>
            <div class="col-xl-7 col-lg-7 col-md-7 mb-5">
                @foreach ($posts as $post)
                    <div class="col-xl-12 col-lg-7 col-md-7 mb-5">
                        <!-- User Posts -->
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-content-end justify-center align-items-baseline mb-1">
                                    <div class="col-1">
                                        <span>
                                            <div class="avatar avatar-online">
                                                <img src="{{ $post->user->getFirstMediaUrl('avatars') }}" alt=""
                                                    class="h-auto rounded-circle">
                                            </div>
                                        </span>
                                    </div>
                                    <div class="col-10">
                                        <h5 class="card-title">{{ $post->user->name }}</h5>
                                    </div>
                                    <div class="col-1">
                                        <!-- Icon Dropdown -->
                                        <div
                                            class="demo-inline-space {{ $post->user->id == Auth::user()->id ? '' : 'd-none' }}">
                                            <div class="btn-group">
                                                <button type="button"
                                                    class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('posts.edit', $post->id) }}">Edit <i
                                                                class="ti ti-edit  mx-2"></i></a> </li>
                                                    <li>
                                                        <hr class="dropdown-divider" />
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('posts.destroy', $post->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <button class="dropdown-item" type="submit">Delete
                                                                <i class="ti ti-trash mx-2"></i> </button>
                                                        </form>
                                                        {{-- <a class="dropdown-item" href="javascript:void(0);">Delete</a> --}}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--/ Icon Dropdown -->
                                    </div>
                                </div>
                                <h6 class="card-subtitle my-2 text-muted">
                                    {{ $post->title }}
                                </h6>
                            </div>
                            <img class="img-fluid" src="{{ $post->getFirstMediaUrl('images') }}" alt="Card image cap">
                            <div class="card-body">
                                <div class="filter mb-3">
                                    <span class="badge rounded-pill bg-label-primary">#{{ $post->category->name }}</span>
                                    <span class="badge rounded-pill bg-label-info">#{{ $post->state->name }}</span>
                                </div>
                                <p class="card-text">Bear claw sesame snaps gummies chocolate.</p>
                                <a href="javascript:void(0);" class="card-link">Card link</a>
                                <a href="javascript:void(0);" class="card-link">Another link</a>
                            </div>
                        </div>
                        <!-- User Posts -->
                    </div>
                @endforeach
            </div>

        </div>
        <!--/ User Profile Content -->
    </div>
    <!--/ Content -->
@endsection

@section('script')

    <!-- Vendors2 JS -->

    <!-- Page2 JS -->
    <script src="{{ asset('assets/js/pages-profile.js') }}"></script>
@endsection
