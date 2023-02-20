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
        <div class="status-wrapper card justify-content-center align-baseline align-items-center flex-nowrap flex-row">
            <span class="top">Top Rated</span>
            @foreach ($topUsers as $topUser)
                <div class="status-card">
                    <a href="{{ route('home.profile-show', ['id' => $topUser->id]) }}">
                        <div class="profile-pic">
                            <img src="{{ optional($topUser->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                alt="top user">
                        </div>
                    </a>
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

        <div class="wrapper my-2">
            <div class="left-col" id="posts">
                {{-- post  --}}
                @foreach ($posts as $post)
                    <div class="post card mb-4">
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
                        <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                            <p class="mx-4 text-secondary">{{ $post->title }}</p>
                        </a>
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
                                {{-- <div>
                                    @foreach ($post->reactions as $reaction)
                                        <div>
                                            <img src="{{ Reactions::getReactionByKey($reaction->name)->image }}"
                                                alt="{{ $reaction->name }}">
                                            <span>{{ $reaction->count }}</span>
                                        </div>
                                    @endforeach
                                </div> --}}
                            </div>
                            <button class="reaction-btn" data-post-id="{{ $post->id }}" data-reaction="like">
                                <i class="fa fa-heart-o"></i> Like
                            </button>
                            <span class="like-count" data-post-id="{{ $post->id }}">Likes:
                                {{ $post->reactions()->count('reactable_id') }}</span>

                            <p class="likes">1,012 likes</p>
                            <div class="filter">
                                <span class="badge rounded-pill bg-label-primary">#{{ $post->category->name }}</span>
                                <span class="badge rounded-pill bg-label-info">#{{ $post->state->name }}</span>
                            </div>
                            <p class="description">
                                <span><strong> {{ $post->user->name }}</strong> </span> {{ $post->description }}
                            </p>
                            <p class="post-time">{{ $post->created_at->diffForHumans() }}</p>


                        </div>
                        {{-- iclude comment page --}}
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

            <div class="right-col card justify-content-center align-items-center mx-auto">
                <p class="suggestion-text">Suggestions for you</p>
                @foreach ($usersNotFollowed as $user)
                    <div class="profile-card">
                        <a href="{{ route('home.profile-show', ['id' => $user->id]) }}">
                            <div class="profile-pic">
                                <img src="{{ optional($user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                    alt="user profile image for {{ $user->name }}">
                            </div>
                        </a>
                        <div>
                            <p class="username">{{ $user->name }}</p>
                            <p class="sub-text">Joined: {{ $user->created_at->format('M  Y') }}</p>
                        </div>
                        <form action="{{ route('users.follow', $user->id) }}" method="post">
                            @csrf
                            <button class="btn btn-sm rounded-pill btn-outline-success waves-effect mx-2" type="submit">
                                <i class="ti-xs me-1 ti ti-user-plus"></i>Follow</button>
                        </form>
                    </div>
                @endforeach
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
    <script>
        $(document).ready(function() {
            $('.reaction-btn').click(function() {
                var postId = $(this).data('post-id');
                var reaction = $(this).data('reaction');

                $.ajax({
                    url: "{{ route('post.reaction') }}",
                    type: "POST",
                    data: {
                        post_id: postId,
                        reaction: reaction,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        var count = response.count;
                        $(this).text('Liked (' + count + ')');

                        // var count = response.count;
                        // var postId = response.post_id;

                        // // Find the element that shows the reaction count for this post
                        // var reactionCountEl = $('span[data-post-id="' + postId + '"]');

                        // // Update the text of the element with the new reaction count
                        // reactionCountEl.text(count);
                    },
                    error: function(response) {
                        console.log(response.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('click', '.reaction-btn', function() {
            var button = $(this);
            var postId = button.data('post-id');
            var likeCountEl = $('span.like-count[data-post-id="' + postId + '"]');

            $.ajax({
                url: "{{ route('post.reaction') }}",
                method: 'post',
                data: {
                    post_id: postId,
                    reaction: 'like',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    likeCountEl.text('Likes: ' + response.like_count);

                    if (response.is_liked) {
                        button.addClass('liked');
                        button.find('i').removeClass('fa-heart-o').addClass('fa-heart');
                    } else {
                        button.removeClass('liked');
                        button.find('i').removeClass('fa-heart').addClass('fa-heart-o');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endsection
