@extends('front.layout.master')
@section('content')
    <section class="page-content">
        <div class="container">
            <div class="page-sec-title text-center">
                <span>News Articles</span>
                <h2>Writing is socially acceptable from of schizophrenia</h2>
            </div><!--page-sec-title end-->
            <div class="blog-posts-v10 blog-layout1 row">
                @foreach($news_list as $news)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="post-v10">
                            <div class="post-thumb">
                                <img src="{{ showNewsImage($news->image) }}" alt="" class="w-100">
                            </div>
                            <div class="post-info">
                                <h2><a href="{{ route('news.detail', $news->slug) }}" title="">{{ $news->title }}</a></h2>
{{--                                <p>{{ $news->short_content }}</p>--}}
                            </div>
                        </div><!--post-v10 end-->
                    </div>
                @endforeach
            </div><!--blog-posts end-->
        </div>
    </section>
@endsection
