@extends('layout.app')

@section('title', 'Register')

@section('content')

    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-md-7 bg-light">
                <div class="register d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="pb-3">Create an Account</h3>
                                <p>Please fill in the following information to create your account.</p>
                                <form method="POST" action="{{ route('register.submit') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="email">{{ __('Email Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning btn-block">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </form>
                                <div class="sideline">OR</div>
                                <div>
                                    <a href="" class="btn btn-warning w-100 font-weight-bold mt-2"><i
                                            class="fa fa-google" aria-hidden="true"></i> Continue With Google</a>
                                </div>
                                <div class="pt-4 text-center">
                                    Already have an account? <a href="{{ route('login') }}" class="text-warning">Sign In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-none d-md-flex bg-image-register"></div>
        </div>
    </div>

    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
@endsection

@php
    $hideFooter = true;
@endphp
