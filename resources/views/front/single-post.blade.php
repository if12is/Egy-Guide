@extends('layouts.master-front')

@section('title', 'Home')
@section('front')
    <article class="social-article">
        <div class="social-left-col">
            <div class="social-img-wrap">
                <img class="social-img" src="{{ asset('assets/img/backgrounds/6.jpg') }}" />
            </div>
        </div>
        <div class="social-right-col">
            <div class="social-header">
                <a href="/gllcollege/" class="social-profile-img">
                    <img src="{{ asset('assets/img/avatars/3.png') }}" </a>
                    <div class="social-follow">
                        <a title="gllcollege" href="/gllcollege/" class="social-name">gllcollege</a>
                        <span class="SPAN_13">•</span>
                        <button type="button">Follow</button>
                    </div>
            </div>
            <div class="social-comments-wrap">
                <div class="social-post">
                    <div class="social-header">
                        <a href="/gllcollege/" class="social-profile-img">
                            <img src="{{ asset('assets/img/avatars/2.png') }}" alt="gllcollege's profile picture" />
                        </a>
                        <div class="social-copy">
                            <span class="social-name">gllcollege</span>
                            <span class="social-post-copy"> Swimming into the long weekend like Swimming into the long
                                weekend like Swimming into the long weekend like Swimming into the long weekend
                                like...</span>
                            <time>1w</time>
                        </div>
                    </div>
                    <div class="social-header">
                        <a href="/gllcollege/" class="social-profile-img">
                            <img src="{{ asset('assets/img/avatars/2.png') }}" alt="gllcollege's profile picture" />
                        </a>
                        <div class="social-copy">
                            <span class="social-name">gllcollege</span>
                            <span class="social-post-copy"> Swimming into the long weekend like Swimming into the long
                                weekend like Swimming into the long weekend like Swimming into the long weekend
                                like...</span>
                            <time>1w</time>
                        </div>
                    </div>
                    <div class="social-header">
                        <a href="/gllcollege/" class="social-profile-img">
                            <img src="{{ asset('assets/img/avatars/2.png') }}" alt="gllcollege's profile picture" />
                        </a>
                        <div class="social-copy">
                            <span class="social-name">gllcollege</span>
                            <span class="social-post-copy"> Swimming into the long weekend like Swimming into the long
                                weekend like Swimming into the long weekend like Swimming into the long weekend
                                like...</span>
                            <time>1w</time>
                        </div>
                    </div>
                    <div class="social-header">
                        <a href="/gllcollege/" class="social-profile-img">
                            <img src="{{ asset('assets/img/avatars/2.png') }}" alt="gllcollege's profile picture" />
                        </a>
                        <div class="social-copy">
                            <span class="social-name">gllcollege</span>
                            <span class="social-post-copy"> Swimming into the long weekend like Swimming into the long
                                weekend like Swimming into the long weekend like Swimming into the long weekend
                                like...</span>
                            <time>1w</time>
                        </div>
                    </div>
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
@endsection
