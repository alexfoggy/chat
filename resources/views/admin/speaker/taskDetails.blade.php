@extends('layouts.admin')
@push('title')
    {{trans('vars.your_task',[],$lang)}}: {{$task->task->title ?? 'Task title'}}
@endpush
@push('styles')
    <link href="{{asset('assets/css/AVRecord/AVRecord.css')}}" rel="stylesheet">

@endpush

@section('content')
    <div class="d-none" id="infoBlock" data-time-limit="{{$task->length - $records->pluck('duration')->sum()}}" data-time-recordered="{{$records->pluck('duration')->sum()}}" data-send-route="/api/sendRecord?uuid={{$task->uuid}}" data-audio-format="{{$task->project->format ?? ''}}"></div>
    <div class="row mb-4">
        <div class="col-lg-4 mb-2">
            <div class="card card-status rounded-10">
                <div class="media">
                    <i class="icon fa fa-microphone tx-info"></i>
                    <div class="media-body">
                        <h1><span class="timeDone">{{getTime($records->pluck('duration')->sum())}}</span>
                            / {{getTime($task->length)}}</h1>
                        <p>{{trans('vars.you_recordered',[],$lang)}}</p>
                    </div><!-- media-body -->
                </div><!-- media -->
            </div>
        </div>
        <div class="col-lg-4 mb-2">
            <div class="card card-status rounded-10">
                <div class="media">
                    <i class="icon ion-clock tx-success @if(\Carbon\Carbon::parse($task->project->apply_deadline)->timestamp < \Carbon\Carbon::now()->timestamp) tx-danger-imp @endif"></i>
                    <div class="media-body">
                        <h1 class="@if(\Carbon\Carbon::parse($task->project->apply_deadline)->timestamp < \Carbon\Carbon::now()->timestamp) tx-danger-imp @endif">{{\Carbon\Carbon::parse($task->project->apply_deadline)->format('d.m.Y')}}</h1>
                        <p>{{trans('vars.deadline',[],$lang)}}</p>
                    </div><!-- media-body -->
                </div><!-- media -->
            </div>
        </div>
        @if($task->project->uploadAction == 1)
            <div class="col-lg-4 mb-2">
                <div class="card card-status rounded-10">
                    <div class="media">
                        <i class="icon fa fa-download tx-warning"></i>
                        <div class="media-body">
                            <h1>{{$records_unsaved->count()}}</h1>
                            <p>{{trans('vars.have_no_uploded_files',[],$lang)}}</p>
                        </div><!-- media-body -->
                    </div><!-- media -->
                </div>
            </div>
        @endif
    </div>
    <div class="card card-invoice rounded-10">
        <div class="card-body">
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
                    <h6>{{$task->title ?? 'Task title'}}</h6>
                    <p>{{$task->description ?? 'Task description'}}</p>
                </div><!-- billed-from -->
            </div><!-- invoice-header -->

            <div class="row mg-t-20">
                <div class="col-md lg-pr-5 mb-2">
                    <label class="section-label-sm tx-gray-500">{{trans('vars.pinned_to',[],$lang)}}</label>
                    <div class="billed-to">
                        <h6 class="tx-gray-800">{{$user->first_name ?? 'NAME'}} {{$user->last_name ?? 'LAST NAME'}}
                            (you)</h6>
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
                            <span>{{trans('vars.phone',[],$lang)}} :</span>
                            <span>{{$user->phone ?? 'is not set'}}</span>
                        </p>

                    </div>
                </div><!-- col -->
                <div class="col-md">
                    <label class="section-label-sm tx-gray-500">{{trans('vars.project_info',[],$lang)}}</label>
                    <p class="invoice-info-row">
                        <span>{{trans('vars.lang',[],$lang)}}:</span>
                        <span>{{$task->project->lang->name ?? ''}}</span>
                    </p>
                    <p class="invoice-info-row">
                        <span>{{trans('vars.speaking_time',[],$lang)}}:</span>
                        <span>{{getTime($task->length)}}</span>
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
                <hr class="col-12">
                <div class="col-12">
                    <p class="mt-2 tx-black tx-20 tx-thin">Rules:</p>
                    <div class="">{!!$task->project->rules ?? ''!!}</div>
                </div>
            </div><!-- row -->

            @if($task->complete_status == 'new' || $task->complete_status == 'rejected')
                @if($task->complete_status == 'rejected')

                    <div class="d-flex justify-content-center">
                        <div class="mt-5 text-center">
                            <h3 class="text-uppercase">{{trans('vars.task_is_not_available',[],$lang)}}</h3>
                            <h4 class="tx-danger tx-14 text-uppercase font-weight-light">{{trans('vars.you_rejected_it',[],$lang)}}</h4>
                        </div>
                    </div>

                @else
                    <div class="d-flex justify-content-center">
                        <div class="modal-content bd-0 mt-5 w-50">
                            <div class="modal-header pd-x-20">
                                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{trans('vars.accept_task',[],$lang)}}</h6>

                            </div>
                            <div class="modal-body pd-20">
                                <p class="mg-b-5">{{trans('vars.you_have_to_approve',[],$lang)}}</p>
                                <p>{{trans('vars.if_you_accept_task',[],$lang)}}</p>
                                <p class="tx-danger">{{trans('vars.if_you_reject',[],$lang)}}</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button"
                                        class="btn btn-success accept-task">{{trans('vars.accept_task',[],$lang)}}</button>
                                <button type="button"
                                        class="btn btn-danger reject-task">{{trans('vars.reject',[],$lang)}}</button>
                            </div>
                        </div>
                    </div>
                @endif
            @elseif($task->complete_status == 'approved' || $task->complete_status == 'invoiced')

                <div class="lead text-center mt-5 tx-30">
                    <p class="mb-1">
                        {{trans('vars.task_was_finished',[],$lang)}}
                    </p>
                    <p class="tx-20 mb-5">{{trans('vars.we_like_working_with_you',[],$lang)}}</p>
                    <p class="tx-12 mb-2"> {{trans('vars.if_has_problem',[],$lang)}}<a
                            href="mailto:{{$task->project->user->email ?? ''}}">{{trans('vars.contact_us',[],$lang)}}</a>
                    </p>
                </div>

            @elseif($task->complete_status == 'delivered')

                <h3 class="text-center mt-5 tx-normal tx-success">{{trans('vars.task_was_send_for_verif',[],$lang)}}</h3>
                <h4 class="text-center mt-2 tx-thin">{{trans('vars.wait_feed_back',[],$lang)}}</h4>
                <h5 class="text-center tx-thin mt-4 tx-14">{{trans('vars.if_you_havnotgot',[],$lang)}}<a
                        href="">{{trans('vars.contact_us',[],$lang)}}</a></h5>
            @else
                <hr class="mg-b-20 mg-t-40">
                @if($task->complete_status == 'in_progress')
                    @if($task->length - $records->pluck('duration')->sum() > 0)

                        @if($task->project->uploadAction == 1)

                            <div class="row">
                                <div class="col-lg-12">
                                    <h3 class="text-info font-weight-bold">{{trans('vars.upload_file',[],$lang)}}</h3>
                                </div>
                                <div class="col-lg-3 mt-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="uploadAutio">
                                        <label class="custom-file-label custom-file-label-primary"
                                               for="customFile">{{trans('vars.choose_file',[],$lang)}}</label>
                                    </div>
                                    <div class="lead tx-12 px-1 py-1">{{trans('vars.file_accept',[],$lang)}}<span
                                            class="tx-danger">*</span>
                                    </div>
                                </div>
                                {{--                    <div class="col-lg-12 lead mt-5 mb-1">Files previewer</div>--}}
                                <div class="audio-preview col-lg-12 append-container mt-2">
                                    @if($records_unsaved->isNotEmpty())
                                        @foreach($records_unsaved as $one_record)
                                            <div class="jail-color d-flex align-items-center justify-content-between position-relative px-4
                            py-2">
                                                <div class="align-items-center">
                                                    <h5 class="text-info mb-0 font-weight-bold">{{trans('vars.record',[],$lang)}}</h5>
                                                    <a class="deleteRecord"
                                                       data-id="{{$one_record->id}}">{{trans('vars.delete',[],$lang)}}</a>
                                                </div>
                                                <div class="playback">
                                                    <audio src="{{asset('/storage/'.$one_record->path)}}" controls
                                                           class="hidden"></audio>
                                                </div>
                                                <a href="javascript:;"
                                                   class="btn send-for-upload btn-warning btn-inline"
                                                   data-id="{{$one_record->id}}">
                                                    {{trans('vars.upload',[],$lang)}} </a>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <hr class="mg-b-20 mg-t-40">
                        @endif


                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="text-info font-weight-bold">{{trans('vars.rec_panel',[],$lang)}}</h3>
                            </div>
                        </div>

                        <div class="rec-panel d-flex justify-content-center">
                            <div class="px-5 py-5 border rounded-10 bg-gray-100" >
                                <div class="form-group">
                                    <label class="control-label">Audio input</label>
                                    <div class="">
                                        <select id="audio-in-select" class="form-control rounded-10"></select>
                                    </div>
                                </div>
                                <div class="pids-wrapper">
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                    <div class="pid"></div>
                                </div>
                                <div class="form-group d-flex flex-column align-items-center mb-0">
                                    <div class="control-label"><span id="recording" class="text-danger hidden"><strong class="">Rec </strong></span>&nbsp; <span id="time-display" class="tx-danger tx-20 tx-bold">{{getTime($records->pluck('duration')->sum())}}</span> <span class="tx-20 tx-thin">/</span> <span class="tx-gray-500 tx-20 timeLeft tx-bold">{{getTime($task->length)}}</span></div>
                                    <div class="mt-2 d-flex justify-content-center">
                                        <button id="record" class="btn btn-danger rounded-10 mr-2 px-3 tx-20 tx-bold"><i class="fa fa-microphone"></i> <span class="ml-1">Start</span></button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endif
                @endif
            @endif


        </div>

    </div>

            @endsection
            @push('scripts')

                @if($task->complete_status == 'new' || $task->complete_status == 'rejected')

                    <script>

                        $('.accept-task').on('click', function () {
                            $.ajax({
                                url: "/api/acceptTask/{{$task->uuid}}",
                                type: "POST",
                                success: function (response) {
                                    location.reload();
                                },
                                error: function (error) {

                                }
                            });
                        })
                        $('.reject-task-aprove').on('click', function () {
                            $.ajax({
                                url: "/api/rejectTask/{{$task->id}}",
                                type: "POST",
                                success: function (response) {
                                    location.reload();
                                },
                                error: function (error) {

                                }
                            });
                        })


                    </script>

                @else

                    <script src="{{asset('assets/js/WebAudioRec/WebAudioRecorder.js')}}"></script>
                    <script src="{{asset('assets/js/WebAudioRec/core.js')}}" await></script>




                        @endif


    @endpush
