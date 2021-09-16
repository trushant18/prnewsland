@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        @include('admin.layout.partials.flash_messages')
        <div class="page-header">
            <h3 class="page-title">Profile & account</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile & account</li>
                </ol>
            </nav>
        </div>
        <!-- boxes -->
        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Edit your profile</h4>
                        <form method="POST" action="{{ route('user.profile.update') }}" accept-charset="UTF-8"
                              class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="dpImg">
                                            <div class="dpImgEdit">
                                                <input name="image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                                <label for="imageUpload"><i class="mdi mdi-grease-pencil"></i></label>
                                            </div>
                                            <div class="dpImgPrev">
                                                @php
                                                    $image = isset($user->image) ? 'storage/user/'.$user->image : 'user/images/pic.svg';
                                                @endphp
                                                <div id="imagePreview" style="background-image: url({{ $image }});">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Full name</label>
                                <input type="hidden" name="update_type" value="general">
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input name="first_name" type="text" required class="form-control w-50" value="{{ $user->first_name }}" placeholder="First Name">
                                        <div class="input-group-append w-50">
                                            <input name="last_name" type="text" required class="form-control" value="{{ $user->last_name }}" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <!-- <input type="text" class="form-control" placeholder="Ragnar Lothbrok"> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="{{ $user->email }}"
                                           placeholder="Enter Email" readonly disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Mobile Number</label>
                                <div class="col-sm-9">
                                    <div class="form-group mb-0">
                                        <input type="text" name="mobile_number" class="form-control"  value="{{ $user->mobile_number }}" placeholder="Enter Mobile Number">
                                    </div>
                                    <!-- <div class="form-group mb-0">
                                      <input type="text" class="form-control" placeholder="000000 00000">
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Company Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="company_name" class="form-control" value="{{ $user->company_name }}" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Company URL <span class="require">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="company_website" class="form-control" value="{{ $user->company_website }}" placeholder="Company URL" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    {!! Form::select('country', config('countries'), $user->country ?? old('country'), ['class' => 'form-control', 'placeholder' => 'Select Country']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Bio</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="bio" rows="3"
                                              placeholder="Start your Bio">{{ $user->bio }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Save profile</button>
                                    <a href="{{ route('user.profile') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 grid-margin">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Change your password</h4>
                        <form method="POST" action="{{ route('user.password.update') }}" accept-charset="UTF-8"
                              class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Old Password</label>
                                <div class="form-group col-sm-9 mb-0">
                                    <input type="password" name="old_password" class="form-control" placeholder="Old Password" data-validation="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">New Password</label>
                                <div class="form-group col-sm-9 mb-0">
                                    <input type="password" name="password_confirmation" class="form-control" data-validation="required" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Confirm Password</label>
                                <div class="form-group col-sm-9 mb-0">
                                    <input type="password" name="password" data-validation="confirmation" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Change password</button>
                                    <a href="{{ route('user.profile') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Social accounts</h4>
                        <form method="POST" action="{{ route('user.profile.update') }}" accept-charset="UTF-8"
                              class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <input type="hidden" name="update_type" value="social">
                                <label for="" class="col-sm-3 col-form-label">Twitter</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="twitter_link" class="form-control" value="{{ $user->twitter_link }}"
                                               placeholder="https://twitter.com/YOUR PROFILE NAME">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-twitter" type="button">
                                                <i class="mdi mdi-twitter"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Facebook</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="facebook_link" class="form-control" value="{{ $user->facebook_link }}"
                                               placeholder="https://www.facebook.com/YOUR_PROFILE_NAME">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-facebook" type="button">
                                                <i class="mdi mdi-facebook"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Linkedin</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="linkedin_link" class="form-control" value="{{ $user->linkedin_link }}"
                                               placeholder="https://www.linkedin.com/in/YOUR_PROFILE_NAME">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-linkedin" type="button">
                                                <i class="mdi mdi-linkedin"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-3 col-form-label">Youtube</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" name="youtube_link" class="form-control" value="{{ $user->youtube_link }}"
                                               placeholder="https://www.youtube.com/YOUR_PROFILE_NAME">
                                        <div class="input-group-append">
                                            <button class="btn btn-sm btn-youtube" type="button">
                                                <i class="mdi mdi-youtube"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Change social links</button>
                                    <a href="{{ route('user.profile') }}" class="btn btn-light">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /boxes -->
        <!-- boxes -->
        {{--<div class="row">
            <div class="col-xl-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Add new card</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label class="sr-only">Name of card</label>
                                <input type="text" class="form-control" placeholder="Name of card*" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Card number</label>
                                <input type="text" class="form-control" placeholder="Card number*" required>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <label for="" class="sr-only">Select month</label>
                                        <select class="form-control" id="">
                                            <option value="Select month">Select month</option>
                                            <option value="01 January">01 January</option>
                                            <option value="02 February">02 February</option>
                                            <option value="03 March">03 March</option>
                                            <option value="04 April">04 April</option>
                                            <option value="05 May">05 May</option>
                                            <option value="06 June">06 June</option>
                                            <option value="07 July">07 July</option>
                                        </select>
                                    </div>
                                    <div class="col-md-auto">
                                        <label for="" class="sr-only">Select year</label>
                                        <select class="form-control" id="">
                                            <option value="Select year">Select year</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label class="sr-only">CVC</label>
                                        <input type="text" class="form-control" placeholder="CVC*" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mr-2">Add new card</button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>--}}<!-- /boxes -->
    </div>
@endsection
@section('footer_scripts')
    <script src="{{ asset('user/assets/js/file-upload.js') }}"></script>

@endsection
