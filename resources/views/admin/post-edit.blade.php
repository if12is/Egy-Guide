@extends('layouts.master')

@section('title', 'Dashboard - User')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Post /</span> {{ $post->user->name }} </h4>
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Offcanvas to add new user -->
        <div class="card">
            <div class="card-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Update Post</h5>
            </div>
            <div class="row mx-auto my-2">
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        class="avatar avatar-xs pull-up mx-1" title="{{ $post->user->name }}">
                        <img src="{{ optional($post->user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                            alt="Avatar" class="rounded-circle" />
                    </li>
                    {{ $post->user->name }}
                </ul>
            </div>
            <div class="card-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-category pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
                    action="{{ route('admin.posts.update', $post->id) }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" value="{{ $post->title }}"
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
                                cols="20" rows="3" placeholder="Description of Post">{{ $post->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <!-- Primary -->
                            <label for="select2Primary" class="form-label">User</label>
                            <div class="select2-primary">
                                <select id="select2Primary"
                                    class="select2 form-select @error('user_id') is-invalid @enderror" name="user_id">
                                    </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $post->user->id == $user->id ? 'selected' : '' }}>
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
                                    {{-- <option value="{{ $post->category->id }}" selected>{{ $post->category->name }} --}}
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $post->category->id == $category->id ? 'selected' : '' }}>
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
                            <label for="select2Country" class="form-label">Country</label>
                            <select id="select2Country" name="country_id"
                                class="select2 form-select form-select-lg @error('country_id') is-invalid @enderror"
                                data-allow-clear="true">
                                {{-- <option value="0">Select Country</option> --}}
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ $post->country->id == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col mb-3">
                            <!-- Basic -->
                            <label for="select2State" class="form-label">State</label>
                            <select id="select2State" name="state_id"
                                class="select2 form-select form-select-lg @error('state_id') is-invalid @enderror"
                                data-allow-clear="true" value="{{ old('state_id') }}">
                                <option value="{{ $post->state->id }}">{{ $post->state->name }}</option>
                            </select>
                            @error('state_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="formFile" class="form-label">Upload </label>
                            <input class="form-control @error('media') is-invalid @enderror" name="media" type="file"
                                id="formFile" value="{{ old('media') }}">
                            @error('media')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if (
                                $oldImage
                                    ? $oldImage->file_name
                                    : null && Str::contains($oldImage ? $oldImage->file_name : null, ['jpg', 'jpeg', 'png', 'gif']))
                                <div>Old Image: <a
                                        href="{{ $post->getFirstMediaUrl('images') }}">{{ $oldImage ? $oldImage->file_name : null }}</a>
                                </div>
                            @elseif (
                                $oldVideo
                                    ? $oldVideo->file_name
                                    : null && Str::contains($oldVideo ? $oldVideo->file_name : null, ['mp4', 'ogg', 'mov']))
                                <div>Old Video: <a
                                        href="{{ $post->getFirstMediaUrl('videos') }}">{{ $oldVideo ? $oldVideo->file_name : null }}</a>
                                </div>
                            @endif

                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-primary me-sm-3 me-1 data-submit waves-effect waves-light">Submit</button>
                    <button type="reset" class="btn btn-label-secondary waves-effect"
                        data-bs-dismiss="offcanvas">Cancel</button>
                    <input type="hidden">
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#select2Country').change(function() {
                var countryId = $(this).val();
                var url = "{{ route('states.index', ':id') }}".replace(':id', countryId);

                $.get(url, function(data) {
                    var $stateSelect = $('#select2State');
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
