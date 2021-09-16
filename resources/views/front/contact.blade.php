@extends('front.layout.master')
@section('content')
    <section class="contact-v2-map">
        <div class="container-fluid">
            <div class="sv-title wow fadeInUp">
                <span>contact us</span>
                <h2>Give us a shout, we’ll make you a believer.</h2>
            </div><!--sv-title end-->
            <div class="container">
                <div class="row map-oth">
                    <div class="col-md-6">
                        <div class="map-address wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0ms">
                            <h3>Address</h3>
                            <p>{{ $site_configuration['address'] }}</p>
                            <span class="mail">Email: <a href="mailto:example@example.com" title="">{{ $site_configuration['email_address'] }}</a></span>
                            <span class="call-dir">Call directly:</span>
                            <h2 class="phone">{{ $site_configuration['contact_number'] }}</h2>
                        </div><!--map-address end-->
                    </div>
                </div><!--map-oth end-->
            </div>
        </div>
    </section><!--contact-v1-map end-->

    <section class="contact-sec no-bg gray-bg">
        <div class="container">
            <div class="sec-title wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0ms">
                <h2>Ready to get started</h2>
                <span>Ask away! we will response within 24 hours</span>
            </div><!--sec-title end-->
            <form method="post" class="contact-form"
                  action="{{ route('contact.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form--control" id="name" name="name" placeholder="" required>
                            <label for="name">Full Name</label>
                        </div><!--form-group end-->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="email" class="form--control" id="email" name="email" placeholder="" required>
                            <label for="email">Email Address <span>*</span></label>
                        </div><!--form-group end-->
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form--control" id="subject" name="subject" placeholder="">
                            <label for="subject">Subject</label>
                        </div><!--form-group end-->
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form--control" id="message" name="message"></textarea>
                            <label for="message">Your message here</label>
                        </div><!--form-group end-->
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-left m-0">
                            <button type="submit" class="btn-default no-bg">Send Message</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
