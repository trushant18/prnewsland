@extends('front.layout.master')
@section('content')
    <section class="career-page">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="sv-title v2 text-center">
                        <span>Forgot</span>
                        <h2>Forgot password</h2>
                        <small>Enter the email associated with your account and we'll send an email with instructions to reset your password.</small>
                    </div>
                </div>
            </div><!--sv-title end-->
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    @include('admin.layout.partials.flash_messages')
                    <div class="form p-5 rounded contact-sec no-bg gray-bg">
                        <form method="post" class="contact-form"
                              action="{{ route('user.forgot_password.send_mail') }}">
                            @csrf
                            <div class="form-group mb-5 mt-5">
                                {!! Form::email('email', old('email'), ['class' => 'form--control', 'required']) !!}
                                <label for="email">Email Address <span>*</span></label>
                            </div><!--form-group end-->
                            <button type="submit" class="btn-default  text-center">Send instructions</button>
                            <p class="mt-4">Back to <a class="text-primary" href="{{ route('user.login') }}">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
