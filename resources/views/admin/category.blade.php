@extends('layouts.master')

@section('title', 'Dashboard - Users')
@section('style')

@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">Users</h4>

    <!-- Contextual Classes -->

    <div class="card">
        <h5 class="card-header">Contextual Classes</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>name</th>
                        <th>email</th>
                        <th>type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($categories as $category)
                        {{-- <tr class="table-default">
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
                                {{ $user->email }}
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
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-pencil me-1"></i>
                                            Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Contextual Classes -->
@endsection
@section('script')

@endsection
