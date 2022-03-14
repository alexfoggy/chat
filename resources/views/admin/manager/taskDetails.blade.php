@extends('layouts.admin')
@push('title')
    {{trans('vars.task',[],$lang)}}: {{$task->title ?? ''}}
@endpush
@push('styles')
    {{--    <link href="{{asset('admin/css/AVRecord/AVRecord.css')}}" rel="stylesheet">--}}
@endpush

@section('content')
    @if (\Session::has('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {!! \Session::get('status') !!}
        </div>
    @endif
    <div class="d-flex justify-content-between">
        <div class=""></div>
        <div class="">
            <div class="btn btn-info d-inline editModeButton"><i class="icon ion-gear-a"></i></div>
        </div>
    </div>

    <div class="card card-invoice mt-4">
        <div class="card-body">
            <form action="{{url(request()->segment(1),['task','edit']).'?uuid='.$task->uuid}}" method="POST">
                <div class="invoice-header">
                    <div class="d-flex flex-column align-items-end">
                        <h1 class="invoice-title">{{trans('vars.task',[],$lang)}}</h1>
                        <div class="status pt-2">
                            @if($task->complete_status == 'new')
                                <span
                                    class="bg-pink tx-white tx-12 font-weight-bold p-2">{{trans('vars.new',[],$lang)}}</span>
                            @elseif($task->complete_status == 'in_progress')
                                <span
                                    class="bg-teal tx-white tx-12 font-weight-bold p-2">{{trans('vars.in_progress',[],$lang)}}</span>
                            @elseif($task->complete_status == 'rejected')
                                <span
                                    class="bg-danger tx-white tx-12 font-weight-bold p-2">{{trans('vars.rejected',[],$lang)}}</span>
                            @elseif($task->complete_status == 'delivered')
                                <span
                                    class="bg-info text-white tx-12 font-weight-bold p-2">{{trans('vars.delivered',[],$lang)}}</span>

                            @elseif($task->complete_status == 'checked')
                                <span
                                    class="bg-indigo text-white tx-12 font-weight-bold p-2">{{trans('vars.checked',[],$lang)}}</span>

                            @elseif($task->complete_status == 'approved')
                                <span
                                    class="bg-success text-white tx-12 font-weight-bold p-2">{{trans('vars.approved',[],$lang)}}</span>

                            @elseif($task->complete_status == 'ready_to_invoice')
                                <span
                                    class="bg-success text-white tx-12 font-weight-bold p-2">{{trans('vars.transfering_money',[],$lang)}}</span>
                            @else
                                <span
                                    class="bg-success text-white tx-12 font-weight-bold p-2">{{trans('vars.paid',[],$lang)}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="billed-from">
                        <h6>{{$task->title ?? 'Sites title'}}</h6>
                        <p>{{$task->description ?? 'Sites description'}}</p>
                    </div><!-- billed-from -->
                </div><!-- invoice-header -->

                <div class="row mg-t-20">
                    <div class="col-md pr-5">
                        <label class="section-label-sm tx-gray-500">{{trans('vars.pinned_to',[],$lang)}}</label>
                        <h6 class="tx-gray-800">{{$user->first_name ?? 'NAME'}} {{$user->last_name ?? 'LAST NAME'}}</h6>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.main_lang',[],$lang)}}:</span>
                            <span>{{$user->mainUserLanguage->name ?? ''}}</span>
                        </p>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.country',[],$lang)}}:</span>
                            <span>{{$user->UserCountry->name ?? ''}}</span>
                        </p>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.email',[],$lang)}}:</span>
                            <span>{{$user->email ?? 'is not set'}}</span>
                        </p>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.phone',[],$lang)}}:</span>
                            <span>{{$user->phone ?? 'is not set'}}</span>
                        </p>
                        {{-- <div class="billed-to">
                             <p><span class="text-info"> {{trans('vars.main_lang',[],$lang)}}: {{$user->mainUserLanguage->name ?? ''}} </span><br>
                                 {{trans('vars.country',[],$lang)}}: {{$user->UserCountry->name ?? ''}}<br>
                                 {{trans('vars.email',[],$lang)}}: {{$user->email ?? 'is not set'}} <br>
                                 {{trans('vars.phone',[],$lang)}}: {{$user->phone ?? 'is not set'}}<br>
                             </p>
                         </div>--}}
                    </div><!-- col -->
                    <div class="col-md">
                        <label class="section-label-sm tx-gray-500">{{trans('vars.project_info',[],$lang)}}</label>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.lang',[],$lang)}}:</span>
                            <span>{{$task->project->lang->name ?? ''}}</span>
                        </p>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.speaking_time',[],$lang)}}:</span>
                            <span class="editOpen">{{getTime($task->length)}} min</span>

                        </p>
                        <p class="invoice-info-row">

                            <span>{{trans('vars.type',[],$lang)}}:</span>
                            <span>{{$task->project->type}}</span>
                        </p>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.price',[],$lang)}}:</span>
                            <span>{{$task->price ?? '0'}}$</span>
                        </p>
                        <p class="invoice-info-row">
                            <span>{{trans('vars.manager_email',[],$lang)}}:</span>
                            <span>{{$task->project->user->email ?? ''}}</span>
                        </p>
                    </div><!-- col -->
                </div><!-- row -->

                <div class="row mt-4">
                    @csrf
                    <h4 class="col-lg-12 lead text-info mb-3">{{trans('vars.task_contr',[],$lang)}}</h4>
                    <div class="col-lg-2">
                        <label class="form-control-label">{{trans('vars.task_status',[],$lang)}}</label>
                        <select class="form-control select2" data-placeholder="Choose country" name="complete_status"
                                disabled>
                            @foreach(config('general.task.status') as $key => $status)
                                <option value="{{$key}}"
                                        @if($key == $task->complete_status ) selected @endif>{{$status}}</option>
                            @endforeach
                        </select>
                        {{--                    <a href="javascript:;" class="btn btn-info d-block mt-2 updateStatusTask">Update status</a>--}}
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control-label">{{trans('vars.apply_deadline',[],$lang)}}</label>
                        <input type="text" class="form-control fc-datepicker date-pick" name="apply_deadline"
                               value="{{$task->apply_deadline ?? ''}}" placeholder="MM/DD/YYYY"
                               readonly>
                    </div>
                    <div class="col-lg-2">
                        <label class="form-control-label">{{trans('vars.compl_deadline',[],$lang)}}</label>
                        <input type="text" class="form-control fc-datepicker date-pick" name="complete_deadline"
                               value="{{$task->complete_deadline ?? ''}}" placeholder="MM/DD/YYYY"
                               readonly>
                    </div>
                    <div class="col-lg-4">
                        <label class="form-control-label">{{trans('vars.time',[],$lang)}} ({{getTime($task->length)}}
                            min or {{$task->length}} sec)</label>
                        <span class="editHide d-flex"><input class="form-control" type="text" name="length"
                                                             value="{{$task->length}}" placeholder="Time" required
                                                             readonly>
                                        <select name="time_type" id="" class="form-control select2" readonly>
                                            @foreach(config('general.time_types') as $time_type)
                                                <option value="{{$time_type}}">{{$time_type}}</option>
                                            @endforeach
                                        </select></span>
                    </div>
                    <div class="col-lg-2 pt-1 d-none saveTaskButton">
                        <button class="btn btn-success d-block mt-4"
                                type="submit">{{trans('vars.save_changes',[],$lang)}}</button>
                    </div>
                </div>
            </form>
            @if($task->complete_status <> 'approved')
                <div class="d-flex mt-5">
                    <div class="text-center">
                        <div class="btn btn-block btn-info popup-action"
                             data-action="sendReminder/{{$task->uuid}}">
                            {{trans('vars.send_reminder',[],$lang)}}
                        </div>
                        @if($task->remind_date)
                            <span
                                class="tx-12">{{trans('vars.you_remined',[],$lang)}} {{\Carbon\Carbon::parse($task->remind_date)->format('d.m.Y')}}</span>
                        @endif
                        <div class="tx-10 px-2"><i
                                class="icon ion-information-circled"></i>{{trans('vars.if_pers_didnot_finish',[],$lang)}}
                        </div>
                    </div>

                    <div class="ml-2">
                        <div class="btn btn-block btn-success popup-action"
                             data-action="approveTask/{{$task->uuid}}">
                            {{trans('vars.approve_task',[],$lang)}}
                        </div>
                        <div class="tx-10 px-2"><i
                                class="icon ion-information-circled"></i>{{trans('vars.approve_pay',[],$lang)}}</div>
                    </div>

                    {{--                <div class="ml-2">--}}
                    {{--                    <div class="btn btn-block btn-warning popup-action" data-action="resendTask/{{$task->task->uuid}}">Sites contains problem</div>--}}
                    {{--                    <div class="tx-10 px-2"><i class="icon ion-information-circled"></i> need to be redone</div>--}}
                    {{--                </div>--}}

                    <div class="ml-2">
                        <div class="btn btn-block btn-danger popup-action"
                             data-action="revokeTask/{{$task->uuid}}">
                            {{trans('vars.revoke_task',[],$lang)}}
                        </div>
                    </div>
                </div>
            @elseif($task->complete_status == 'invoiced')

                paied

            @else



            @endif

            <hr class="mg-b-20 mg-t-40">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-info lead">{{trans('vars.user_records_task',[],$lang)}}</h3>
                </div>
            </div>

            <div class="append-container mt-4">
                @if($records->isNotEmpty())
                    @foreach($records as $one_record)
                        <div class="jail-color d-flex align-items-center justify-content-between position-relative px-4
                            py-2">
                            <div class="d-flex align-items-center">
                                <a href="{{asset('/storage/'.$one_record->path)}}" download=""
                                   class="lead btn btn-dark">{{trans('vars.download_record',[],$lang)}}</a></div>
                            <div class="playback">
                                <audio src="{{asset('/storage/'.$one_record->path)}}" controls class="hidden"></audio>
                            </div>
                            <div class="d-flex">
                                <div class="info-record-controls d-flex align-items-center">
                                    @if($one_record->validated == 2)
                                        <span class="btn btn-success">{{trans('vars.accepted',[],$lang)}}</span>
                                    @elseif($one_record->validated == 1)
                                        <span class="btn btn-danger">{{trans('vars.declined',[],$lang)}}</span>
                                    @else
                                        <span class="btn btn-warning">{{trans('vars.checking',[],$lang)}}</span>
                                    @endif
                                    <div class="change-status-open ml-2 btn btn-outline-primary">
                                        <i class="icon ion-edit"></i>
                                    </div>
                                </div>
                                <div class="d-none change-record-controls">
                                    <select name="validate" class="form-control select2 d-inline" id="">
                                        <option value="0"
                                                @if($one_record->validated == 0) selected @endif>{{trans('vars.checking',[],$lang)}}
                                        </option>
                                        <option value="1"
                                                @if($one_record->validated == 1) selected @endif>{{trans('vars.declined',[],$lang)}}
                                        </option>
                                        <option value="2"
                                                @if($one_record->validated == 2) selected @endif>{{trans('vars.accepted',[],$lang)}}
                                        </option>
                                    </select>
                                    <div class="btn btn-info ml-1 saveStatusRecord"
                                         data-id="{{$one_record->id}}">{{trans('vars.save_status',[],$lang)}}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>


            {{--            <a href="" class="btn btn-primary btn-block">Pay Now</a>--}}

        </div><!-- card-body -->
    </div>

@endsection
@push('scripts')
    <script src="{{ asset('assets/js/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui/js/jquery-ui.js')}}"></script>

    <script>


        $('.saveStatusRecord').on('click', function () {
            let statusId = $(this).parent().find('select').val();
            let taskId = $(this).data('id');

            $.ajax({
                type: 'POST',
                url: '/manager/recordStatusChange',
                data: {statusId: statusId, taskId: taskId},
                //contentType: 'multipart/form-data',
                // processData: false,
                // contentType: false,
                headers: {
                    'X-CSRF-Token':
                        $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    alertAppend(data.message, 'success');
                }
            });
        })

        $('.change-status-open').on('click', function () {
            $(this).closest('.jail-color').find('.change-record-controls').removeClass('d-none');
            $(this).closest('.info-record-controls').remove();
        })


        $('.date-pick').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "-100:+0",
        });


        $(document).on('click', '.editModeButton', function () {
            $('select,input').removeAttr('readonly');
            $('select,input').removeAttr('disabled');
            $('.saveTaskButton').removeClass('d-none');
        })

    </script>

@endpush
