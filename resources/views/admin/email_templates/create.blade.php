@extends('admin.layout.master')
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.email_templates') }}">Email Templates</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
        <h6 class="slim-pagetitle">Create Email Template</h6>
    </div>
    <div class="section-wrapper">
        @include('admin.layout.partials.flash_messages')
        <form method="POST" action="{{ route('admin.email_template.store') }}" accept-charset="UTF-8"
              class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @include('admin.email_templates.form')
        </form>
    </div>
@endsection
