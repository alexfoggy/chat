@extends('layouts.admin')
@push('title')
    {{trans('vars.edit_profile',[],$lang)}}
@endpush
@push('styles')
    {{--<link href="{{asset('admin/css/select2/css/select2.min.css')}}" rel="stylesheet">--}}
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
            <li class="breadcrumb-item active" aria-current="page">{{trans('vars.my_profile',[],$lang)}}</li>
        </ol>
        <h6 class="slim-pagetitle">{{trans('vars.edit_page',[],$lang)}}</h6>
    </div>
    <div class="section-wrapper">
        <form action="{{url('cabinet/edit')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-layout">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.firstname',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="first_name"
                                   value="{{$user->first_name ?? ''}}" placeholder="Enter firstname" required>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.lastname',[],$lang)}}: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="last_name" value="{{$user->last_name ?? ''}}"
                                   placeholder="Enter lastname" required>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label">{{trans('vars.email',[],$lang)}}:</label>
                            <input class="form-control" type="text" value="{{$user->email ?? ''}}"
                                   placeholder="Enter email address" readonly>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                        <label class="form-control-label">{{trans('vars.phone',[],$lang)}}: <span
                                class="tx-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-phone tx-16 lh-0 op-6"></i>
                                </div>
                            </div><!-- input-group-prepend -->
                            <input id="phoneMask" type="text" name="phone" class="form-control"
                                   value="{{$user->phone ?? ''}}" placeholder="(999) 999-9999" required>
                        </div><!-- input-group -->
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mg-b-10-force">
                            <label class="form-control-label">{{trans('vars.native_language',[],$lang)}}:<span
                                    class="tx-danger">*</span></label>
                            <select class="form-control select2" name="main_language"
                                    data-placeholder="Choose language" required>
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
                            <select class="form-control select2" name="country" data-placeholder="Choose country"
                                    required>
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
                    <div class="mg-t-10 col-lg-4">
                        <label class="form-control-label">{{trans('vars.gender',[],$lang)}} <span
                                class="tx-danger">*</span></label>

                        <div class="col-lg-12">
                            <label class="rdiobox">
                                <input name="gender" value="Male" type="radio"
                                       @if($user->gender == 'Male') checked @endif>
                                <span>{{trans('vars.male',[],$lang)}}</span>
                            </label>
                        </div><!-- col-3 -->
                        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox">
                                <input name="gender" type="radio" value="Female"
                                       @if($user->gender == 'Female') checked @endif>
                                <span>{{trans('vars.female',[],$lang)}}</span>
                            </label>
                        </div><!-- col-3 -->
                    </div>
                    <div class="mg-t-10 col-lg-4">


                        <label class="form-control-label">{{trans('vars.lang_lvl',[],$lang)}}<span
                                class="tx-danger">*</span></label>
                        @foreach(config('general.language.levels') as $key => $status)
                            <div class="col-lg-12">
                                <label class="rdiobox">
                                    <input name="main_language_level" value="{{$key}}" type="radio"
                                           @if($user->main_language_level == $key) checked @endif>
                                    <span>{{$status}}</span>
                                </label>
                            </div>
                        @endforeach


                    </div>
                    <div class="mg-t-10 col-lg-4">
                        <label class="form-control-label">{{trans('vars.curr_liv_in_country',[],$lang)}}<span
                                class="tx-danger">*</span></label>

                        <div class="col-lg-3">
                            <label class="rdiobox">
                                <input name="current_location_status" type="radio"
                                       @if($user->current_location_status == 1) checked @endif value="yes">
                                <span>{{trans('vars.yes',[],$lang)}}</span>
                            </label>
                        </div><!-- col-3 -->
                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox">
                                <input name="current_location_status" type="radio"
                                       @if($user->current_location_status == 0) checked @endif value="no">
                                <span>{{trans('vars.no',[],$lang)}}</span>
                            </label>
                        </div><!-- col-3 -->
                        <select class="form-control select2 mt-4 curr_live d-none" name="current_location"
                                data-placeholder="Choose country"
                                required>
                            <option label="Choose country"></option>
                            @if($countries)
                                @foreach($countries as $one_country)
                                    <option value="{{$one_country->id}}"
                                            @if($user->current_location == $one_country->id) selected @endif>{{$one_country->name ?? ''}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                   {{-- <div class="col-lg-6 mg-t-20 mg-lg-t-0 pt-2">
                        <label class="form-control-label">Paypal: --}}{{--<span class="tx-danger">*</span>--}}{{--</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{$user->paypal ?? ''}}"
                                   placeholder="paypal@paypal.com">
                        </div><!-- input-group -->
                    </div>--}}

                    <div class="col-lg-12 pt-2">
                        <label class="form-control-label">{{trans('vars.birthdate',[],$lang)}}: <span class="tx-danger">*</span></label>
                        <div class="wd-200 mg-b-30">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="icon ion-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control fc-datepicker date-pick" name="birth_date"
                                       value="{{$user->birth_date ?? ''}}" placeholder="MM/DD/YYYY" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <img src="@if($user->avatar){{asset('storage/'.$user->avatar)}}@endif" alt="">
                        <label class="form-control-label d-block mt-2">{{trans('vars.photo',[],$lang)}}: </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" accept="image/*" name="avatar" id="customFile">
                            <label class="custom-file-label"
                                   for="customFile">{{trans('vars.choose_avatar',[],$lang)}}</label>
                        </div>
                    </div>

                </div><!-- row -->
                <div class="row mg-b-25">
                    <div class="col-lg-12">
                        <label class="form-control-label">{{trans('vars.known_langs',[],$lang)}}: </label>

                        <div class="col-lg-12">
                            <label class="rdiobox">
                                <input name="dialects_status" type="radio" value="true"
                                       @if($user->dialect_status == 1) checked @endif>
                                <span>{{trans('vars.yes_i_know',[],$lang)}}</span>
                            </label>
                        </div><!-- col-3 -->
                        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                            <label class="rdiobox">
                                <input name="dialects_status" type="radio" value="false"
                                       @if($user->dialect_status == 0) checked @endif >
                                <span>{{trans('vars.no_dont_know',[],$lang)}}</span>
                            </label>
                        </div><!-- col-3 -->
                    </div>
                </div>


                <div class="append-if-has-dialect row d-none">
                    @if($dialects->isNotEmpty())
                        @foreach($dialects as $one_dialect)

                            <div class="mb-4 col-lg-4">
                                <div class="p-3 bd bd-1 bd-gray position-relative">
                                    <div class="form-group mg-b-10-force">
                                        <span class="btn btn-danger position-absolute right-top tx-10 delete-dialect"
                                              data-id="{{$one_dialect->id}}"><i class="icon ion-close"></i></span>
                                        <label class="form-control-label">{{trans('vars.lang',[],$lang)}}: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="dialect[{{$one_dialect->id}}]"
                                                data-placeholder="Choose language" required>
                                            <option label="Choose language"></option>
                                            @if($languages)
                                                @foreach($languages as $one_lang)
                                                    <option value="{{$one_lang->id}}"
                                                            @if($one_dialect->language_id == $one_lang->id) selected @endif>{{$one_lang->name ?? ''}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">{{trans('vars.lang_lvl',[],$lang)}}<span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="lang_level[{{$one_dialect->id}}]"
                                                data-placeholder="Choose language level" required>
                                            @foreach(config('general.language.levels') as $key => $status)
                                                <option value="{{$key}}"
                                                        @if($key == $one_dialect->level) selected @endif >{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <div class="mb-4 col-lg-4">
                            <div class="p-3 bd bd-1 bd-gray position-relative">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">{{trans('vars.lang',[],$lang)}}:<span
                                            class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="dialect[0]"
                                            data-placeholder="Choose language" required>
                                        <option label="Choose language"></option>
                                        @if($languages)
                                            @foreach($languages as $one_lang)
                                                <option value="{{$one_lang->id}}">{{$one_lang->name ?? ''}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">{{trans('vars.lang_lvl',[],$lang)}}<span
                                            class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="lang_level[0]"
                                            data-placeholder="Choose language level" required>
                                        @foreach(config('general.language.levels') as $key => $status)
                                            <option value="{{$key}}">{{$status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-12">
                        <span
                            class="btn btn-success add-on-more-lang">{{trans('vars.add_one_more_lang',[],$lang)}}</span>
                        <p class="font-weight-ligth tx-12 mt-1"><i
                                class="icon ion-information-circled"></i>{{trans('vars.min_one_lang',[],$lang)}}</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-layout-footer mt-3">
                <button class="btn btn-primary bd-0"
                        type="submit">{{trans('vars.save_edit',[],$lang)}}</button>
                <a href="{{url('/cabinet')}}" class="btn btn-secondary bd-0">{{trans('vars.cancel',[],$lang)}}</a>
            </div><!-- form-layout-footer -->
        </form>
    </div><!-- section-wrapper -->
@endsection
@push('scripts')
    {{--    <script src="{{asset('admin/js/jquery.maskedinput/js/jquery.maskedinput.js')}}" await></script>--}}
    <script src="{{asset('assets/js/moment/js/moment.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui/js/jquery-ui.js')}}"></script>

    <script>
        $('.date-pick').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "-100:+0",
        });

        //CHECK IF OTHER LANGUAGES (YES) IS CHECKED THEN WE OPEN BLOCK WITH LANGUAGES

        $(document).on('change', 'input[name="dialects_status"]', function () {
            if ($(this).val() === 'true') {
                $('.append-if-has-dialect').removeClass('d-none');
                $('.append-if-has-dialect input,.append-if-has-dialect select').attr('required', true);
            } else {
                $('.append-if-has-dialect').addClass('d-none');
                $('.append-if-has-dialect input,.append-if-has-dialect select').attr('required', false);
            }
        })

        //CHECK IF OTHER LANGUAGES (YES) IS CHECKED THEN WE OPEN BLOCK WITH LANGUAGES ( ON LOAD PAGE )

        $(document).ready(function () {
            if ($('input[name="dialects_status"]:checked').val() == 'true') {
                $('.append-if-has-dialect').removeClass('d-none');
                $('.append-if-has-dialect input,.append-if-has-dialect select').attr('required', true);
            } else {
                $('.append-if-has-dialect').addClass('d-none');
                $('.append-if-has-dialect input,.append-if-has-dialect select').attr('required', false);
            }
        })

    </script>


    <script>

        // add new language block

        let g = -1;

        $('.add-on-more-lang').on('click', function () {

            let formLang = '<div class="mb-4 col-lg-4">' +
                ' <div class="p-3 bd bd-1 bd-gray position-relative">' +
                ' <div class="form-group mg-b-10-force ">' +
                '<span class="btn btn-danger position-absolute right-top tx-10 delete-dialect"><i class="icon ion-close"></i> </span>' +
                ' <label class="form-control-label">Language: <span class="tx-danger">*</span></label>' +
                ' <select class="form-control select2" name="dialect[' + g + ']" data-placeholder="Choose language" required>' +
                ' <option label="Choose language"></option>' +
                @if($languages)
                    @foreach($languages as $one_lang)
                    '<option value="{{$one_lang->id}}"' +
                '> {{$one_lang->name ?? ''}} ' +
                '</option>' +
                @endforeach
                    @endif
                    ' </select></div>' +
                ' <div class="form-group mg-b-10-force">' +
                '<label class="form-control-label">Language level <span class="tx-danger">*</span></label>' +
                '<select class="form-control select2" name="lang_level[' + g + ']" data-placeholder="Choose language" required>' +
                @foreach(config('general.language.levels') as $key => $status)
                    ' <option value="{{$key}}">{{$status}}</option>' +
                @endforeach
                    '</select>' +
                ' </div>' +
                '</div>' +
                '</div>';

            g--;

            $('.append-if-has-dialect').prepend(formLang);

        });

        // DELETE DIALECT

        $(document).on('click', '.delete-dialect', function () {
            let id = $(this).data('id');

            if (id) {
                $.ajax({
                    url: "/api/deleteDialect",
                    type: "POST",
                    data: {id: id},
                });
            }

            $(this).closest('.mb-4.col-lg-4').remove();

        })

        $(document).on('change', 'input[name=current_location_status]', function () {
            let status = $(this).val();

            if (status == 'no') {
                $('.curr_live').removeClass('d-none');
                $('.curr_live').attr('required', true);

            } else {
                $('.curr_live').addClass('d-none');
                $('.curr_live').removeAttr('required');

            }

        })

        $(document).ready(function () {
            let status = $('input[name=current_location_status]:checked').val();
            if (status == 'no') {
                $('.curr_live').removeClass('d-none');
                $('.curr_live').attr('required', true);
            } else {
                $('.curr_live').addClass('d-none');
                $('.curr_live').removeAttr('required');
            }
        })


    </script>

@endpush
