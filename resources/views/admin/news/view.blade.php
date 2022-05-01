@extends('admin.layout.master')
@section('content')
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.news') }}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">View</li>
        </ol>
        <h6 class="slim-pagetitle">News Details</h6>
    </div>
    <div class="section-wrapper">
        <div class="form-layout form-layout-6">
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    Title:
                </div>
                <div class="col-7 col-sm-8">
                    {{ $news->title }}
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    Slug:
                </div>
                <div class="col-7 col-sm-8">
                    {{ $news->slug ?? "- - -" }}
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    Category
                </div>
                <div class="col-7 col-sm-8">
                    {{ \App\Models\News::CATEGORIES[$news->category] }}
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    Content:
                </div>
                <div class="col-7 col-sm-8">
                    {!! $news->content ?? '- - -' !!}
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    City:
                </div>
                <div class="col-7 col-sm-8">
                    {!! $news->city !!}
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    Country:
                </div>
                <div class="col-7 col-sm-8">
                    {!! $news->country !!}
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    Plan:
                </div>
                <div class="col-7 col-sm-8">
                    {!! $news->planDetails->title ?? "- - -" !!}
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-5 col-sm-4">
                    Image:
                </div>
                <div class="col-7 col-sm-8">
                    @if(isset($news->image))
                        <img src="{{ showNewsImage($news->image) }}" alt="{{ $news->title }}" height="100px">
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
