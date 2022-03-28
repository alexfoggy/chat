{{--NEW LAYOUT--}}

@extends('layouts.no-header')

@section('content')

    <div class="d-md-flex flex-row-reverse">
        <div class="signin-right">

            <div class="d-flex flex-column">

                <h2 class="signin-title-primary tx-40 mb-3">{{ __('Verify Your Email Address') }}</h2>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif
                <p class="tx-16 tx-thin">{{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},</p>
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary align-baseline">{{ __('click here to request another') }}</button>.
                </form>
                <a href="{{url('returnregister')}}" class="tx-12">{{trans('vars.back_to_reg',[],$lang)}}</a>
            </div>

        </div><!-- signin-right -->
        <div class="signin-left"
             style="background-image: url('{{asset('images/recoding-girl.jpg')}}');background-size: cover;background-position: right center;">
            <div class="signin-box tx-white">
                <h2 class="slim-logo tx-50"><a href="/">Yolly<span>.</span></a></h2>

                <p>{{trans('vars.sign_page_text',[],$lang)}}</p>

                <p>{{trans('vars.sign_page_sub_text',[],$lang)}}</p>

                <p><a href="" class="btn btn-primary pd-x-25">{{trans('vars.learm_more',[],$lang)}}</a></p>

                <p class="tx-12">© Copyright {{date('Y')}}. All Rights Reserved.</p>
            </div>
        </div><!-- signin-left -->
    </div>

