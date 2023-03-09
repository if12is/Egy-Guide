@extends('layouts.master-front')

@section('title', 'Road-Map')
@section('style')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@endsection

@section('front')
    <div class="row ">
        <div class="col-md-12">
            <ul
                class="nav nav-pills flex-column flex-sm-row mb-4 justify-content-center align-content-center align-items-center">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('city.posts', $city[0]->id) }}"><i
                            class="ti-xs ti ti-user-check me-1"></i>
                        Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('city.roadMap', $city[0]->id) }}"><i
                            class="ti-xs ti ti-users me-1"></i> Road Map</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1>
                {{ $city[0]->name }}
            </h1>
        </div>
        <div class="col">
            <!-- Form with Image horizontal Modal -->

            <div class="modal-onboarding modal fade animate__animated" id="onboardHorizontalImageModal" tabindex="-1"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content text-center">
                        <div class="modal-body onboarding-horizontal p-0">
                            <div class="onboarding-media">
                                <img src="{{ asset('assets/img/illustrations/undraw_map_dark_re_36sy.svg') }}"
                                    alt=".." width="273" class="img-fluid">
                            </div>
                            <div class="onboarding-content mb-0">
                                <h4 class="onboarding-title text-body">Add New Road Map</h4>
                                <div class="onboarding-info">
                                    In this example you can see a form where you can request some additional information
                                    from the customer when they land on the app page.
                                </div>
                                <form action="{{ route('roadmap.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="nameEx7" class="form-label">Name Of Road Map</label>
                                                <input type="hidden" name="state_id" value="{{ $city[0]->id ?? '' }}">
                                                <input class="form-control" placeholder="Enter road map name ..."
                                                    type="text" value="" name="name" tabindex="0"
                                                    id="nameEx7">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <textarea id="description" name="description"></textarea>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Form with Image horizontal Modal -->
            {{-- btn --}}
            <button type="button" class="btn btn-info waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#onboardHorizontalImageModal">
                Add Road Map
            </button>
            {{-- /btn --}}
        </div>

    </div>
    <div class="row">
        @foreach ($RoadMaps as $RoadMap)
            <div class="card my-3 p-2">
                {!! $RoadMap->description !!}
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    <script>
        $('#description').summernote({
            placeholder: 'Desgin Road Map here',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>


@endsection
