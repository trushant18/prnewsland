@extends('front.layout.master')
@section('content')
    <section class="career-page">
        <div class="container">
            <div class="sv-title v2 text-center">
                <h2>{{ $pageDetails->title ?? \App\Models\Page::PAGE_TYPES[$page_type] }}</h2>
            </div><!--sv-title end-->
            {!! $pageDetails->content ?? "Data Not Found" !!}
        </div>
    </section>
@endsection
