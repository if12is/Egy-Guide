@extends('layouts.master-front')

@section('title', 'Edit Post')
@section('front')
    {{-- ss --}}
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="row d-flex justify-content-end">
                <div class="col-4 ">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-3 ">
                <a href="{{ route('home') }}" class="btn btn-primary">Back To Posts <i
                        class="ti ti-corner-down-left-double mx-2"></i> </a>
            </div>
        </div>
        <div class="row">
            <div class="col-8 m-auto">
                <div class="card">
                    <h5 class="card-header text-center">Update post </h5>
                    <div class="card-body">
                        <form class="" action="{{ route('posts.update', $post->id) }} " method="POST"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" id="title" name="title" value="{{ $post->title }}"
                                        class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Enter Title of post" />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="valid-feedback">Looks good!</div>
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
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <!-- Primary -->
                                    <label for="select2Primary" class="form-label">Category</label>
                                    <div class="select2-primary">
                                        <select id="select2Primary"
                                            class="select2 form-select @error('category') is-invalid @enderror"
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
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <!-- Basic -->
                                    <label for="select2Country" class="form-label">Country</label>
                                    <select id="select2Country" name="country_id"
                                        class="select2 form-select form-select-lg @error('country') is-invalid @enderror"
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
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col mb-3">
                                    <!-- Basic -->
                                    <label for="select2State" class="form-label">State</label>
                                    <select id="select2State" name="state_id"
                                        class="select2 form-select form-select-lg @error('state') is-invalid @enderror"
                                        data-allow-clear="true" value="{{ old('state') }}">
                                        <option value="{{ $post->state->id }}">{{ $post->state->name }}</option>
                                    </select>
                                    @error('state_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="formFile" class="form-label">Upload Image </label>
                                    <input class="form-control @error('image') is-invalid @enderror" name="image"
                                        type="file" id="formFile" value="{{ $post->image }}">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="valid-feedback">Looks good!</div>
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
    </div>

@endsection
