@extends('layouts.admin')

@push('title')
    {{trans('vars.user',[],$lang)}}
@endpush

@section('content')

    <div class="row row-sm">
        <div class="col-lg-9">
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
                    <div>
                        <a href="{{url('cabinet','edit')}}">{{trans('vars.edit_profile',[],$lang)}}</a>
                        {{--                        <a href="">Profile Settings</a>--}}
                    </div>
                </div><!-- card-footer -->
            </div><!-- card -->
        </div><!-- col-8 -->
        <div class="col-3">
            <div class="card card-people-list pd-20">
                <div class="slim-card-title">Project managerss</div>
                <div class="media-list">
                    @if($project_managers)
                        @foreach($project_managers as $one_manager)
                            <div class="media">
                                <img src="http://via.placeholder.com/500x500" alt="">
                                <div class="media-body">
                                    <a href="">{{$one_manager->first_name ?? ''}} {{$one_manager->last_name ?? ''}}</a>
                                    <p class="tx-12">Project manager</p>
                                </div><!-- media-body -->
                            </div><!-- media -->
                        @endforeach
                    @endif

                </div><!-- media-list -->
            </div>
        </div>

    </div><!-- row -->

@endsection
@push('scripts')

@endpush
