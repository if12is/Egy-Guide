@extends('layouts.master')

@section('title', 'Dashboard - Category')
@section('style')

@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">Category</h4>

    <!-- Contextual Classes -->

    <div class="card">
        <h5 class="card-header">Contextual Classes</h5>
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
                                        {{-- <img src="{{ optional($user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                            alt="Avatar" class="rounded-circle" /> --}}
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
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="ti ti-pencil me-1"></i>
                                            Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i>
                                            Delete</a>
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
