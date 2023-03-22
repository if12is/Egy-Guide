@extends('layouts.master-front')

@section('title', 'Home')


@section('style')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />
@endsection
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


        <div class="wrapper my-5">
            <div id="posts">
                @include('front.posts')
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
    <script src="https://cdn.plyr.io/3.7.3/plyr.polyfilled.js"></script>
    <script>
        $(function() {
            $(".heart").on("click", function() {
                $(this).toggleClass("is-active");
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
    {{-- like toggle --}}
    <script>
        $(document).on('click', '.reaction-btn', function() {
            var button = $(this);
            var postId = button.data('post-id');
            var likeCount = $('p#like-count-num[data-post-id="' + postId + '"]');

            $.ajax({
                url: "{{ route('post.reaction') }}",
                method: 'post',
                data: {
                    post_id: postId,
                    reaction: 'like',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    likeCount.text(response.count + ' Likes');

                    if (response.is_liked) {
                        button.addClass('liked');
                        button.removeClass('btn rounded-pill btn-outline-secondary waves-effect')
                            .addClass(
                                'btn rounded-pill btn-outline-youtube waves-effect');
                        button.find('i').removeClass('fa-heart-o').addClass('fa-heart mx-1')
                    } else {
                        button.removeClass('liked');
                        button.removeClass('btn rounded-pill btn-outline-youtube waves-effect')
                            .addClass(
                                'btn rounded-pill btn-outline-secondary waves-effect');
                        button.find('i').removeClass('fa-heart').addClass('fa-heart-o');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
    {{-- bar process on uploud --}}
    <script>
        $(document).ready(function() {
            $('#PostCreate').submit(function(e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                percentComplete = parseInt(percentComplete * 100);
                                $('.progress').show();
                                $('.progress-bar').width(percentComplete + '%');
                                $('.sr-only').text(percentComplete + '% Complete');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(data) {
                        // handle success
                        var path = data.path;
                    },
                    error: function(data) {
                        // handle error
                        var errorMessage = data.responseText;
                    }
                });
            });
        });
    </script>


    {{-- load more --}}
    <script>
        $(document).ready(function() {
            var loading = false;
            var last_post_id = {{ $posts->last()->id ?? 0 }};

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 300) {
                    if (loading == false) {
                        loading = true;

                        $.get('{{ route('posts.more') }}?last_post_id=' + last_post_id, function(
                            response) {
                            if (response.html.trim().length > 0) {
                                $('#posts').append(response.html);
                                last_post_id = $('.post:last-child').data('post-id');
                                loading = false;
                            } else if (response.message) {
                                $('#posts').append(
                                    '<p class="text-white text-center p-3 card bg-info">' +
                                    response.message + '</p>');
                                loading = true;
                            }
                        });
                    }
                }
            });
        });
    </script>

@endsection
