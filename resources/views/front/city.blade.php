@extends('layouts.master-front')

@section('title', 'City')
@section('style')

@endsection

@section('front')
    <div class="row ">
        <div class="col-md-12">
            <ul
                class="nav nav-pills flex-column flex-sm-row mb-4 justify-content-center align-content-center align-items-center">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('categories.all') }}"><i class="ti-xs ti ti-user-check me-1"></i>
                        Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('cities.all') }}"><i class="ti-xs ti ti-users me-1"></i>
                        City</a>
                </li>

            </ul>
        </div>
    </div>
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User City /</span> Cities</h4>
    <div class="row justify-content-center align-content-center align-items-center">
        @foreach ($cities as $city)
            <div class="col-md-6 col-xl-4 my-2">
                <div class="card bg-dark border-0 text-white">
                    <img class="card-img" src="{{ asset('assets/img/backgrounds/6.jpg') }}" alt="Card image">
                    <div class="card-img-overlay">
                        <a href="{{ route('city.posts', $city->id) }}">
                            <h5 class="card-title">{{ $city->name }}</h5>
                        </a>
                        {{-- <p class="card-text">
                            @php
                                $words = str_word_count($category->description);
                                if ($words > 50) {
                                    $truncated_paragraph = implode(' ', array_slice(str_word_count($category->description, 1), 0, 50)) . '...'; // truncate the paragraph after the first 300 words and add an ellipsis
                                } else {
                                    $truncated_paragraph = $category->description;
                                }
                                echo $truncated_paragraph;
                            @endphp
                        </p> --}}
                        <p class="card-text">Last updated {{ $city->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('script')

@endsection
