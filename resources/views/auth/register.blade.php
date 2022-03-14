@extends('layouts.no-header')

@section('content')

    <div class="d-md-flex flex-row-reverse">
        <div class="signin-right">


            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h2 class="signin-title-primary">You are welcome!</h2>
                <h3 class="signin-title-secondary">Sign up to be a part of us.</h3>

                <div class="row row-xs mg-b-10">
                    <div class="col-sm">
                        <input id="first_name" type="text" placeholder="{{ __('First name') }}"
                               class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                               value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-sm mg-t-10 mg-sm-t-0">
                        <input id="last_name" type="text" placeholder="{{ __('Last name') }}"
                               class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                               value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                </div><!-- row -->
                <div class="row row-xs mg-b-10">
                    <div class="col-sm">
                        <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row row-xs mg-b-10">
                    <div class="col-sm">
                        <input id="password" type="password" placeholder="{{ __('Password') }}"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="col-sm mg-t-10 mg-sm-t-0">
                        <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}"
                               class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div><!-- row -->

                <button class="btn btn-primary btn-block btn-signin">{{ __('Register') }}</button>

                <div class="signup-separator"><span>or signup using</span></div>

                <button class="btn btn-facebook btn-block">Sign Up Using Facebook</button>
                <button class="btn btn-success btn-block">Sign Up Using Google</button>

                <p class="mg-t-40 mg-b-0">Already have an account? <a href="{{route('login')}}">Sign In</a></p>

            </form>

        </div><!-- signin-right -->
        <div class="signin-left"
             style="background-image: url('{{asset('images/recoding-girl.jpg')}}');background-size: cover;background-position: right center;">
            <div class="signin-box tx-white">
                <h2 class="slim-logo tx-50"><a href="/"><img src="{{asset('images/xcrowds-white.svg')}}" alt="" width="200"><span></span></a></h2>

                <p>We are excited to launch our new company and product Slim. After being featured in too many magazines
                    to mention and having created an online stir, we know that ThemePixels is going to be big. We also
                    hope to win Startup Fictional Business of the Year this year.</p>

                <p>Browse our site and see for yourself why you need Slim.</p>

                <p><a href="" class="btn btn-primary pd-x-25">Learn More</a></p>

                <p class="tx-12">© Copyright {{date('Y')}}. All Rights Reserved.</p>
            </div>
        </div><!-- signin-left -->
    </div>


{{--@section('content')
<div class="container" style="padding-top: 150px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}
