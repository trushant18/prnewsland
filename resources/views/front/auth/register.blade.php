@extends('front.layout.master')
@section('content')
    <section class="career-page">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="sv-title v2 text-center">
                        <span>Signup</span>
                        <h2>Create your account</h2>
                        <small>Create your new account</small>
                    </div>
                </div>
            </div><!--sv-title end-->
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    @include('admin.layout.partials.flash_messages')
                    <div class="form p-5 rounded contact-sec no-bg gray-bg">
                        <form method="post" class="contact-form"
                              action="{{ route('user.store') }}">
                            @csrf
                            <div class="form-group mb-5">
                                <input type="text" class="form--control" name="first_name" value="{{ old('first_name') }}"
                                       required>
                                <label for="email">First Name <span>*</span></label>
                            </div>
                            <div class="form-group mb-5">
                                <input type="text" class="form--control" value="{{ old('last_name') }}" name="last_name"
                                       required>
                                <label for="email">Last Name <span>*</span></label>
                            </div>
                            <div class="form-group mb-5">
                                <input type="email" class="form--control" name="email" placeholder="" required value="{{ old('email') }}">
                                <label for="email">Email Address <span>*</span></label>
                            </div><!--form-group end-->
                            <div class="form-group mb-5">
                                <input type="password" class="form--control" name="password" placeholder=""
                                       required>
                                <label for="subject">Password <span>*</span></label>
                            </div><!--form-group end-->
                            <button type="submit" class="btn-default  text-center">Signup</button>
                            <p class="mt-4">Already have an account? <a class="text-primary"
                                                                        href="{{ route('user.login') }}">Log in</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

