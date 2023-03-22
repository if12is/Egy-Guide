@extends('layouts.master')

@section('title', 'Dashboard - Category')
@section('style')

@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Category /</span> {{ $category->name }} </h4>
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Offcanvas to add new Category -->
        <div class="card">
            <div class="card-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Update Category</h5>
            </div>
            <div class="card-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-category pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
                    action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data"
                    method="post">
                    @csrf
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-category-name"> Name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror"
                            id="add-category-name" placeholder="category ..." name="name" value="{{ $category->name }}"
                            aria-label="category ...">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-category-description">Description</label>
                        <textarea type="text" id="add-category-description" class="form-control  @error('description') is-invalid @enderror"
                            placeholder="Add description" aria-label="Add description" name="description"> {{ $category->description }} </textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="formFile" class="form-label">Upload Category Image </label>
                        <input class="form-control @error('cat-img') is-invalid @enderror" name="cat-img" type="file"
                            id="formFile" value="{{ old('cat-img') }}">
                        @error('cat-img')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div>Old Image: <a
                                href="{{ $category->getFirstMediaUrl('category_image') }}">{{ $oldImage ? $oldImage->file_name : null }}</a>
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

@endsection
