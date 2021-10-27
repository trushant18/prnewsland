@extends('front.layout.master')
@section('schema')
    {{ $blog->schema ?? "" }}
@endsection
@section('content')
    <section class="page-content bb-0">
        <div class="single-post-meta">
            <h2>{{ $blog->title }}</h2>
        </div><!--single-post-meta end-->
        <div class="single-post-layout2">
            <div class="container">
                {!! $blog->content !!}
            </div>
        </div><!--single-post-layout2 end-->
    </section><!--page-content end-->
@endsection
