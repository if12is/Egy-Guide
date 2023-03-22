@extends('layouts.master')

@section('title', 'Dashboard - Posts')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">Posts</h4>

    <!-- Contextual Classes -->

    <div class="card">
        <div class="head-of-table row">
            <div class="col">
                <h5 class="card-header">Posts</h5>
            </div>
            <div class="col-2">
                <button class="dt-button add-new btn btn-primary my-3" tabindex="0" aria-controls="DataTables_Table_0"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i
                            class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add
                            Post</span></span></button>
            </div>
        </div>
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

                                        <a class="dropdown-item" href="{{ route('admin.posts.show', $post->id) }}">
                                            <i class="ti ti-eye me-1"></i><span class="d-none d-sm-inline-block mx-1">Show
                                        </a>

                                        <a class="dropdown-item" href="{{ route('admin.posts.edit', $post->id) }}">
                                            <i class="ti ti-pencil me-1"></i><span
                                                class="d-none d-sm-inline-block mx-1">Edit
                                        </a>

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
                                                    <div class="modal-body">Are you sure you want to delete this item?
                                                    </div>
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

    <div class="card">
        <!-- Offcanvas to add new Category -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
            aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Category</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="needs-validation" id="PostCreate" action="{{ route('admin.posts.create') }}"
                    enctype="multipart/form-data" method="post">
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
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <!-- Primary -->
                            <label for="select2PrimaryUser" class="form-label">User</label>
                            <div class="select2-primary">
                                <select id="select2PrimaryUser"
                                    class="select2 form-select @error('user_id') is-invalid @enderror" name="user_id">
                                    <option value="">Select Category</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }} {{ old('user_id') }}">
                                            {{ $user->name }} ({{ $user->id }})</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="progress mx-auto my-2" style="display:none">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                aria-valuemax="100" style="width: 0%">
                                <span class="sr-only">0% Complete</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#select2Basics').change(function() {
                var countryId = $(this).val();
                var url = "{{ route('states.index', ':id') }}".replace(':id', countryId);

                $.get(url, function(data) {
                    var $stateSelect = $('#select2Basic');
                    $stateSelect.empty();
                    $stateSelect.append($('<option></option>').val('').text('Select a state'));

                    $.each(data, function(i, state) {
                        $stateSelect.append($('<option></option>').val(state.id).text(state
                            .name));
                    });
                });
            });
        });
    </script>
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
@endsection
