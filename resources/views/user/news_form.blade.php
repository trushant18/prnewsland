@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Start writing your press release</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Free</li>
                </ol>
            </nav>
        </div>
        <!-- boxes -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Form Elements</h4>
                        <form method="POST" action="{{ route('news.store') }}" accept-charset="UTF-8"
                              class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Select category</label>
                                        <select class="form-control" id="" name="category" required>
                                            @foreach(\App\Models\News::CATEGORIES as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload Featured Image (main)</label>
                                        <input type="file" name="image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled=""
                                                   placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                              </span>
                                        </div>
                                        <small class="text-muted">Recommended Size 1200x620</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Title <span class="require">*</span></label>
                                        <input type="text" name="title" class="form-control" id="" placeholder="Title here..."
                                               required>
                                        <small class="text-muted">Write a creative title</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">City / State <span class="require">*</span></label>
                                        <input type="text" name="city" class="form-control" id="" placeholder="City / State here..."
                                               required>
                                        <small class="text-muted">City or State for which the press release is
                                            concerned.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Add Content <span class="require">*</span></label>
                                        <div id="editor">
                                            <h1>Hello world!</h1>
                                            <p>I'm an instance of <a href="#">PRNewsland</a>.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        {!! Form::select('country', config('countries'), $user->country ?? old('country'), ['class' => 'form-control', 'placeholder' => 'Select Country']) !!}
                                        <small class="text-muted">Country for whith the fress release is
                                            concerned.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary mr-2" data-toggle="modal"
                                            data-target="#thankyouModal">Submit
                                    </button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /boxes -->
    </div>
@endsection
@section('footer_scripts')
    <script src="{{ asset('user/assets/js/file-upload.js') }}"></script>
    <script src="{{ asset('user/assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('user/assets/ckeditor/js/sample.js') }}"></script>
    <script>
        initSample();
    </script>
@endsection
