@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Start writing your press release</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    @if($paid_news)
                        <li class="breadcrumb-item active" aria-current="page">Paid</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Free</li>
                    @endif
                </ol>
            </nav>
        </div>
        <!-- boxes -->
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Basic Form Elements</h4>
                        @include('admin.layout.partials.flash_messages')
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
                                <input type="hidden" name="is_free" value="{{ $paid_news ? 0 : 1 }}">
                                <input type="hidden" name="price" value="{{ $price }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload Featured Image (main)</label>
                                        <input type="file" name="image" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled=""
                                                   placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary"
                                                        type="button">Upload</button>
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
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="Title here..."
                                               required>
                                        <small class="text-muted">Write a creative title</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Slug <span class="require">*</span></label>
                                        <input type="text" name="slug" class="form-control" id="slug"
                                               placeholder="New URL here..."
                                               required>
                                        <small class="text-muted">Write a slug fro URL</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Add Content <span class="require">*</span></label>
                                        <textarea name="content" class="form-control wysiwyg_editor" id=""
                                                  placeholder="Enter Content"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">City / State <span class="require">*</span></label>
                                        <input type="text" name="city" class="form-control" id=""
                                               placeholder="City / State here..."
                                               required>
                                        <small class="text-muted">City or State for which the press release is
                                            concerned.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        {!! Form::select('country', config('countries'), $user->country ?? old('country'), ['class' => 'form-control', 'placeholder' => 'Select Country']) !!}
                                        <small class="text-muted">Country for whith the press release is
                                            concerned.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary mr-2" name="button"
                                            value="submit">Submit
                                    </button>
                                    <button type="submit" class="btn btn-success mr-2" name="button"
                                            value="saveAsDraft">Save As Draft
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
@section('css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endsection
@section('footer_scripts')
    <script src="{{ asset('user/assets/js/file-upload.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
        if ($('.wysiwyg_editor').length > 0) {
            $('.wysiwyg_editor').summernote({
                tabsize: 4,
                height: 250
            });
        }

        $("#title").focusout(function (i, d) {
            var title = $.trim($("#title").val());
            if (title.length > 0) {
                title = title.toLowerCase();
                title = title.replace(/[^a-z0-9\s]/gi, "").replace(/  +/g, " ").replace(/[_\s]/g, "-");
            }
            $("#slug").val(title);
        });

        $("#slug").focusout(function (e) {
            var slug = $(this).val().toLowerCase();
            $(this).val(slug);
        });

        $("#slug").keypress(function (e) {
            var regex = new RegExp("^[A-Za-z0-9-]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
    </script>
@endsection
