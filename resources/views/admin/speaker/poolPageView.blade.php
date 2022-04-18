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
    <div class="uppquestions">
        <div class="section-wrapper">
            <label class="section-title">Pool</label>

            <div class="form-layout">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" value="{{$pool->title}}" readonly>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Theme: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" value="{{$pool->theme}}" readonly>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
            </div><!-- form-layout -->
        </div>
        @if($ques)
            @foreach($ques as $one_que)
                <div class="section-wrapper mg-t-20">
                    <label class="section-title">Question {{$loop->iteration}}</label>
                    <div class="form-layout">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control rounded-5" type="text"
                                           placeholder="{{$one_que->title}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1 questions">
                            <div class="col-lg-12 mb-2 section-title mb-4 d-flex align-items-center">
                                <span>Options</span>
                            </div>
                            @foreach($one_que->checkbox as $one_check)
                                <div class="col-lg-3 d-flex align-items-center mb-4">
                                    <input class="form-control rounded-5" type="text" value="{{$one_check->title}}" readonly>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    {{--    <div class="d-flex justify-content-between">--}}
    {{--        <a href="#" class="btn btn-success rounded-5 btn-uppercase mt-4" onclick="newQuestion(event)">New question</a>--}}
    {{--        <button class="btn btn-warning rounded-5 btn-uppercase mt-4" form="saveform" type="submit">Save pool</button>--}}
    {{--    </div>--}}

@endsection
@push('scripts')


@endpush
