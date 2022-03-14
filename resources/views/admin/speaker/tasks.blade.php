@extends('layouts.admin')
@push('title')
    {{trans('vars.tasks',[],$lang)}}
@endpush
@section('content')
    @if(session('status'))
        <div class="alert alert-danger mg-b-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>{{trans('vars.sorry',[],$lang)}}</strong> {{session('status')}}
        </div>
    @endif

    <div class="section-wrapper mg-t-20">
        <label class="section-title">{{trans('vars.task_list',[],$lang)}}</label>
        <p class="mg-b-20 mg-sm-b-40">{{trans('vars.task_text_sub',[],$lang)}}</p>

        <div class="row">
            @if($tasks)
                @foreach($tasks as $one_task)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 @if($one_task->complete_status == 'rejected') disabled-block @endif">
                        <div class="list-group">
                            <a class="list-group-item d-block pd-y-20 mb-4"
                               href="{{url('cabinet','task').'/'.$one_task->id}}">
                        <span class="d-flex justify-content-between align-items-center tx-12">
                            @if($one_task->complete_status == 'new')
                                <span
                                    class="bg-pink tx-white tx-12 font-weight-bold px-1">{{trans('vars.new',[],$lang)}}</span>
                            @elseif($one_task->complete_status == 'in_progress')
                                <span
                                    class="bg-teal tx-white tx-12 font-weight-bold px-1">{{trans('vars.in_progress',[],$lang)}}</span>
                            @elseif($one_task->complete_status == 'rejected')
                                <span
                                    class="bg-danger tx-white tx-12 font-weight-bold px-1">{{trans('vars.rejected',[],$lang)}}</span>
                            @elseif($one_task->complete_status == 'delivered')
                                <span
                                    class="bg-info text-white tx-12 font-weight-bold px-1">{{trans('vars.delivered',[],$lang)}}</span>

                            @elseif($one_task->complete_status == 'checked')
                                <span
                                    class="bg-indigo text-white tx-12 font-weight-bold px-1">{{trans('vars.checked',[],$lang)}}</span>

                            @elseif($one_task->complete_status == 'approved')
                                <span
                                    class="bg-success text-white tx-12 font-weight-bold px-1">{{trans('vars.approved',[],$lang)}}</span>

                            @elseif($one_task->complete_status == 'ready_to_invoice')
                                <span
                                    class="bg-success text-white tx-12 font-weight-bold px-1">{{trans('vars.transfering_money',[],$lang)}}</span>
                            @else
                                <span
                                    class="bg-success text-white tx-12 font-weight-bold px-1">{{trans('vars.paid',[],$lang)}}</span>
                            @endif
                                <span class="font-weight-bold tx-20 tx-warning">{{$one_task->price}}$</span>
                        </span><!-- d-flex -->
                                <h4 class="lh-2 mg-b-5"><span
                                        class="tx-inverse hover-primary">{{$one_task->title ?? 'Task title'}}</span>
                                </h4>
                                <p class="tx-13 mg-b-0 tx-gray-700">{{$one_task->description ?? 'Task description'}}</p>
                            </a>
                        </div><!-- list-group -->
                    </div><!-- col-6 -->
                @endforeach
            @else
                EMPTY
            @endif

        </div><!-- row -->
    </div>


@endsection
@push('scripts')

@endpush
