@extends('user.layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- contacting -->
        <div class="row" id="proBanner">
            <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Thank you for contacting us</p>
                  <a href="{{ route('contact') }}" target="_blank"
                     class="btn btn-primary btn-rounded ml-auto">Concat us</a>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
            </div>
        </div><!-- /contacting -->
        <div class="page-header">
            <h3 class="page-title">Welcome back!</h3>
            <!-- <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav> -->
        </div>
        <div class="row dashCard">
            @foreach($plans as $plan)
                <div class="col-md-4 stretch-card grid-margin">
                    @if($plan->price == 0)
                        <a href="{{ route('news.create') }}"
                           class="card @if($loop->odd) bg-gradient-success @else bg-gradient-danger @endif card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ url('user/images/circle.png') }}" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Press releases <i
                                            class="mdi mdi-bookmark-check mdi-24px float-right"></i></h4>

                                <h2 class="mb-5">Free</h2>
                                <h6 class="card-text">{{ $plan->content }}</h6>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('news.create.paid', $plan->id) }}"
                           class="card @if($loop->odd) bg-gradient-success @else bg-gradient-danger @endif card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ url('user/images/circle.png') }}" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Press releases <i
                                            class="mdi mdi-bookmark-check mdi-24px float-right"></i></h4>

                                <h2 class="mb-5">Paid <small>{{ $plan->price }}$</small></h2>
                                <h6 class="card-text">{{ $plan->content }}</h6>
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach

        </div><!-- /boxes -->
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Something Here</h4>
                        <p class="card-description"> Write text in</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                            galley of type and scrambled it to make a type specimen book.</p>
                        <p>It has survived not only five centuries, but also the leap into electronic typesetting,
                            remaining essentially unchanged.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Something Here</h4>
                        <ul>
                            <li>Lorem ipsum dolor sit amet</li>
                            <li>Consectetur adipiscing elit</li>
                            <li>Integer molestie lorem at massa</li>
                            <li>Facilisis in pretium nisl aliquet</li>
                            <li>Nulla volutpat aliquam velit</li>
                        </ul>
                        <blockquote class="blockquote">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere
                                erat a ante.</p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
