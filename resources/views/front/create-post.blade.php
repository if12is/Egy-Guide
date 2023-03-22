@extends('layouts.master-front')

@section('title', 'Create - Post')
@section('style')

@endsection

@section('front')
    {{--  create post --}}
    <div class="post_create ">

        {{-- ss --}}
        <div class="col-md post-create">
            <div class="card">
                <h5 class="card-header text-center">Create a New Post </h5>
                <div class="card-body">
                    <form class="needs-validation" id="PostCreate" action="{{ route('posts.store') }}"
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
                                {{-- <div class="valid-feedback">Looks good!</div> --}}
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
                                {{-- <div class="valid-feedback">Looks good!</div> --}}
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
                                    {{-- <div class="valid-feedback">Looks good!</div> --}}
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
                                {{-- <div class="valid-feedback">Looks good!</div> --}}
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
                                {{-- <div class="valid-feedback">Looks good!</div> --}}
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
                                {{-- <div class="valid-feedback">Looks good!</div> --}}
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
@endsection
