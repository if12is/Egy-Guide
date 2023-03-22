@extends('layouts.master')

@section('title', 'Dashboard - Category')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">Category</h4>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Session</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">21,459</h4>
                                    <span class="text-success">(+29%)</span>
                                </div>
                                <span>Total Users</span>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="ti ti-user ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Paid Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">4,567</h4>
                                    <span class="text-success">(+18%)</span>
                                </div>
                                <span>Last week analytics </span>
                            </div>
                            <span class="badge bg-label-danger rounded p-2">
                                <i class="ti ti-user-plus ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Active Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">19,860</h4>
                                    <span class="text-danger">(-14%)</span>
                                </div>
                                <span>Last week analytics</span>
                            </div>
                            <span class="badge bg-label-success rounded p-2">
                                <i class="ti ti-user-check ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Pending Users</span>
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">237</h4>
                                    <span class="text-success">(+42%)</span>
                                </div>
                                <span>Last week analytics</span>
                            </div>
                            <span class="badge bg-label-warning rounded p-2">
                                <i class="ti ti-user-exclamation ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Users List Table -->


        <!-- Contextual Classes -->

        <div class="card">
            <div class="head-of-table row">
                <div class="col">
                    <h5 class="card-header">Categories</h5>
                </div>
                <div class="col-2">
                    <button class="dt-button add-new btn btn-primary my-3" tabindex="0" aria-controls="DataTables_Table_0"
                        type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i
                                class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add
                                Category</span></span></button>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>Description</th>
                            <th>Num of posts</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $category)
                            <tr class="table-default">
                                <td>
                                    <strong>{{ $loop->iteration }}</strong>
                                </td>
                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-xs pull-up mx-1" title="{{ $category->name }}">
                                            <img src="{{ optional($category->getFirstMedia('category_image'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                                alt="Avatar" class="rounded-circle" />
                                        </li>
                                        {{ $category->name }}
                                    </ul>
                                </td>
                                <td>
                                    {{-- {{ $category->description }} --}}

                                    @php
                                        $words = str_word_count($category->description);
                                        if ($words > 5) {
                                            $truncated_paragraph = implode(' ', array_slice(str_word_count($category->description, 1), 0, 5)) . '...'; // truncate the paragraph after the first 300 words and add an ellipsis
                                        } else {
                                            $truncated_paragraph = $category->description;
                                        }
                                        echo $truncated_paragraph;
                                    @endphp
                                </td>
                                <td>
                                    {{ count($category->posts) }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.categories.edit', $category->id) }}">
                                                <i class="ti ti-pencil me-1"></i><span
                                                    class="d-none d-sm-inline-block mx-4">Edit
                                            </a>
                                            <form class="dropdown-item"
                                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <i class="ti ti-trash me-1"></i>
                                                <span class="d-none d-sm-inline-block">
                                                    <button type="submit" class="btn">Delete</button>
                                                </span>
                                            </form>
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
                    <form class="add-new-category pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
                        action="{{ route('admin.categories.create') }}" enctype="multipart/form-data" method="post">
                        @csrf

                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="add-category-name"> Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                id="add-category-name" placeholder="category ..." name="name"
                                aria-label="category ...">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="mb-3 fv-plugins-icon-container">
                            <label class="form-label" for="add-category-description">Description</label>
                            <textarea type="text" id="add-category-description"
                                class="form-control  @error('description') is-invalid @enderror" placeholder="Add description"
                                aria-label="Add description" name="description"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="mb-3 fv-plugins-icon-container">
                            <label for="formFile" class="form-label">Upload Category Image </label>
                            <input class="form-control @error('cat-img') is-invalid @enderror" name="cat-img"
                                type="file" id="formFile" value="{{ old('cat-img') }}">
                            @error('cat-img')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
    </div>
@endsection
@section('script')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/forms-file-upload.js') }}"></script>
@endsection
