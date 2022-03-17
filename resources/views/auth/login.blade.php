@extends('layouts.no-header')

@section('content')

    <div class="d-md-flex flex-row-reverse">
        <div class="signin-right">

            <form method="POST" class="signin-box" action="{{ route('login') }}">
                @csrf
                <h2 class="signin-title-primary">Welcome back!</h2>
                <h3 class="signin-title-secondary">Sign in to continue.</h3>

                <div class="form-group">
                    <input type="text" name="email"
                           value="" required placeholder="Enter your email address"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="{{ __('E-Mail Address') }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group mg-b-10">
                    <input type="password" name="password" required autocomplete="current-password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="{{ __('Password') }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div><!-- form-group -->
                <div class="form-group">
                    <label class="ckbox">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="pl-4">{{ __('Remember Me') }}</span>
                    </label>

                </div>
                <button type="submit" class="btn btn-primary btn-block btn-signin mb-1">
                    {{ __('Login') }}
                </button>
                <p class="mb-4">@if (Route::has('password.request'))
                        <a class="tx-12 tx-gray-500" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </p>
                <div class="signup-separator mb-0"><span>or sign up</span></div>
                <a href="{{route('register')}}" type="submit" class="btn btn-primary btn-block mt-4 btn-signin">
                    {{ __('Register') }}
                </a>


                {{--<p class="mg-b-0">Don't have an account? <a href="{{url('register')}}">Sign Up</a></p>--}}
            </form>

        </div><!-- signin-right -->
        <div class="signin-left bg-gray-900">
            <div class="signin-box tx-white">
                <h2 class="slim-logo tx-50"><a href="/"><img src="{{asset('yolly.svg')}}" alt=""></a></h2>

                <p>We are excited to launch our new company and product Slim. After being featured in too many magazines
                    to mention and having created an online stir, we know that ThemePixels is going to be big. We also
                    hope to win Startup Fictional Business of the Year this year.</p>

                <p>Browse our site and see for yourself why you need Slim.</p>

                <p><a href="" class="btn btn-primary pd-x-25">Learn More</a></p>

                <p class="tx-12">© Copyright {{date('Y')}}. All Rights Reserved.</p>
            </div>
        </div><!-- signin-left -->
    </div>






    {{--

        <div class="container" style="padding-top: 150px;">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="" required placeholder="Enter your email address">

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection
