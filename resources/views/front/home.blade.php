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
            @foreach ($topUsers as $topUser)
                <div class="status-card">
                    <div class="profile-pic">
                        <img src="{{ optional($topUser->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                            alt="top user">
                    </div>
                    <i class="logo-badge">{{ $count }}</i>
                    <p class="topUsername">{{ $topUser->name }}</p>
                </div>
                <?php $count++; ?>
            @endforeach

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
                                    <label for="formFile" class="form-label">Upload </label>
                                    <input class="form-control @error('media') is-invalid @enderror" name="media"
                                        type="file" id="formFile" value="{{ old('media') }}">
                                    @error('media')
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
            <div class="left-col" id="posts">
                {{-- post  --}}
                @foreach ($posts as $post)
                    <div class="post card">
                        <div class="info">
                            <div class="user">
                                <div class="profile-pic">
                                    <a href="{{ route('home.profile-show', ['id' => $post->user->id]) }}">
                                        <img src="{{ optional($post->user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                            alt="User Avatar">
                                    </a>
                                </div>
                                <p class="username">{{ $post->user->name }}</p>
                            </div>
                            <!-- Icon Dropdown -->
                            <div class="demo-inline-space {{ $post->user->id == Auth::user()->id ? '' : 'd-none' }}">
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
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/ Icon Dropdown -->
                        </div>
                        @if ($post->hasMedia('images'))
                            <img src="{{ $post->getFirstMediaUrl('images') }}" class="post-image"
                                alt="{{ $post->title }}">
                        @elseif ($post->hasMedia('videos'))
                            <video controls="controls" style="width: -webkit-fill-available; max-height: 504px;">
                                <source src="{{ $post->getFirstMediaUrl('videos') }}" type="{{ $post->mime_type }}">
                            </video>
                        @endif
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
                        <div class="row">
                            <form action="{{ route('comments.store') }}" method="post">
                                @csrf

                                <div class="col-11">
                                    <div class="input-group input-group-merge m-2 ">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <input type="hidden" name="parent_id" value="{{ $post->comment->id ?? '' }}">
                                        <span class="input-group-text" id="basic-addon-comment"><i
                                                class="ti ti-brand-telegram"></i></span>
                                        <input type="text" class="form-control" name="body"
                                            placeholder="Comment......" aria-label="Comment..."
                                            aria-describedby="basic-addon-comment">
                                        <button class="btn btn-outline-success waves-effect" type="submit"
                                            id="basic-addon-comment">comment</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        @include('front.comment-home')
                    </div>
                @endforeach
                <div class="py-4">
                    {{ $posts->links('front.pagination') }}
                    <div>
                        <button id="load-more-btn" class="btn btn-primary">Load More</button>
                    </div>
                </div>
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

@section('script')
    <script>
        $(document).ready(function() {
            var page = 1;

            $('#load-more-btn').click(function() {
                page++;

                $.ajax({
                    url: '/home?page=' + page,
                    type: 'get',
                    success: function(data) {
                        $('#posts').append(data.posts);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.reply-btn').click(function() {
                $('.reply-form').toggle();
            });
        });
    </script>
@endsection
