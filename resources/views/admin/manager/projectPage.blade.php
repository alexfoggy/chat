@extends('layouts.admin')
@push('title')
    {{trans('vars.project',[],$lang)}}: {{$project->title ?? ''}}
@endpush
@push('styles')

    <link href="{{asset('assets/css/note/css/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/note/css/summernote-bs4.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/note/css/summernote-lite.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/select2/css/select2.min.css')}}" rel="stylesheet">

    <style>
        .tx-danger {
            display: none;
        }
    </style>

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

    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="javascript:;" class="btn btn-danger btn-inline px-3 py-1 popup-action" data-action="deleteProject/{{\Illuminate\Support\Facades\Hash::make($project->id)}}">{{trans('vars.delete',[],$lang)}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <a href="javascript:;" class="btn btn-primary btn-inline px-3 py-1 edit-button">{{trans('vars.edit_project',[],$lang)}}</a>
            </li>
        </ol>
        <h6 class="slim-pagetitle">{{trans('vars.page_project',[],$lang)}}</h6>
    </div>
    <div class="section-wrapper page-project">
        <form action="{{url(request()->segment(1).'/createProject')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$project->id}}" name="id">
            @if($adminStatus == true)
                <input type="hidden" value="{{$project->user_id}}" name="user_id">
            @endif
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.project_title',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="title" value="{{$project->title}}"
                                   placeholder="Enter title" required disabled>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.subject',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="subject" value="{{$project->subject}}"
                                   placeholder="Enter subject" required disabled>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.language',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <select class="form-control select2" name="language"
                                    data-placeholder="Choose language..." required disabled>
                                <option label="Choose language"></option>
                                @if($languages)
                                    @foreach($languages as $one_lang)
                                        <option value="{{$one_lang->id}}"
                                                @if($project->language == $one_lang->id) selected @endif>{{$one_lang->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div><!-- col-8 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.country',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <select class="form-control select2" name="country[]" data-placeholder="Choose country"
                                    required multiple="multiple" disabled>
                                <option label="Choose country"></option>
                                @if($countries)
                                    @foreach($countries as $one_country)
                                        <option value="{{$one_country->id}}"
                                                @foreach($country_list as $one_project_country)
                                                @if($one_project_country == $one_country->id)
                                                selected
                                            @endif
                                            @endforeach>{{$one_country->name ?? ''}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.type',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <select class="form-control select2" name="type" data-placeholder="Choose type"
                                    required disabled>
                                @foreach(config('general.project_types') as $one_type)
                                    <option label="{{$one_type}}" value="{{$one_type}}">{{$one_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- col-4 -->

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.dialect',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <select class="form-control select2" name="dialect"
                                    data-placeholder="Choose language..." required disabled>
                                <option label="Native speaker" value="0"
                                        @if($project->dialect == 0) selected @endif>Native
                                </option>
                                @if($languages)
                                    @foreach($languages as $one_lang)
                                        <option value="{{$one_lang->id}}"
                                                @if($project->dialect == $one_lang->id) selected @endif>{{$one_lang->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.voice',[],$lang)}}: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" name="voice"
                                    data-placeholder="Choose voice" required disabled>
                                @foreach(config('general.voice_types') as $one_type)
                                    <option label="{{$one_type}}" value="{{$one_type}}"
                                            @if($one_type == $project->voice) selected @endif>{{$one_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.voices_and_speakers',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="number" value="{{$project->speakers ?? ''}}"
                                   name="speakers" placeholder="Enter number of speakers" required disabled>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.time',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <div class="d-flex">
                                <input class="form-control" type="text" name="time"
                                       value="@if($project->time_type == 'Min'){{$project->time / 60}}@elseif($project->time_type == 'Hour'){{$project->time / 3600}}@else{{$project->time}}@endif"
                                       placeholder="Time" required disabled>
                                <select name="time_type" id="" class="form-control select2" disabled>
                                    @foreach(config('general.time_types') as $time_type)
                                        <option value="{{$time_type}}"
                                                @if($time_type == $project->time_type) selected @endif>{{$time_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.budget',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="budget" value="{{$project->budget ?? ''}}"
                                   placeholder="Enter budget per project" required disabled>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-control-label">{{trans('vars.deadline',[],$lang)}}: <span
                                class="tx-danger">*</span></label>
                        <div class="wd-200 mg-b-30">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control fc-datepicker date-pick" name="apply_deadline"
                                       value="{{$project->apply_deadline ?? ''}}" placeholder="MM/DD/YYYY" required
                                       disabled>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <label class="form-control-label">{{trans('vars.rules',[],$lang)}}: <span
                                class="tx-danger">*</span></label>
                        <input type="hidden" name="rules" id="rules" value="{{$project->rules}}">
                        <div class="description-block lead">{!! $project->rules ?? 'Rules are not set'!!}</div>
                        <div id="summernote" class="d-none">{!! $project->rules ?? ''!!}</div>
                    </div>


                </div><!-- row -->

                <div class="form-layout-footer d-none buttons-controls">
                    <button class="btn btn-primary bd-0" type="submit">{{trans('vars.save_project',[],$lang)}}</button>
                    <a href="javascript:;"
                       class="btn btn-secondary bd-0 cancel-edition">{{trans('vars.cancel',[],$lang)}}</a>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </form>
    </div><!-- section-wrapper -->

    <div class="mt-5">
        <div class="card card-people-list">
            <div class="slim-card-title d-flex justify-content-between">
                <span>
                    {{trans('vars.created_tasks',[],$lang)}}
                </span>
                <span>
                {{trans('vars.tasks_created',[],$lang)}} <span
                        class="tx-warning tx-20">{{ $timeTasked / 60 }} min </span> {{trans('vars.from_needed',[],$lang)}} <span
                        class="tx-success tx-18"> {{$project->time / 60}} min </span>
                </span>
            </div>
            <div class="media-list list-tasks-created">
                @if($tasks->isNotEmpty())
                    @foreach($tasks as $one_task)
                        @include('admin.ajax_renders.newTaskCreated')
                    @endforeach
                @else
                    <p class="there-is-no">
                        {{trans('vars.there_no_tasks',[],$lang)}}
                    </p>
                @endif
            </div><!-- media-list -->
        </div>

    </div>

    {{--    @if($statusUsersCount == true)
            <div class="alert alert-warning mt-5" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{trans('vars.not_enough_speakers',[],$lang)}}
            </div>
        @endif--}}

    <div class="card card-people-list mt-5">
        <div class="slim-card-title mb-2 d-flex align-items-center justify-content-between">
            <span>Auto task creator</span>
        </div>
        <form action="{{url(request()->segment(1),'autoTaskCreator').'?projectid='.$project->id}}" class="row"
              method="POST">
            @csrf
            <div class="col-lg-3">
                <input class="form-control" placeholder="Number of tasks" type="number" name="autoCreatingTaskCount">
            </div>
            <div class="col-lg-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" name="budget" placeholder="Budget per task" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 d-flex">
                <input class="form-control" placeholder="Time" type="number" name="time">
                <select name="time_type" id="" class="form-control select2">
                    @foreach(config('general.time_types') as $time_type)
                        <option value="{{$time_type}}"
                                @if($time_type == $project->time_type) selected @endif>{{$time_type}}</option>
                    @endforeach
                </select>
            </div><!-- col -->
            <div class="col-lg-12 mt-4 mb-4">
                <label class="rdiobox">
                    <input type="radio" name="optimCreator" value="yes"><span>If not enougth auto add more time and money</span>
                </label>
                <label class="rdiobox">
                    <input type="radio" name="optimCreator" value="no"><span>Create task only for avalible (no more time and money)</span>
                </label>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-info">Create tasks</button>
            </div>
        </form>
    </div>

    {{--<div class="card card-people-list mt-5">
        <div class="slim-card-title mb-2 d-flex align-items-center justify-content-between">
            <span>{{trans('vars.people_aval_for_task',[],$lang)}}</span>
            <div class="panel-tasks d-flex align-items-center">
                <label class="mb-0 ckbox ml-2">
                    <input type="checkbox" name="multi-choice" class="multi-action">
                    <span>{{trans('vars.multi_choice',[],$lang)}}</span>
                </label>
            </div>
        </div>
        <div id="accordion" class="accordion-one" role="tablist" aria-multiselectable="true">
            @if($speakers->isNotEmpty())
                @foreach($speakers as $one_speaker)
                    <form class="card px-2 py-2 border-0">

                        <div class="card-header" role="tab" id="headingOne">
                            <div data-toggle="collapse" data-parent="#accordion" href="#collapse{{$loop->index}}"
                                 aria-expanded="false"
                                 aria-controls="collapseOne" class="d-flex align-items-center dis-collapse">
                                <label class="ckbox multi-checkbox d-none mb-0 mr-3">
                                    <input type="checkbox" value="{{$one_speaker->id}}">
                                    <span class="d-block">
                                    </span>
                                </label>
                                <img src="http://via.placeholder.com/500x500" alt="">
                                <input type="hidden" value="{{$one_speaker->id}}" name="user_id">
                                <div class="media-body">
                                    <a href="javascript:;"
                                       class="px-0 py-1 border-0 font-weight-light">{{$one_speaker->first_name ?? ''}} {{$one_speaker->last_name ?? ''}}</a>
                                    <p class="font-weight-light">
                                        {{trans('vars.lang',[],$lang)}}: {{$one_speaker->mainUserLanguage->name ?? ''}}
                                        ,
                                        {{trans('vars.country',[],$lang)}}
                                        : {{$one_speaker->UserCountry->name ?? ''}}</p>
                                </div><!-- media-body -->

                            </div>
                        </div><!-- card-header -->

                        <div id="collapse{{$loop->index}}" class="collapse" role="tabpanel" aria-labelledby="headingOne"
                             style="">
                            <div class="card-body px-0">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <input class="form-control" type="text" name="title" placeholder="Title"
                                               required>
                                    </div>
                                    <div class="col-lg-2">
                                        <input class="form-control" type="text" name="price" placeholder="Price"
                                               required>
                                    </div>
                                    <div class="col-lg-2">
                                        <input class="form-control" type="text" name="budget" placeholder="Budget"
                                               required>
                                    </div>
                                    <div class="col-lg-2 d-flex">
                                        <input class="form-control" type="text" name="length" placeholder="Time"
                                               required>
                                        <select name="time_type" id="" class="form-control select2">
                                            @foreach(config('general.time_types') as $time_type)
                                                <option value="{{$time_type}}"
                                                        @if($time_type == $project->time_type) selected @endif>{{$time_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    --}}{{--           <div class="col-lg-2">
                                                   <input class="form-control" type="text" name="length" placeholder="Time"
                                                          required>
                                               </div>--}}{{--
                                    <div class="col-lg-5 mt-4">
                                        <textarea class="form-control" type="text" name="description"
                                                  placeholder="Description"
                                                  required></textarea>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <a href="javascript:;"
                                           class="btn btn-primary  createTask">{{trans('vars.create_task',[],$lang)}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            @endif
        </div>
    </div>--}}

    <a href="#modalMultiTask" class="multi-task-openner btn btn-info px-4 py-3 rounded d-none" data-toggle="modal"
       data-effect="effect-sign">
        <i class="fa fa-clone"></i>{{trans('vars.create_multy',[],$lang)}}
    </a>

    </div>


    <div id="modalMultiTask" class="modal fade effect-sign show">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-y-20 pd-x-25">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{trans('vars.create_multy',[],$lang)}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <form class="card px-2 py-2 border-0" action="{{url('manager','tasksCreation')}}" method="POST"
                          enctype="multipart/form-data">
                        <input type="hidden" class="multi-value-form" name="users_id">
                        <input type="hidden" name='project_id' value="{{$project->id}}">
                        @csrf
                        <div class="card-body px-0">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input class="form-control" type="text" name="title" placeholder="Title"
                                           required>
                                </div>
                                <div class="col-lg-6 ">
                                    <input class="form-control" type="text" name="budget" placeholder="Budget"
                                           required>
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <input class="form-control" type="text" name="price" placeholder="Price"
                                           required>
                                    <span>aprox:{{$aprox_price_per_person}}$</span>
                                </div>
                                <div class="col-lg-6 mt-4">
                                    <div class="d-flex">
                                        <input class="form-control" type="text" name="length" placeholder="Time"
                                               required>
                                        <select name="time_type" id="" class="form-control select2">
                                            @foreach(config('general.time_types') as $time_type)
                                                <option value="{{$time_type}}"
                                                        @if($time_type == $project->time_type) selected @endif>{{$time_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span>aprox:{{$aprox_time_per_person}}

                                    </span>
                                </div>
                                {{--           <div class="col-lg-2">
                                               <input class="form-control" type="text" name="length" placeholder="Time"
                                                      required>
                                           </div>--}}
                                <div class="col-lg-12 mt-4">
                                        <textarea class="form-control" type="text" name="description"
                                                  placeholder="Description"
                                                  required></textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Create
                            tasks {{trans('vars.page_project',[],$lang)}}</button>
                </div>

                </form>
            </div><!-- modal-body -->
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    {{--    <script src="{{asset('admin/js/jquery.maskedinput/js/jquery.maskedinput.js')}}" await></script>--}}
    <script src="{{asset('assets/js/moment/js/moment.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/js/note/summernote.min.js')}}"></script>
    <script src="{{asset('assets/js/note/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('assets/js/note/summernote-lite.js')}}"></script>
    <script src="{{asset('assets/js/select2/js/select2.full.min.js')}}"></script>

    <script>
        $('.date-pick').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "-100:+0",
        });


        // Select2 by showing the search
        $(function () {
            'use strict';

            // Select2 by showing the search
            $('.select2').select2({
                minimumResultsForSearch: ''
            });

        });

    </script>

    <script>


        $(document).on('keyup', '.note-editable', function () {
            $('#rules').attr('value', $('#summernote').summernote('code'));
        })

        $('.edit-button').on('click', function () {
            $('.page-project input:disabled').removeAttr("disabled");
            $('.page-project select:disabled').removeAttr("disabled");
            $('.buttons-controls').removeClass("d-none");
            $('.description-block').hide();
            $('#summernote').removeClass("d-none");
            $('.tx-danger').addClass("d-inline");

            $(function () {
                'use strict';

                // Summernote editor
                $('#summernote').summernote({
                    height: 150,
                    tooltip: false
                })

            });

        })

        $('.cancel-edition').on('click', function () {
            $('.page-project input').attr("disabled", true);
            $('.page-project select').attr("disabled", true);
            $('.buttons-controls').addClass("d-none");
            $('.description-block').show();
            $('#summernote').addClass("d-none");
            $('.tx-danger').removeClass("d-inline");

            $('#summernote').summernote('destroy');

        })
    </script>

    <script>

        $(document).on('click', '.createTask', function (e) {
            e.preventDefault();
            let inputs = $(this).closest('form').find('input[type="text"],textarea');
            let i = inputs.length;
            let media = $(this).closest('form');
            inputs.each(function () {
                if ($(this).val()) {
                    i--;
                }
            })
            console.log(i);
            if (i == 0) {

                let form = $(this).closest('form').serialize();

                $.ajax({
                    url: "/api/createTask/{{$project->id}}",
                    type: "POST",
                    data: form,
                    success: function (response) {
                        $('.list-tasks-created .there-is-no').remove();
                        $('.list-tasks-created').append(response.html);
                        media.remove();
                    },
                    error: function (error) {

                    }
                });

            }

        })


        //multi-choice


        function mulriChoControls(e) {
            if (e.is(':checked')) {
                $('.multi-checkbox').removeClass('d-none');
                $('.dis-collapse').attr('data-toggle', 'collapses-off');
            } else {
                $('.multi-checkbox').addClass('d-none');
                $('.dis-collapse').attr('data-toggle', 'collapse');
            }
        };


        $(document).ready(mulriChoControls($('.multi-action')));


        $(document).on('change', '.multi-action', function () {
            if ($(this).is(':checked')) {
                $('.multi-checkbox').removeClass('d-none');
                $('.dis-collapse').attr('data-toggle', 'collapses-off');
            } else {
                $('.multi-checkbox').addClass('d-none');
                $('.dis-collapse').attr('data-toggle', 'collapse');
            }
        });


        $(document).on('click', '.multi-checkbox input', function () {
            if ($('.multi-checkbox input:checked').length > 1) {
                $('.multi-task-openner').removeClass('d-none');
            } else {
                $('.multi-task-openner').addClass('d-none');
            }
            let list_users = $('.multi-checkbox input:checked').val();

            let checkedIds = Array();
            $('.multi-checkbox input:checked').each(function (i, v) {
                checkedIds.push($(v).val());
            });

            $('.multi-value-form').val(checkedIds.join(","));
        })


    </script>

@endpush
