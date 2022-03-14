@extends('layouts.admin')
@push('title')
    {{trans('vars.user',[],$lang)}} | {{$user_profile->first_name ?? ''}} {{$user_profile->last_name ?? ''}} |
@endpush
@push('styles')
    {{--    <link href="{{asset('admin/css/AVRecord/AVRecord.css')}}" rel="stylesheet">--}}
@endpush

@section('content')


    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            {{--            <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
            {{--            <li class="breadcrumb-item"><a href="#">Pages</a></li>--}}
            <li class="breadcrumb-item active" aria-current="page">Profile
                Page {{trans('vars.user_profile',[],$lang)}}</li>
        </ol>
        <h6 class="slim-pagetitle">{{trans('vars.user_profile',[],$lang)}}</h6>
    </div><!-- slim-pageheader -->

    <div class="row row-sm">
        <div class="col-lg-8">
            <div class="card card-profile">
                <div class="card-body">
                    <div class="media">
                        <img src="{{asset('storage/'.$user_profile->avatar)}}" alt="">
                        <div class="media-body">
                            <h3 class="card-profile-name">{{$user_profile->first_name ?? ''}} {{$user_profile->last_name ?? 'is not set'}}</h3>
                            <p class="card-profile-position">{{trans('vars.native_language',[],$lang)}}
                                : {{$user_profile->mainUserLanguage->name ?? 'is not set'}}</p>
                            <p class="mg-b-0">{{trans('vars.location',[],$lang)}}
                                : {{$user_profile->UserCountry->name ?? 'is not set'}}</p>

                            <p class="mg-b-0">{{trans('vars.email',[],$lang)}}
                                : {{$user_profile->email ?? 'is not set'}}</p>
                            <p class="mg-b-0">{{trans('vars.phone',[],$lang)}}
                                : {{$user_profile->phone ?? 'is not set'}}</p>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </div><!-- card-body -->


            </div><!-- card -->


        </div><!-- col-8 -->

        <div class="col-lg-4 mg-t-20 mg-lg-t-0">

            <div class="card card-status">
                <div class="media">
                    <i class="icon ion-ios-bookmarks-outline tx-teal"></i>
                    <div class="media-body">
                        <h1>{{$userTasks->where('complete_status','invoiced')->count()}}</h1>
                        <p>{{trans('vars.total_tasks_done',[],$lang)}}</p>
                    </div><!-- media-body -->
                </div><!-- media -->
            </div><!-- card -->

            <div class="card card-status mt-2">
                <div class="media">
                    <i class="icon fa fa-money tx-warning"></i>
                    <div class="media-body">
                        <h1>{{$userTasks->where('complete_status','invoiced')->pluck('price')->sum()}}$</h1>
                        <p>{{trans('vars.total_paid_out',[],$lang)}}</p>
                    </div><!-- media-body -->
                </div><!-- media -->
            </div><!-- card -->

            <div class="card card-status mt-2">
                <div class="media">
                    <i class="icon ion-filing tx-pink"></i>
                    <div class="media-body">
                        <h1>{{$userTasks->where('complete_status','<>','invoiced')->count()}}</h1>
                        <p>{{trans('vars.currient_tasks',[],$lang)}}</p>
                    </div><!-- media-body -->
                </div><!-- media -->
            </div><!-- card -->
        </div>
    </div><!-- row -->

    </div><!-- container -->

@endsection
@push('scripts')


@endpush
