@extends('layouts.master-front')

@section('title', 'Home')

@section('front')
    <div class="d-flex justify-content-center">
        <article class="social-article">
            <div class="social-left-col">
                <div class="social-img-wrap">
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
                            <a title="gllcollege" href="/gllcollege/" class="social-name">{{ $post->user->name }}</a>
                            <span class="SPAN_13">•</span>
                            <button type="button">Follow</button>
                        </div>
                    </a>
                </div>
                <div class="social-comments-wrap">
                    <div class="social-post">
                        @include('front.comment-home')
                    </div>
                    <div class="social-icons">
                        <section class="icons-section">
                            <button class="icons-button"><span class="icon1"></span></button>
                            <button class="icons-button"><span class="icon2"></span></button>
                            <button class="icons-button"><span class="icon3"></span></button>
                            <button class="icons-button"><span class="icon4"></span></button>
                        </section>
                        <div class="likes-wrap"><span>16</span> likes</div>
                    </div>
                    <div class="social-date"><time>April 18</time></div>
                </div>
            </div>
        </article>
    </div>
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
@endsection
