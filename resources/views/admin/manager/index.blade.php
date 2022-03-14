@extends('layouts.admin')

@push('title')
    {{trans('vars.user',[],$lang)}}
@endpush

@section('content')

    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            {{--            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
            {{--            <li class="breadcrumb-item"><a href="#">Pages</a></li>--}}
            <li class="breadcrumb-item active" aria-current="page">{{trans('vars.page_profile',[],$lang)}}</li>
        </ol>
        <h6 class="slim-pagetitle">{{trans('vars.my_profile',[],$lang)}}</h6>
    </div><!-- slim-pageheader -->

    <div class="row row-sm">
        <div class="col-lg-8">
            <div class="card card-profile">
                <div class="card-body">
                    <div class="media">
                        <img src="http://via.placeholder.com/500x500" alt="">
                        <div class="media-body">
                            <h3 class="card-profile-name">{{$user->first_name ?? ''}} {{$user->last_name ?? 'is not set'}}</h3>
                            <p class="card-profile-position">{{trans('vars.native_language',[],$lang)}}
                                : {{$user->mainUserLanguage->name ?? 'is not set'}}</p>
                            <p class="mg-b-0">{{trans('vars.location',[],$lang)}}
                                : {{$user->UserCountry->name ?? 'is not set'}}</p>

                            <p class="mg-b-0">{{trans('vars.email',[],$lang)}}: {{$user->email ?? 'is not set'}}</p>
                            <p class="mg-b-0">{{trans('vars.phone',[],$lang)}}: {{$user->phone ?? 'is not set'}}</p>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </div><!-- card-body -->
                <div class="card-footer">
                    <div class=""></div>
                    {{--                    <a href="" class="card-profile-direct">http://thmpxls.me/profile?id=katherine</a>--}}
                  {{--  <div>
                        <a href="{{url('manager','edit')}}">{{trans('vars.edit_profile',[],$lang)}}</a>
                        --}}{{--                        <a href="">Profile Settings</a>--}}{{--
                    </div>--}}
                </div><!-- card-footer -->
            </div><!-- card -->
        </div><!-- col-8 -->

    </div><!-- row -->

    </div><!-- container -->

@endsection
@push('scripts')

@endpush
