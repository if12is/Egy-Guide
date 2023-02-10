@extends('layouts.master-front')

@section('title', 'Home')
@section('front')

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
    <section class="toprate">
        <div class="status-wrapper">
            <span class="top">Top Rated</span>
            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/1.png') }}" alt="">
                </div>
                <i class="logo-badge">1</i>
                <p class="username">user_name_1</p>
            </div>
            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/10.png') }}" alt="">
                </div>
                <i class="logo-badge">2</i>
                <p class="username">user_name_2</p>
            </div>
            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/7.png') }}" alt="">
                </div>
                <i class="logo-badge">3</i>
                <p class="username">user_name_3</p>
            </div>

            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/12.png') }}" alt="">
                </div>
                <i class="logo-badge">4</i>
                <p class="username">user_name_3</p>
            </div>

            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/11.png') }}" alt="">
                </div>
                <i class="logo-badge">5</i>
                <p class="username">user_name_3</p>
            </div>

            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/8.png') }}" alt="">
                </div>
                <i class="logo-badge">6</i>
                <p class="username">user_name_3</p>
            </div>

            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/12.png') }}" alt="">
                </div>
                <i class="logo-badge">7</i>
                <p class="username">user_name_3</p>
            </div>

            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/13.png') }}" alt="">
                </div>
                <i class="logo-badge">8</i>
                <p class="username">user_name_3</p>
            </div>

            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/3.png') }}" alt="">
                </div>
                <i class="logo-badge">9</i>
                <p class="username">user_name_3</p>
            </div>

            <div class="status-card">
                <div class="profile-pic"><img src="{{ asset('assets/img/avatars/2.png') }}" alt="">
                </div>
                <i class="logo-badge">10</i>
                <p class="username">user_name_3</p>
            </div>
        </div>
        {{--  create post --}}
        <div class="post_create ">

            {{-- ss --}}
            <div class="col-md post-create">
                <div class="card">
                    <h5 class="card-header text-center">Create a New Post </h5>
                    <div class="card-body">
                        <form class="needs-validation" action="{{ route('posts.store') }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter Title of post" />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        cols="20" rows="3" placeholder="Description of Post">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <!-- Primary -->
                                    <label for="select2Primary" class="form-label">Category</label>
                                    <div class="select2-primary">
                                        <select id="select2Primary"
                                            class="select2 form-select @error('category_id') is-invalid @enderror"
                                            name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }} {{ old('category_id') }}">
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        {{-- <div class="valid-feedback">Looks good!</div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <!-- Basic -->
                                    <label for="select2Basics" class="form-label">Country</label>
                                    <select id="select2Basics" name="country_id"
                                        class="select2 form-select form-select-lg @error('country_id') is-invalid @enderror"
                                        data-allow-clear="true" value="{{ old('country_id') }}">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="invalid-feedback is-invalid ">{{ $message }}</div>
                                    @enderror
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                </div>
                                <div class="col mb-3">
                                    <!-- Basic -->
                                    <label for="select2Basic" class="form-label">State</label>
                                    <select id="select2Basic" name="state_id"
                                        class="select2 form-select form-select-lg @error('state_id') is-invalid @enderror"
                                        data-allow-clear="true" value="{{ old('state_id') }}">
                                        <option value="">Select State</option>
                                    </select>
                                    @error('state_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="formFile" class="form-label">Upload Image </label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image"
                                        type="file" id="formFile" value="{{ old('image') }}">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <div class="left-col">
                {{-- post  --}}
                @foreach ($posts as $post)
                    <div class="post">
                        <div class="info">
                            <div class="user">
                                <div class="profile-pic">
                                    <a href="{{ route('home.profile-show', ['id' => $post->user->id]) }}">
                                        <img src="{{ $post->user->getFirstMediaUrl('avatars') }}" alt="">
                                    </a>
                                </div>
                                <p class="username">{{ $post->user->name }}</p>
                            </div>
                            <!-- Icon Dropdown -->
                            <div class="demo-inline-space {{ $post->user->id == $user->id ? '' : 'd-none' }}">
                                <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit <i
                                                    class="ti ti-edit  mx-2"></i></a> </li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
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
                        <object data="{{ $post->getFirstMediaUrl('images') }}" class="post-image"
                            alt=""></object>
                        <div class="post-content">
                            <div class="reaction-wrapper">
                                <span id="heart">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon like_heart icon-tabler icon-tabler-heart-filled" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>

                                <i class="ti ti-heart-off ti-lg ti-flashing-hover" id="dislike"></i>
                                <span class="speace"></span>
                                <i class="ti ti-message-circle-2 ti-lg scaleX-n1 ti-burst-hover" id="iconComment"></i>
                                {{-- <a class="signet">
                            <svg fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                                <path
                                    d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z">
                                </path>
                            </svg>
                        </a> --}}
                            </div>
                            <p class="likes">1,012 likes</p>
                            <div class="filter">
                                <span class="badge rounded-pill bg-label-primary">#{{ $post->category->name }}</span>
                                <span class="badge rounded-pill bg-label-info">#{{ $post->state->name }}</span>
                            </div>
                            <p class="description">
                                <span><strong> User_name</strong> </span> Lorem ipsum dolor sit amet consectetur,
                                adipisicing
                                elit.
                                Pariatur
                                tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?
                            </p>
                            <p class="post-time">2 minutes ago</p>
                            <div>
                                <p class="comment">
                                <div class="profile-pic-comment"><img src="{{ asset('assets/img/avatars/2.png') }}"
                                        alt="">
                                </div>
                                <span><strong> User_name</strong> </span> Lorem ipsum dolor sit amet consectetur,
                                adipisicing
                                elit.
                                Pariatur
                                tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?
                                </p>
                                <p class="post-time">2 minutes ago</p>
                            </div>

                        </div>
                        <div class="comment-wrapper ">
                            {{-- <i class="fa-solid fa-message"></i> --}}
                            <input type="text" class="comment-box " id="textComment" placeholder="Add a comment">
                            <button class="comment-btn">post</button>
                            {{-- <img src="img/smile.PNG" class="icon" alt=""> --}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="right-col">
                <div class="profile-card">
                    <div class="profile-pic">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="">
                    </div>
                    <div>
                        <p class="username">modern_web_channel</p>
                        <p class="sub-text">kunaal kumar</p>
                    </div>
                    <button class="action-btn">switch</button>
                </div>
                <p class="suggestion-text">Suggestions for you</p>
                <div class="profile-card">
                    <div class="profile-pic">
                        <img src="{{ asset('assets/img/avatars/2.png') }}" alt="">
                    </div>
                    <div>
                        <p class="username">modern_web_channel</p>
                        <p class="sub-text">followed bu user</p>
                    </div>
                    <button class="action-btn">follow</button>
                </div>
                <div class="profile-card">
                    <div class="profile-pic">
                        <img src="{{ asset('assets/img/avatars/3.png') }}" alt="">
                    </div>
                    <div>
                        <p class="username">modern_web_channel</p>
                        <p class="sub-text">followed bu user</p>
                    </div>
                    <button class="action-btn">follow</button>
                </div>
                <div class="profile-card">
                    <div class="profile-pic">
                        <img src="{{ asset('assets/img/avatars/4.png') }}" alt="">
                    </div>
                    <div>
                        <p class="username">modern_web_channel</p>
                        <p class="sub-text">followed bu user</p>
                    </div>
                    <button class="action-btn">follow</button>
                </div>
                <div class="profile-card">
                    <div class="profile-pic">
                        <img src="{{ asset('assets/img/avatars/5.png') }}" alt="">
                    </div>
                    <div>
                        <p class="username">modern_web_channel</p>
                        <p class="sub-text">followed bu user</p>
                    </div>
                    <button class="action-btn">follow</button>
                </div>
                <div class="profile-card">
                    <div class="profile-pic">
                        <img src="{{ asset('assets/img/avatars/6.png') }}" alt="">
                    </div>
                    <div>
                        <p class="username">modern_web_channel</p>
                        <p class="sub-text">followed bu user</p>
                    </div>
                    <button class="action-btn">follow</button>
                </div>
            </div>

        </div>
    </section>


@endsection
