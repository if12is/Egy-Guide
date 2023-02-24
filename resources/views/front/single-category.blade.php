@extends('layouts.master-front')

@section('title', 'Category-Posts')
@section('style')

@endsection

@section('front')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Category /</span> {{ $category->name }}</h4>
    @foreach ($posts as $post)
        <div class="d-flex justify-content-center my-5">
            <article class="social-article">
                <div class="social-left-col">
                    <div class="social-img-wrap shadow">
                        @if ($post->hasMedia('images'))
                            <img src="{{ $post->getFirstMediaUrl('images') }}" class="post-image" alt="{{ $post->title }}">
                        @elseif ($post->hasMedia('videos'))
                            <video controls="controls" style="width: -webkit-fill-available; height: 504px;">
                                <source src="{{ $post->getFirstMediaUrl('videos') }}" type="{{ $post->mime_type }}">
                            </video>
                        @endif
                    </div>
                </div>
                <div class="social-right-col card">
                    <div class="social-header card">
                        <a href="{{ route('home.profile-show', ['id' => $post->user->id]) }}" class="social-profile-img">
                            <img src="{{ optional($post->user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                alt="User Avatar">
                            <div class="social-follow">
                                <a title="user name" class="social-name">{{ $post->user->name }}</a>
                                <span class="SPAN_13">•</span>

                                @if (Auth::check() && Auth::user()->id !== $post->user->id)
                                    @if (auth()->user()->following->contains($post->user->id))
                                        <form action="{{ route('users.unfollow', $post->user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="btn btn-xs btn rounded-pill btn-outline-primary waves-effect {{ $post->user->id == Auth::id() ? 'd-none' : '' }}"
                                                type="submit"><i class="ti ti-user-check me-1"></i> Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow', $post->user->id) }}" method="post">
                                            @csrf
                                            <button
                                                class="btn btn-xs btn rounded-pill btn-outline-success waves-effect {{ $post->user->id == Auth::id() ? 'd-none' : '' }}"
                                                type="submit"> <i class="ti-xs me-1 ti ti-user-plus"></i>Follow</button>
                                        </form>
                                    @endif
                                @endif

                            </div>
                        </a>
                    </div>
                    <div class="social-comments-wrap">
                        <div class="social-post">
                            @include('front.comment-home')
                        </div>
                        <div class="social-icons">
                            <section class="icons-section">
                                @include('front.like-sys')
                                {{-- <button class="icons-button"><span class="icon1"></span></button>
                                <button class="icons-button"><span class="icon2"></span></button>
                                <button class="icons-button"><span class="icon3"></span></button>
                                <button class="icons-button"><span class="icon4"></span></button> --}}
                            </section>
                            <div class="likes-wrap likes like-count-num" id="like-count-num"
                                data-post-id="{{ $post->id }}"><span>{{ $post->reactions()->count() }} </span> likes
                            </div>
                        </div>
                        <div class="social-date"><time>{{ $post->created_at->diffForHumans() }}</time></div>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
    {{ $posts->links('front.pagination') }}
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('.accordion-collapse').addClass('show');

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
            var likeCount = $('div#like-count-num[data-post-id="' + postId + '"]');

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
                        button.find('i').removeClass('fa-heart-o').addClass('fa-heart mx-1');
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
@endsection
