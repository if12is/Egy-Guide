  <!-- Large Modal -->
  <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="post">
      @csrf
      <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col mb-3">
                              <label for="title" class="form-label">Title</label>
                              <input type="text" id="title" name="title" value="{{ old('title') }}"
                                  class="form-control @error('title') is-invalid @enderror"
                                  placeholder="Enter Title of post" />
                              @error('title')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="row">
                          <div class="col mb-3">
                              <label for="description" class="form-label">Description</label>
                              <textarea value="{{ old('description') }}" name="description" id="description"
                                  class="form-control @error('description') is-invalid @enderror" cols="20" rows="3"
                                  placeholder="Description of Post"></textarea>
                              @error('description')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="row">
                          <div class="col mb-3">
                              <!-- Primary -->
                              <label for="select2Primary" class="form-label">Category</label>
                              <div class="select2-primary">
                                  <select id="select2Primary"
                                      class="select2 form-select @error('category') is-invalid @enderror"
                                      name="category_id" multiple>
                                      @foreach ($categories as $category)
                                          <option value="{{ $category->id }} {{-- {{ old('category') }} --}}">
                                              {{ $category->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('category')
                                      <div class="alert alert-danger">{{ $message }}</div>
                                  @enderror
                              </div>
                          </div>
                      </div>
                      <div class="row g-2">
                          <div class="col mb-0">
                              <!-- Basic -->
                              <label for="select2Basics" class="form-label">Country</label>
                              <select id="select2Basics" name="country_id"
                                  class="select2 form-select form-select-lg @error('country') is-invalid @enderror"
                                  data-allow-clear="true">
                                  <option value="">Select Country</option>
                                  @foreach ($countries as $country)
                                      <option value="{{ $country->id }}">{{ $country->name }}</option>
                                  @endforeach
                              </select>
                              @error('country')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
                          <div class="col mb-0">
                              <!-- Basic -->
                              <label for="select2Basic" class="form-label">State</label>
                              <select id="select2Basic" name="state_id"
                                  class="select2 form-select form-select-lg @error('state') is-invalid @enderror"
                                  data-allow-clear="true">
                              </select>
                              @error('state')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      <div class="row">
                          <div class="col mt-3">
                              <label for="formFile" class="form-label">UPLOAD PHOTO </label>
                              <input class="form-control @error('image') is-invalid @enderror" name="image"
                                  type="file" id="formFile" value="{{ old('image') }}">
                              @error('image')
                                  <div class="alert alert-danger">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                          Close
                      </button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </div>
          </div>
      </div>
  </form>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
      Create a new Post
      <i class="ti ti-plus mx-1"></i>
  </button>


  {{-- form --}}
  <div class="con">
      <div class="mb-3">
          <label class="form-label" for="bs-validation-email">Email</label>
          <input type="email" id="bs-validation-email" class="form-control" placeholder="john.doe"
              aria-label="john.doe" required="">
          <div class="valid-feedback">Looks good!</div>
          <div class="invalid-feedback">Please enter a valid email</div>
      </div>
      <div class="mb-3 form-password-toggle">
          <label class="form-label" for="bs-validation-password">Password</label>
          <div class="input-group input-group-merge">
              <input type="password" id="bs-validation-password" class="form-control" placeholder="············"
                  required="">
              <span class="input-group-text cursor-pointer" id="basic-default-password4"><i
                      class="ti ti-eye-off"></i></span>
          </div>
          <div class="valid-feedback">Looks good!</div>
          <div class="invalid-feedback">Please enter your password.</div>
      </div>
      <div class="mb-3">
          <label class="form-label" for="bs-validation-country">Country</label>
          <select class="form-select" id="bs-validation-country" required="">
              <option value="">Select Country</option>
              <option value="usa">USA</option>
              <option value="uk">UK</option>
              <option value="france">France</option>
              <option value="australia">Australia</option>
              <option value="spain">Spain</option>
          </select>
          <div class="valid-feedback">Looks good!</div>
          <div class="invalid-feedback">Please select your country</div>
      </div>
      <div class="mb-3">
          <label class="form-label" for="bs-validation-dob">DOB</label>
          <input type="text" class="form-control flatpickr-validation flatpickr-input" id="bs-validation-dob"
              required="">
          <div class="valid-feedback">Looks good!</div>
          <div class="invalid-feedback">Please Enter Your DOB</div>
      </div>
      <div class="mb-3">
          <label class="form-label" for="bs-validation-upload-file">Profile pic</label>
          <input type="file" class="form-control" id="bs-validation-upload-file" required="">
      </div>
      <div class="mb-3">
          <label class="d-block form-label">Gender</label>
          <div class="form-check mb-2">
              <input type="radio" id="bs-validation-radio-male" name="bs-validation-radio"
                  class="form-check-input" required="">
              <label class="form-check-label" for="bs-validation-radio-male">Male</label>
          </div>
          <div class="form-check">
              <input type="radio" id="bs-validation-radio-female" name="bs-validation-radio"
                  class="form-check-input" required="">
              <label class="form-check-label" for="bs-validation-radio-female">Female</label>
          </div>
      </div>
      <div class="mb-3">
          <label class="form-label" for="bs-validation-bio">Bio</label>
          <textarea class="form-control" id="bs-validation-bio" name="bs-validation-bio" rows="3" required=""></textarea>
      </div>
      <div class="mb-3">
          <div class="form-check">
              <input type="checkbox" class="form-check-input" id="bs-validation-checkbox" required="">
              <label class="form-check-label" for="bs-validation-checkbox">Agree to our terms and
                  conditions</label>
              <div class="invalid-feedback">You must agree before submitting.</div>
          </div>
      </div>
      <div class="mb-3">
          <label class="switch switch-primary">
              <input type="checkbox" class="switch-input" required="">
              <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
              </span>
              <span class="switch-label">Send me related emails</span>
          </label>
      </div>
  </div>



  {{-- post 1 --}}
  <div class="post">
      <div class="info">
          <div class="user">
              <div class="profile-pic"><img src="{{ asset('assets/img/avatars/2.png') }}" alt="">
              </div>
              <p class="username">modern_web_channel</p>
          </div>
          <!-- Icon Dropdown -->
          <div class="demo-inline-space">
              <div class="btn-group">
                  <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ti ti-dots-vertical"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                      <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                      <li><a class="dropdown-item" href="javascript:void(0);">Another action</a></li>
                      <li><a class="dropdown-item" href="javascript:void(0);">Something else here</a>
                      </li>
                      <li>
                          <hr class="dropdown-divider" />
                      </li>
                      <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li>
                  </ul>
              </div>
          </div>
          <!--/ Icon Dropdown -->
      </div>
      <img src="{{ asset('assets/img/backgrounds/6.jpg') }}" class="post-image" alt="">
      <div class="post-content">
          <div class="reaction-wrapper">
              <span id="heart">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon like_heart icon-tabler icon-tabler-heart-filled"
                      width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"
                          fill="currentColor"></path>
                  </svg>
              </span>

              <i class="ti ti-heart-off ti-lg ti-flashing-hover" id="dislike"></i>
              <span class="space"></span>
              <i class="ti ti-message-circle-2 ti-lg scaleX-n1 ti-burst-hover" id="iconComment"></i>
              {{-- <a class="signet">
                <svg fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                    <path
                        d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z">
                    </path>
                </svg>
            </a> --}}
          </div>
          <p class="likes">1,012 likes</p>
          <p class="description">
              <span><strong> User_name</strong> </span> Lorem ipsum dolor sit amet consectetur, adipisicing
              elit.
              Pariatur
              tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?
          </p>
          <p class="post-time">2 minutes ago</p>
          <div>
              <p class="comment">
              <div class="profile-pic-comment"><img src="{{ asset('assets/img/avatars/2.png') }}" alt="">
              </div>
              <span><strong> User_name</strong> </span>
              <p>Lorem ipsum dolor sit amet consectetur, adipisicing
                  elit.
                  Pariatur
                  tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?
              </p>
              <p class="post-time">2 minutes ago</p>
          </div>

      </div>
      <div class="comment-wrapper ">
          {{-- <i class="fa-solid fa-message"></i> --}}
          <input type="text" class="comment-box " id="textComment" placeholder="Add a comment">
          <button class="comment-btn">post</button>
          {{-- <img src="img/smile.PNG" class="icon" alt=""> --}}
      </div>
  </div>

  {{-- post3 --}}
  <div class="post">
      <div class="info">
          <div class="user">
              <div class="profile-pic"><img src="{{ asset('assets/img/avatars/2.png') }}" alt="">
              </div>
              <p class="username">modern_web_channel</p>
          </div>
          <img src="img/option.PNG" class="options" alt="">
      </div>
      <img src="{{ asset('assets/img/backgrounds/7.jpg') }}" class="post-image" alt="">
      <div class="post-content">
          <div class="reaction-wrapper">
              <span id="heart">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon like_heart icon-tabler icon-tabler-heart-filled"
                      width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                      fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"
                          fill="currentColor"></path>
                  </svg>
              </span>

              <i class="ti ti-heart-off ti-lg ti-flashing-hover" id="dislike"></i>
              <span class="speace"></span>
              <i class="ti ti-message-circle-2 ti-lg scaleX-n1 ti-burst-hover" id="iconComment"></i>
              {{-- <a class="signet">
                <svg fill="#262626" height="24" viewBox="0 0 48 48" width="24">
                    <path
                        d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z">
                    </path>
                </svg>
            </a> --}}
          </div>
          <p class="likes">1,012 likes</p>
          <p class="description">
              <span><strong> User_name</strong> </span> Lorem ipsum dolor sit amet consectetur, adipisicing
              elit.
              Pariatur
              tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?
          </p>
          <p class="post-time">2 minutes ago</p>
          <div>
              <p class="comment">
              <div class="profile-pic-comment"><img src="{{ asset('assets/img/avatars/2.png') }}" alt="">
              </div>
              <span><strong> User_name</strong> </span> Lorem ipsum dolor sit amet consectetur, adipisicing
              elit.
              Pariatur
              tenetur veritatis placeat, molestiae impedit aut provident eum quo natus molestias?
              </p>
              <p class="post-time">2 minutes ago</p>
          </div>

      </div>
      <div class="comment-wrapper ">
          {{-- <i class="fa-solid fa-message"></i> --}}
          <input type="text" class="comment-box " id="textComment" placeholder="Add a comment">
          <button class="comment-btn">post</button>
          {{-- <img src="img/smile.PNG" class="icon" alt=""> --}}
      </div>
  </div>


  {{-- comment --}}
  {{-- edit btn model --}}

  <!-- Button trigger modal -->
  <button type="button"
      class="btn btn-sm btn-info waves-effect waves-light {{ $comment->user->id == Auth::user()->id ? '' : 'd-none' }}"
      data-bs-toggle="modal" data-bs-target="#basicModal{{ $comment->id }}">
      edit
  </button>

  <!-- Modal -->
  <form id="edit-comment" method="POST" action="{{ route('comments.update', $comment->id) }}">
      @csrf
      @method('POST')
      <div class="modal fade" id="basicModal{{ $comment->id }}" tabindex="-1" style="display: none;"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel1">
                          Vomment</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col mb-0">
                              <label for="body" class="form-label">body
                                  Title</label>
                              <input type="text" id="body" class="form-control"
                                  placeholder="Enter your comment body " name="body"
                                  value="{{ $comment->body }} ">
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                          Close
                      </button>
                      <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                          changes</button>
                  </div>
              </div>
          </div>
      </div>
  </form>
