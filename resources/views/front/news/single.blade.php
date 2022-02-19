@extends('front.layout.master')
@section('content')
    <section class="page-content bb-0">
        <div class="single-post-meta">
            <h2>{{ $news->title }}</h2>
        </div><!--single-post-meta end-->
        <div class="single-post-layout2">
            <div class="container">
                {!! $news->content !!}
            </div>
        </div><!--single-post-layout2 end-->
    </section><!--page-content end-->
@endsection
