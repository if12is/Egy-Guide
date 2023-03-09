@extends('layouts.master')

@section('title', 'Dashboard - Posts')
@section('style')

@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">Posts</h4>

    <!-- Contextual Classes -->

    <div class="card">
        <h5 class="card-header">Contextual Classes</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>user of post </th>
                        <th>title</th>
                        <th>description</th>
                        <th>Approved</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($posts as $post)
                        <tr class="table-default">
                            <td>
                                <strong>{{ $loop->iteration }}</strong>
                            </td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up mx-1" title="{{ $post->user->name }}">
                                        <img src="{{ optional($post->user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                            alt="Avatar" class="rounded-circle" />
                                    </li>
                                    {{ $post->user->name }}
                                </ul>
                            </td>
                            <td>
                                {{-- {{ $post->title }} --}}
                                @php
                                    $words = str_word_count($post->title);
                                    if ($words > 3) {
                                        $truncated_paragraph = implode(' ', array_slice(str_word_count($post->title, 1), 0, 3)) . '...'; // truncate the paragraph after the first 300 words and add an ellipsis
                                    } else {
                                        $truncated_paragraph = $post->title;
                                    }
                                    echo $truncated_paragraph;
                                @endphp
                            </td>
                            <td>

                                @php
                                    $words = str_word_count($post->description);
                                    if ($words > 5) {
                                        $truncated_paragraph = implode(' ', array_slice(str_word_count($post->description, 1), 0, 5)) . '...'; // truncate the paragraph after the first 300 words and add an ellipsis
                                    } else {
                                        $truncated_paragraph = $post->description;
                                    }
                                    echo $truncated_paragraph;
                                @endphp
                                {{-- {{ $post->description }} --}}
                            </td>
                            <td class=" align-items-center justify-content-center">

                                <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
                                    @csrf
                                    @method('POST')
                                    {{-- <label class="switch switch-success">
                                        <input type="checkbox" class="switch-input" name="approved" id="approved"
                                            value="1" {{ $post->approved ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="ti ti-check"></i>
                                            </span>
                                            <span class="switch-off">
                                                <i class="ti ti-x"></i>
                                            </span>
                                        </span>
                                    </label> --}}
                                    <button type="submit" class="btn btn-xs btn-success my-1"><i
                                            class="ti ti-circle-check"></i></button>
                                </form>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-xs btn-danger waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#modalToggle">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                    <!-- Modal 1-->
                                    <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel"
                                        tabindex="-1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel">Delete This Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">Are you sure you want to delete this item?</div>
                                                <div class="modal-footer">
                                                    <form method="POST"
                                                        action="{{ route('admin.posts.delete', $post->id) }}">
                                                        @csrf
                                                        @method('POST')
                                                        <button class="btn btn-danger waves-effect waves-light"
                                                            data-bs-target="#modalToggle2" data-bs-toggle="modal"
                                                            data-bs-dismiss="modal">
                                                            delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-eye me-1"></i>
                                            Show</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-pencil me-1"></i>
                                            Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#modalToggle"><i class="ti ti-trash me-1"></i>
                                            Delete</a>
                                        <!-- Modal 1-->
                                        <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel"
                                            tabindex="-1" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalToggleLabel">Delete This Post</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">Are you sure you want to delete this item?</div>
                                                    <div class="modal-footer">
                                                        <form method="POST"
                                                            action="{{ route('admin.posts.delete', $post->id) }}">
                                                            @csrf
                                                            @method('POST')
                                                            <button class="btn btn-danger waves-effect waves-light"
                                                                data-bs-target="#modalToggle2" data-bs-toggle="modal"
                                                                data-bs-dismiss="modal">
                                                                delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Contextual Classes -->
@endsection
@section('script')

@endsection
