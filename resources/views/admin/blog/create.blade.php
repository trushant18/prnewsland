@extends('admin.layout.master')
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.blog') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
        <h6 class="slim-pagetitle">Create Blog</h6>
    </div>
    <div class="section-wrapper">
        @include('admin.layout.partials.flash_messages')
        <form method="POST" action="{{ route('admin.blog.store') }}" accept-charset="UTF-8"
              class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @include('admin.blog.form')
        </form>
    </div>
@endsection
