@extends('layouts.admin')
@push('title')
    {{trans('vars.my_profile',[],$lang)}}
@endpush
@section('content')
    @if(!$user->UserCountry || !$user->phone || !$user->mainUserLanguage)
        <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>{{trans('vars.acc_not_compl',[],$lang)}}</strong>
             <span> {{trans('vars.fill_it_out',[],$lang)}}. </span>
            <a href="{{url(request()->segment(1),'edit')}}">complite it now.</a>
        </div>
    @endif

    @if (\Session::has('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {!! \Session::get('status') !!}
        </div>
    @endif

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
                        <img
                            src="@if($user->avatar){{asset('storage/'.$user->avatar)}}@else {{asset('images/no-person.svg')}} @endif"
                            alt="">
                        <div class="media-body">
                            <h3 class="card-profile-name">{{$user->first_name ?? ''}} {{$user->last_name ?? 'is not set'}}</h3>
                            <p class="card-profile-position">{{trans('vars.native_language',[],$lang)}}
                                : {{$user->mainUserLanguage->name ?? 'is not set'}}</p>

                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="mg-b-0">{{trans('vars.location',[],$lang)}}
                                        : {{$user->UserCountry->name ?? 'is not set'}}</p>
                                    <p class="mg-b-0">{{trans('vars.email',[],$lang)}}
                                        : {{$user->email ?? 'is not set'}}</p>
                                    <p class="mg-b-0">{{trans('vars.phone',[],$lang)}}
                                        : {{$user->phone ?? 'is not set'}}</p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="mg-b-0">{{trans('vars.age',[],$lang)}}
                                        : {{$age ?? 'is not set'}} {{trans('vars.years',[],$lang)}}</p>
                                </div>
                            </div>

                        </div><!-- media-body -->
                    </div><!-- media -->
                </div><!-- card-body -->
                <div class="card-footer">
                    <div class=""></div>
                    {{--                    <a href="" class="card-profile-direct">http://thmpxls.me/profile?id=katherine</a>--}}
                    <div>
                        <a href="{{url('cabinet','edit')}}" class="btn btn-info"><i class="fa fa-cog"></i></a>
                        {{--                        <a href="">Profile Settings</a>--}}
                    </div>
                </div><!-- card-footer -->
            </div><!-- card -->
            <div class="py-3 px-4 mt-3 bg-white border">
                <div class="media-list row">
                    <div class="col-12">
                        <p class="tx-gray-600 mb-2">{{trans('vars.languages',[],$lang)}}:</p>
                    </div>

                    <div class="col-lg-4 col-6 mb-3">
                        <div class="media py-2 px-2 border bg-info">
                            <div class="media-body">
                                <div href="javascript:;" class="tx-white">{{$user->mainUserLanguage->name ?? ''}}</div>
                                <p class="mb-0 tx-gray-400">@foreach(config('general.language.levels') as $key => $one_level)
                                        @if($user->main_language_level == $key) {{$one_level}} @endif
                                    @endforeach
                                </p>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div>

                    @foreach($dialects as $one_dialect)
                        <div class="col-lg-4 col-6 mb-3">
                            <div class="media py-2 px-2 border">
                                <div class="media-body">
                                    <div class="tx-info">{{$one_dialect->dialectLanguage->name ?? ''}}</div>
                                    <p class="mb-0">@foreach(config('general.language.levels') as $key => $one_level)
                                            @if($one_dialect->level == $key) {{$one_level}} @endif
                                        @endforeach
                                    </p>
                                </div><!-- media-body -->
                            </div><!-- media -->
                        </div>
                    @endforeach
                </div>
            </div>


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
