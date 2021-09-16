@extends('front.layout.master')
@section('content')
    <section class="career-page">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="sv-title v2 text-center">
                        <h2>Reset password</h2>
                    </div>
                </div>
            </div><!--sv-title end-->
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    @include('admin.layout.partials.flash_messages')
                    <div class="form p-5 rounded contact-sec no-bg gray-bg">
                        <form method="post" class="contact-form"
                              action="{{ route('user.reset_password.store') }}">
                            @csrf
                            <div class="form-group mb-5 mt-5">
                                {!! Form::email('email', $tokenData->email, ['class' => 'form--control', 'readonly']) !!}
                            </div><!--form-group end-->
                            <div class="form-group mb-4">
                                {!! Form::password('password', old('password'), ['class' => 'form--control', 'required']) !!}
                                <label for="subject">Password <span>*</span></label>
                            </div><!--form-group end-->
                            <button type="submit" class="btn-default  text-center">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
