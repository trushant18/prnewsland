@extends('admin.layout.master')
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.news') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
        <h6 class="slim-pagetitle">Edit News</h6>
    </div>
    <div class="section-wrapper">
        @include('admin.layout.partials.flash_messages')
        <form method="POST" action="{{ route('admin.news.update', $news->id) }}" accept-charset="UTF-8"
              class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                            {!! Form::select('category', \App\Models\News::CATEGORIES, $news->category ?? old('category'), ['class' => 'form-control', 'data-validation' => 'required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                            {!! Form::text('title', $news->title ?? old('title'), ['class' => 'form-control', 'placeholder' => 'Enter title', 'data-validation' => 'required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Image: <span class="tx-danger">*</span></label>
                            <input type="file" accept="image/*" class="file-upload dropify" data-show-remove="false"
                                   @if(isset($news->image)) data-default-file="{{ showNewsImage($news->image) }}" @endif
                                   name="image" data-validation="@if(!isset($news->image)) required @endif mime size"
                                   data-validation-allowing="jpg, png, jpeg" data-validation-max-size="2M"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">City / State <span class="require">*</span></label>
                            <input type="text" name="city" class="form-control" value="{{ $news->city }}"
                                   placeholder="City / State here..."
                                   data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="">Country</label>
                            {!! Form::select('country', config('countries'), $news->country ?? old('country'), ['class' => 'form-control', 'placeholder' => 'Select Country']) !!}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Content: <span class="tx-danger">*</span></label>
                            {!! Form::textarea('content', $news->content ?? old('content'), ['class' => 'form-control wysiwyg_editor', 'placeholder' => 'Enter Content', 'data-validation' => 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-layout-footer">
                    <button type="submit" class="btn btn-primary bd-0">Update</button>
                    <a href="{{ route('admin.news') }}" class="btn btn-secondary bd-0">Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
