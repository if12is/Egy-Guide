<div class="row">
    <form action="{{ route('comments.store') }}" method="post">
        @csrf

        <div class="col-11 ">
            <div class="input-group input-group-merge m-2 ">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="parent_id" value="{{ $post->comment->id ?? '' }}">
                <span class="input-group-text" id="basic-addon-comment"><i class="ti ti-brand-telegram"></i></span>
                <input type="text" class="form-control" name="body" placeholder="Comment......"
                    aria-label="Comment..." aria-describedby="basic-addon-comment">
                <button class="btn btn-outline-success waves-effect" type="submit"
                    id="basic-addon-comment">comment</button>
            </div>
        </div>

    </form>
</div>

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
                                        class="list-group-item  d-flex align-items-center cursor-pointer rounded-2 my-2">
                                        <div class=" mx-3 ">
                                            <div class="avatar avatar-online">
                                                <img src="{{ optional($comment->user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                                    alt="User Image" class="h-auto rounded-circle">
                                            </div>
                                        </div>

                                        <div class="w-100">

                                            <div class="d-flex justify-content-between">
                                                <div class="user-info">
                                                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                                    <p>{{ $comment->body }}</p>
                                                    <small>{{ $comment->created_at->diffForHumans() }}</small>
                                                    <div class="user-status mt-1">
                                                        <small>
                                                            <button
                                                                class="btn btn-primary btn-sm waves-effect waves-light reply-btn ">reply</button>
                                                        </small>
                                                        <small>
                                                            {{-- edit btn model --}}

                                                            <!-- Button trigger modal -->
                                                            <button type="button"
                                                                class="btn btn-sm btn-info waves-effect waves-light {{ $comment->user->id == Auth::user()->id ? '' : 'd-none' }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#basicModal{{ $comment->id }}">
                                                                edit
                                                            </button>

                                                            <!-- Modal -->
                                                            <form id="edit-comment" method="POST"
                                                                action="{{ route('comments.update', $comment->id) }}">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="modal fade"
                                                                    id="basicModal{{ $comment->id }}" tabindex="-1"
                                                                    style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel1">
                                                                                    cComment</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col mb-0">
                                                                                        <label for="body"
                                                                                            class="form-label">body
                                                                                            Title</label>
                                                                                        <input type="text"
                                                                                            id="body"
                                                                                            class="form-control"
                                                                                            placeholder="Enter your comment body "
                                                                                            name="body"
                                                                                            value="{{ $comment->body }} ">
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
                                                            <span class="input-group-text"
                                                                id="basic-addon-comment{{ $comment->id }}"><i
                                                                    class="ti ti-brand-telegram"></i></span>
                                                            <input type="text" class="form-control" name="body"
                                                                placeholder="reply..." aria-label="reply"
                                                                aria-describedby="basic-addon-comment{{ $comment->id }}">
                                                            <button class="btn btn-outline-success waves-effect"
                                                                type="submit"
                                                                id="basic-addon-comment{{ $comment->id }}">reply</button>
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
                                                                <h6 class="mb-0 text-muted">
                                                                    {{ $child->created_at->diffForHumans() }}
                                                                </h6>
                                                                <span>
                                                                    <!-- Icon Dropdown -->
                                                                    <div
                                                                        class="demo-inline-space {{ $child->user->id == Auth::user()->id ? '' : 'd-none' }}">
                                                                        <div class="btn-group">
                                                                            <button type="button"
                                                                                class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <i
                                                                                    class="ti ti-xs ti-dots-vertical"></i>
                                                                            </button>
                                                                            <ul
                                                                                class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <form
                                                                                        action="{{ route('comments.destroy', $child->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        <button class="dropdown-item"
                                                                                            type="submit">Delete
                                                                                            <i
                                                                                                class="ti ti-trash mx-2"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <!--/ Icon Dropdown -->
                                                                </span>
                                                            </div>
                                                            <p>
                                                                {{ $child->body }}
                                                            </p>
                                                            <hr>
                                                            <div
                                                                class="d-flex justify-content-between flex-wrap gap-2">
                                                                <div class="d-flex flex-wrap align-items-center">
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
                                                                    <div class="col-1">
                                                                        {{-- edit btn model --}}

                                                                        <!-- Button trigger modal -->
                                                                        <button type="button"
                                                                            class="btn btn-sm btn-info waves-effect waves-light {{ $child->user->id == Auth::user()->id ? '' : 'd-none' }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#basicModal{{ $child->id }}">
                                                                            edit
                                                                        </button>

                                                                        <!-- Modal -->
                                                                        <form id="edit-comment" method="POST"
                                                                            action="{{ route('comments.update', $child->id) }}">
                                                                            @csrf
                                                                            @method('POST')
                                                                            <div class="modal fade"
                                                                                id="basicModal{{ $child->id }}"
                                                                                tabindex="-1" style="display: none;"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog"
                                                                                    role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="exampleModalLabel1">
                                                                                                cComment</h5>
                                                                                            <button type="button"
                                                                                                class="btn-close"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <div class="row">
                                                                                                <div class="col mb-0">
                                                                                                    <label
                                                                                                        for="body"
                                                                                                        class="form-label">body
                                                                                                        Title</label>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        id="body"
                                                                                                        class="form-control"
                                                                                                        placeholder="Enter your comment body "
                                                                                                        name="body"
                                                                                                        value="{{ $child->body }} ">
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
