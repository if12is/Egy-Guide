<div>
    <div class="left-col" >
        {{-- post  --}}
            @foreach ($posts as $post)
                <div class="post card mb-4" data-post-id="{{ $post->id }}">
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
                                    <li><a class="dropdown-item" href="{{ route('posts.edit', $post->id) }}">Edit
                                            <i class="ti ti-edit  mx-2"></i></a> </li>
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
                        <img src="{{ $post->getFirstMediaUrl('images') }}" class="post-image" alt="{{ $post->title }}">
                    @elseif ($post->hasMedia('videos'))
                        <video id="player" playsinline controls
                            style="width: -webkit-fill-available; max-height: 504px;">
                            <source src="{{ $post->getFirstMediaUrl('videos') }}" type="{{ $post->mime_type }}">
                        </video>
                    @endif
                    <div class="post-content">

                        @include('front.like-sys')
                        <p class="likes like-count-num" id="like-count-num" data-post-id="{{ $post->id }}">
                            {{ $post->reactions()->count() }} Likes</p>
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



    </div>
</div>
