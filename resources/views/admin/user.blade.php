@extends('layouts.master')

@section('title', 'Dashboard - Users')
@section('style')

@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">Users</h4>

    <!-- Contextual Classes -->

    <div class="card">
        <div class="head-of-table row">
            <div class="col">
                <h5 class="card-header">Users</h5>
            </div>
            <div class="col-2">
                <button class="dt-button add-new btn btn-primary my-3" tabindex="0" aria-controls="DataTables_Table_0"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser"><span><i
                            class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add
                            User</span></span></button>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>Num of posts</th>
                        <th>type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users as $user)
                        <tr class="table-default">
                            <td>
                                @if ($user->is_admin == 1)
                                    <i class="ti ti-brand-sketch ti-lg text-warning me-3"></i>
                                @else
                                    <i class="ti ti-user ti-lg text-warning me-3"></i>
                                @endif
                                <strong>{{ $loop->iteration }}</strong>
                            </td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up mx-1" title="{{ $user->name }}">
                                        <img src="{{ optional($user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                            alt="Avatar" class="rounded-circle" />
                                    </li>
                                    {{ $user->name }}
                                </ul>
                            </td>
                            <td>
                                <span class="text-center">
                                    {{ $user->email }}
                                </span>
                            </td>
                            <td>

                                <span class="text-center mx-5">
                                    {{ count($user->posts) }}
                                </span>
                            </td>
                            <td>
                                @if ($user->is_admin == 1)
                                    <span class="badge bg-label-primary me-1">
                                        Admin
                                    </span>
                                @else
                                    <span class="badge bg-label-success me-1">
                                        User
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($user->is_admin == 0)
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.users.edit', $user->id) }}">
                                                <i class="ti ti-pencil me-1"></i><span
                                                    class="d-none d-sm-inline-block mx-4">Edit
                                            </a>
                                            <form class="dropdown-item"
                                                action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <i class="ti ti-trash me-1"></i>
                                                <span class="d-none d-sm-inline-block">
                                                    <button type="submit" class="btn">Delete</button>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                @endif
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
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-category pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm"
                    action="{{ route('admin.users.create') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-name">Full Name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="add-user-name"
                            placeholder="johan ..." name="name" aria-label="johan ...">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-email">Email</label>
                        <input type="email" id="add-user-email" class="form-control  @error('email') is-invalid @enderror"
                            placeholder="johan@example.com" aria-label="johan@example.com" name="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label class="form-label" for="add-user-password">Password</label>
                        <input type="password" id="add-user-password"
                            class="form-control  @error('password') is-invalid @enderror" placeholder="password"
                            aria-label="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>

                    <div class="mb-3 fv-plugins-icon-container">
                        <label for="formFile" class="form-label">Upload Avatar </label>
                        <input class="form-control @error('avatar') is-invalid @enderror" name="avatar" type="file"
                            id="formFile" value="{{ old('avatar') }}">
                        @error('avatar')
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
@endsection
@section('script')

@endsection
