        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image"
                            class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src="{{ optional($user->getFirstMedia('avatars'))->getUrl() ?: asset('assets/img/avatars/unknown-avatar.jpeg') }}"
                                alt class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" alt="user image" />
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4 class="text-capitalize">{{ $user->name }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item d-inline-flex"><i class="ti ti-color-swatch"></i>
                                            @if (empty($user->bio->job))
                                                {{ 'NULL ' }}
                                            @else
                                                {{ $user->bio->job }}
                                            @endif
                                        </li>
                                        <li class="list-inline-item text-capitalize d-inline-flex"><i
                                                class="ti ti-map-pin"></i>
                                            <span>
                                                {{-- {{ $user->bio->city ? $user->bio->city : 'Null' }} --}}
                                                @if (empty($user->bio->city))
                                                    {{ 'NULL ' }}
                                                @else
                                                    {{ $user->bio->city }}
                                                @endif
                                            </span>
                                        </li>
                                        <li class="list-inline-item d-inline-flex"><i class="ti ti-calendar"></i>
                                            Joined {{ $user->created_at->format('M  Y') }}
                                        </li>
                                    </ul>
                                </div>
                                @if (Auth::check() && Auth::user()->id !== $user->id)
                                    @if (auth()->user()->following->contains($user->id))
                                        <form action="{{ route('users.unfollow', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="btn btn-primary  {{ $user->id == Auth::id() ? 'd-none' : '' }}"
                                                type="submit"><i class="ti ti-user-check me-1"></i> Unfollow</button>
                                        </form>
                                    @else
                                        <form action="{{ route('users.follow', $user->id) }}" method="post">
                                            @csrf
                                            <button
                                                class="btn btn-primary {{ $user->id == Auth::id() ? 'd-none' : '' }}"
                                                type="submit"> <i
                                                    class="ti-xs me-1 ti ti-user-plus"></i>Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->
