@extends('front.layout.master')
@section('content')
    <section class="career-page">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="sv-title v2 text-center">
                        <span>login</span>
                        <h2>Login to your Account</h2>
                        <small>Hello, Welcome to your account</small>
                    </div>
                </div>
            </div><!--sv-title end-->
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    @include('admin.layout.partials.flash_messages')
                    <div class="form p-5 rounded contact-sec no-bg gray-bg">
                        <form method="post" class="contact-form"
                              action="{{ route('user.authenticate') }}">
                            @csrf
                            <div class="form-group mb-5">
                                {!! Form::email('email', old('email'), ['class' => 'form--control', 'required']) !!}
                                <label for="email">Email Address <span>*</span></label>
                            </div><!--form-group end-->
                            <div class="form-group mb-4">
                                {!! Form::password('password', old('password'), ['class' => 'form--control', 'required']) !!}
                                <label for="subject">Password <span>*</span></label>
                            </div><!--form-group end-->
                            <div class="d-flex justify-content-between">
                                <div class="form-group mb-4">
                                    {{--<input class="form--control w-auto" type="checkbox" name="" id=""> Remember me--}}
                                </div>
                                <div class="form-group mb-4 text-right">
                                    <a class="text-primary" href="{{ route('user.forgot_password') }}">Forgot Password?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn-default  text-center">Login</button>
                            <p class="mt-4">Already have an account? <a class="text-primary" href="{{ route('user.register') }}">Sign
                                    up</a></p>
                        </form>
                    </div>
                </div>
            </div>
            {{--<div class="text-center pt-4">
                <h3 class="mb-3">or Login with:</h3>
                <ul class="social-links">
                    <li><a href="#" title=""><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-behance"></i></a></li>
                    <li><a href="#" title=""><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>--}}
        </div>
    </section><!--career-page end-->
@endsection


{{--<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $.validate();
</script>--}}
