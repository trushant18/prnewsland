@extends('front.layout.master')
@section('content')
<section class="pricing-v10 clr-default">
    <div class="container">
        <div class="title-v10 text-center wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0ms">
            <h2>Plan & pricing</h2>
        </div><!--title-v10 end-->
        <div class="tb-content">
            <div class="tab-data active" id="monthly">
                <div class="row prices-v10">
                    @foreach($items as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="price-v10">
                            <h4>{{ $item->title }}</h4>
                            <h2><sup>$</sup> {{ $item->price }} <span>/ year</span></h2>
                            <p>{{ $item->content }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
