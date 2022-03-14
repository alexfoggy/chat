@extends('layouts.admin')
@push('title')
    {{trans('vars.task',[],$lang)}}: {{$task->title ?? ''}}
@endpush
@push('styles')
    {{--    <link href="{{asset('admin/css/AVRecord/AVRecord.css')}}" rel="stylesheet">--}}
@endpush

@section('content')

    <div class="section-wrapper mg-t-20">
        <label class="section-title">Translates</label>

        <div class="row">
            <div class="col-md mg-t-20 mg-md-t-0">
                <div class="card bd-0">
                    <div class="card-header bg-dark">
                        <ul class="nav nav-tabs nav-tabs-for-dark card-header-tabs">
                            @foreach(config('general.languages') as $key => $value)
                                {{--                            <div class="col-lg-3 mt-2">
                                                                <a href="javascript:;" style="text-transform: uppercase"
                                                                   class="tx-12 tx-black tx-bold lang-change" data-lang="{{$key}}">{{$value}}</a>
                                                            </div>--}}
                                <li class="nav-item">
                                    <a class="nav-link bd-0 pd-y-8 @if($key == request()->input('lang')) active @endif" href="{{url('admin','translates').'?lang='.$key}}">{{$value}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0">
                        <div class="tab-content">
                            <div class="tab-pane active" id="{{$value}}">
                                <form action="{{url('admin','langSaveTranslate').'?lang='.request()->input('lang')}}" method="POST">
                                    @csrf
                                @foreach($lang_trans as $key => $one_lang_row)
                                <div class="row mb-2">
                                    <div class="col-lg-2">
                                        <input class="form-control" value="{{$key}}" readonly="" type="text">
                                    </div><!-- col -->
                                    <div class="col-lg mg-t-10 mg-lg-t-0">
                                        <input class="form-control" name="trans[{{$key}}]" placeholder="{{$one_lang_row}} (english version)" value="{{$curr_lang[$key] ?? ''}}" type="text">
                                    </div><!-- col -->
                                </div>
                                @endforeach
                                    <button class="btn btn-info w-100">
                                        Save
                                    </button>
                                </form>
                            </div><!-- tab-pane -->
                        </div><!-- tab-content -->
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->
        </div><!-- row -->
    </div>

@endsection

