<div class="mt-2">
    <div class="accordion-item card  p-2">
        <h2 class="accordion-header d-flex align-items-center">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                data-bs-target="#accordionWithIcon-2{{ $post->id }}" aria-expanded="false">
                <i class="me-2 ti ti-message-2 ti-xs"></i>
                comments
            </button>
        </h2>
        <div id="accordionWithIcon-2{{ $post->id }}" class="accordion-collapse collapse" style="">
            <div class="accordion-body">
                <div class="col-12 col-lg-12 mb-12 mb-xl-0">
                    {{-- <small class="text-light fw-semibold ">comment List</small> --}}
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group">
                            @foreach ($post->comments as $comment)
                                @if (!$comment->parent_id)
                                    <div
                                        class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer rounded-2 my-2">
                                        <div class="profile-pic-comment mx-3 ">
                                            <img src="{{ optional($comment->user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                                alt="User Image">
                                        </div>
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <div class="user-info">
                                                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                    <div class="user-status">
                                                        <small>
                                                            <button
                                                                class="btn btn-primary btn-sm waves-effect waves-light reply-btn">reply</button>
                                                        </small>

                                                    </div>
                                                </div>
                                                <div class="add-btn">
                                                    <!-- Icon Dropdown -->
                                                    <div
                                                        class="demo-inline-space {{ $comment->user->id == Auth::user()->id ? '' : 'd-none' }}">
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti ti-xs ti-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    {{-- <a class="dropdown-item" href="">Edit
                                                                        <i class="ti ti-edit  mx-2"></i></a> --}}
                                                                    <div class="mt-3">

                                                                    </div>

                                                                </li>
                                                                <li>
                                                                    <hr class="dropdown-divider" />
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('comments.destroy', $comment->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <button class="dropdown-item"
                                                                            type="submit">Delete
                                                                            <i class="ti ti-trash mx-2"></i> </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!--/ Icon Dropdown -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <form action="{{ route('reply.store') }}" method="post">
                                                    @csrf

                                                    <div class="col-12 reply-form" style="display: none;">
                                                        <div class="input-group input-group-merge my-2 ">
                                                            <input type="hidden" name="post_id"
                                                                value="{{ $post->id }}">
                                                            <input type="hidden" name="parent_id"
                                                                value="{{ $comment->id ?? '' }}">
                                                            <span class="input-group-text" id="basic-addon-comment"><i
                                                                    class="ti ti-brand-telegram"></i></span>
                                                            <input type="text" class="form-control" name="body"
                                                                placeholder="reply..." aria-label="reply"
                                                                aria-describedby="basic-addon-comment">
                                                            <button class="btn btn-outline-success waves-effect"
                                                                type="submit" id="basic-addon-comment">comment</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($comment->children->count())
                                        <div class="replay my-1 p-3">
                                            <ul class="timeline mt-3 mb-0">
                                                @foreach ($comment->children as $child)
                                                    <li
                                                        class="timeline-item timeline-item-info pb-4 border-left-dashed">
                                                        <span class="timeline-indicator timeline-indicator-info">
                                                            <i class="ti ti-user-circle"></i>
                                                        </span>
                                                        <div class="timeline-event">
                                                            <div class="timeline-header">
                                                                <h6 class="mb-0">Interview Schedule</h6>
                                                                <span
                                                                    class="text-muted">{{ $child->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p>
                                                                {{ $child->body }}
                                                            </p>
                                                            <hr>
                                                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                                                <div class="d-flex flex-wrap">
                                                                    <div class="avatar me-3">
                                                                        <img src="{{ optional($child->user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                                                            alt="Avatar" class="rounded-circle">
                                                                    </div>
                                                                    <div>
                                                                        <p class="mb-0">{{ $child->user->name }}</p>
                                                                        {{-- <span class="text-muted">Javascript Developer</span> --}}
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex flex-wrap align-items-centers cursor-pointer">
                                                                    {{-- <i class="ti ti-brand-hipchat me-2"></i>
                                                                <i class="ti ti-phone-call"></i> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
