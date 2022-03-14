@extends('layouts.admin')
@push('title')
    {{trans('vars.projects',[],$lang)}}
@endpush
@push('styles')


@endpush

@section('content')
    @if (\Session::has('status'))
        <div class="alert alert-{{\Session::get('status')['type']}}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {!! \Session::get('status')['msg'] !!}
        </div>
    @endif
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{trans('vars.Projects',[],$lang)}}</li>
        </ol>
        <h6 class="slim-pagetitle">{{trans('vars.proj_list',[],$lang)}}</h6>
    </div>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active show" href="#currient"
                       data-toggle="tab">{{trans('vars.curr',[],$lang)}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#finished" data-toggle="tab">{{trans('vars.finished',[],$lang)}}</a>
                </li>
            </ul>
        </div><!-- card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active show" id="currient">

                    <div class="row">
                        @if($projects->isNotEmpty())
                            @foreach($projects as $one_project)
                                <div class="col-lg-4 mb-4">
                                    <div class="card bg-primary tx-white bd-0">
                                        <a class="card-body" href="{{url(request()->segment(1),'project')}}/{{$one_project->id}}">
                                            <h4 class="card-title tx-white mg-b-10 pr-5 position-relative">{{$one_project->title ?? 'Project title'}}
                                                <span class="position-absolute tx-12 tx-normal"
                                                      style="right:0;top:50%;transform: translateY(-50%)">  {{ \Carbon\Carbon::parse($one_project->created_at)->toFormattedDateString()}}</span>
                                            </h4>
                                            <h6 class="mg-b-10 tx-bold tx-white">
                                                {{trans('vars.subject',[],$lang)}}
                                                : {{$one_project->subject ?? 'Project subject'}}</h6>
                                            <p class="card-subtitle tx-white-8">
                                                {{trans('vars.country',[],$lang)}}
                                                : {{$one_project->countryOne->name ?? 'country is not set'}}</p>
                                            <p class="card-text tx-white-8">
                                                {{trans('vars.lang',[],$lang)}}
                                                : {{$one_project->lang->name ?? 'language is not set'}}</p>
                                            {{--                                            <a href="#" class="card-link tx-white-7 hover-white">Card link</a>--}}
                                            {{--                                            <a href="#" class="card-link tx-white-7 hover-white">Another link</a>--}}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="lead col-lg-12">{{trans('vars.no_projects',[],$lang)}}</div>

                        @endif
                    </div>

                </div><!-- tab-pane -->
                <div class="tab-pane" id="finished">
                    <div class="row">
                        @if($projectsComplited->isNotEmpty())
                            @foreach($projectsComplited as $one_project)
                                <div class="col-lg-4">
                                    <div class="card bg-primary tx-white bd-0">
                                        <a class="card-body" href="{{url('manager','project')}}/{{$one_project->id}}">
                                            <h4 class="card-title tx-white mg-b-10 pr-5 position-relative">{{$one_project->title ?? 'Project title'}}
                                                <span class="position-absolute tx-12 tx-normal"
                                                      style="right:0;top:50%;transform: translateY(-50%)">  {{ \Carbon\Carbon::parse($one_project->created_at)->toFormattedDateString()}}</span>
                                            </h4>
                                            <h6 class="mg-b-10 tx-bold tx-white">
                                                {{trans('vars.subject',[],$lang)}}
                                                : {{$one_project->subject ?? 'Project subject'}}</h6>
                                            <p class="card-subtitle tx-white-8">
                                                {{trans('vars.country',[],$lang)}}
                                                : {{$one_project->countryOne->name ?? 'country is not set'}}</p>
                                            <p class="card-text tx-white-8">
                                                {{trans('vars.lang',[],$lang)}}
                                                : {{$one_project->lang->name ?? 'language is not set'}}</p>
                                            {{--                                            <a href="#" class="card-link tx-white-7 hover-white">Card link</a>--}}
                                            {{--                                            <a href="#" class="card-link tx-white-7 hover-white">Another link</a>--}}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else

                            <div class="lead col-lg-12">{{trans('vars.no_done_projects',[],$lang)}}</div>

                        @endif
                    </div>
                </div><!-- tab-pane -->
                {{--                    <div class="tab-pane" id="toprated">--}}
                {{--                        Top rated content goes here...--}}
                {{--                    </div><!-- tab-pane -->--}}
            </div><!-- tab-content -->
        </div><!-- card-body -->
    </div><!-- card -->


@endsection
@push('scripts')

@endpush
