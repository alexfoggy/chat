@extends('layouts.admin')
@push('title')
    {{trans('vars.create_project',[],$lang)}}
@endpush
@push('styles')

    <link href="{{asset('assets/css/note/css/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/note/css/summernote-bs4.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/note/css/summernote-lite.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/select2/css/select2.min.css')}}" rel="stylesheet">

@endpush

@section('content')

    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">{{trans('vars.projects',[],$lang)}}</li>
        </ol>
        <h6 class="slim-pagetitle">{{trans('vars.create_project',[],$lang)}}</h6>
    </div>
    <div class="section-wrapper">
        <form action="{{url(request()->segment(1),'createProject')}}" method="POST">
            @csrf
            <div class="form-layout">
                <div class="row mg-b-25">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.project_title',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="title" placeholder="Enter title" required>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.subject',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="subject"
                                   placeholder="Enter subject" required>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.languages',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <select class="form-control select2" name="language"
                                    data-placeholder="Choose language..." required>
                                <option label="Choose language"></option>
                                @if($languages)
                                    @foreach($languages as $one_lang)
                                        <option value="{{$one_lang->id}}"
                                                @if($user->main_language == $one_lang->id) selected @endif>{{$one_lang->name ?? ''}}</option>
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
                                    required multiple>
                                <option label="Choose country"></option>
                                @if($countries)
                                    @foreach($countries as $one_country)
                                        <option value="{{$one_country->id}}"
                                                @if($user->country == $one_country->id) selected @endif>{{$one_country->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.type',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <select class="form-control select2" name="type" data-placeholder="Choose type" required>
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
                                    data-placeholder="Choose language..." required>
                                <option label="Native speaker" value="0">{{trans('vars.native',[],$lang)}}</option>
                                @if($languages)
                                    @foreach($languages as $one_lang)
                                        <option value="{{$one_lang->id}}"
                                                @if($user->main_language == $one_lang->id) selected @endif>{{$one_lang->name ?? ''}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.voice',[],$lang)}}: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" name="voice"
                                    data-placeholder="Choose language..." required>
                                @foreach(config('general.voice_types') as $one_type)
                                    <option label="{{$one_type}}" value="{{$one_type}}">{{$one_type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.voices_and_speakers',[],$lang)}} : <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="number" name="speakers"
                                   placeholder="Enter number of speakers" required>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.time',[],$lang)}} : <span
                                    class="tx-danger">*</span></label>
                            <div class="d-flex">
                                <input class="form-control" type="number" name="time"
                                       placeholder="Time" required>
                                <select name="time_type" id="" class="form-control select2">
                                    @foreach(config('general.time_types') as $time_type)
                                        <option value="{{$time_type}}">{{$time_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.budget',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="budget" placeholder="Enter budget"
                                   required>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label class="form-control-label">{{trans('vars.deadline',[],$lang)}}: <span
                                class="tx-danger">*</span></label>
                        <div class="mg-b-30">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control fc-datepicker date-pick" name="apply_deadline"
                                       placeholder="MM/DD/YYYY" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label">Upload files: <span
                                class="tx-danger">*</span></label>
                        <div class="mg-b-30">
                            <div class="input-group">
                                <label class="ckbox">
                                    <input type="checkbox" name="uploadAction" checked=""><span>Turn on</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <label class="form-control-label">{{trans('vars.rules',[],$lang)}}: <span
                                class="tx-danger">*</span></label>
                        <input type="hidden" name="rules" id="rules">
                        <div id="summernote"></div>
                    </div>

                </div><!-- row -->

                <div class="form-layout-footer">
                    <button class="btn btn-primary bd-0"
                            type="submit">{{trans('vars.create_project',[],$lang)}}</button>
                    <a href="{{url('/manager')}}" class="btn btn-secondary bd-0">{{trans('vars.cancel',[],$lang)}}</a>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </form>
    </div><!-- section-wrapper -->
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

        $(document).on('keyup', '.note-editable', function () {
            $('#rules').attr('value', $('#summernote').summernote('code'));
        })

    </script>

    <script>
        $(function () {
            'use strict';

            // Summernote editor
            $('#summernote').summernote({
                height: 150,
                tooltip: false
            })


            // Select2 by showing the search
            $('.select2').select2({
                minimumResultsForSearch: ''
            });

        });
    </script>

@endpush
