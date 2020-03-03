@extends('layouts.app', ['class' => 'bg-white'])

@section('content')
    @include('layouts.headers.guest', ['message' => 'Welcome.'])
    <div class="container pb-5" style="margin-top:-20vh;">
        <div class="row">
            <div class="col-lg-7 col-md-5">
                <img class="img-fluid" src="{{asset('argon/img/login_image.png')}}" alt="">
            </div>
            <div class="col-lg-5 col-md-7">
                <div class="card bg-primary shadow-lg border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4 text-white">
                            <small>
                                <a class="text-white font-weight-bold" href="{{ route('register') }}">{{ __('Create new account') }}</a> {{ __('OR Sign in with these credentials:') }}
                            </small>
                            <br>
                            <small>
                                {{ __('Username') }} <strong>admin@argon.com</strong>
                                {{ __('Password') }} <strong>secret</strong>
                            </small>
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="secret" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary my-4">{{ __('Sign in') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
@push('css')
    <style>
        .separator {
            display: none!important;
        }
    </style>
@endpush
