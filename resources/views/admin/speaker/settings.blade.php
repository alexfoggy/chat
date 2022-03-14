@extends('layouts.admin')
@push('title')
    {{trans('vars.settings',[],$lang)}}
@endpush
@push('styles')
    {{--        <link href="{{asset('assets/css/jquery-toggles/css/toggles-full.css')}}" rel="stylesheet">--}}
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

    <div class="section-wrapper mg-t-20">
        <label class="section-title">{{trans('vars.settings',[],$lang)}}
        </label>
        <p class="mg-b-20 mg-sm-b-40">{{trans('vars.currient_tasks',[],$lang)}}Changes.</p>

        <div id="accordion2" class="accordion-one accordion-one-primary" role="tablist" aria-multiselectable="true">
            <div class="card">
                <div class="card-header" role="tab" id="headingOne2">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2" aria-expanded="false"
                       aria-controls="collapseOne2" class="tx-gray-800 transition collapsed">
                        {{trans('vars.change_pass',[],$lang)}}
                    </a>
                </div><!-- card-header -->

                <div id="collapseOne2" class="collapse" role="tabpanel" aria-labelledby="headingOne2" style="">
                    <div class="card-body">
                        <form action="{{url(request()->segment(1),['setting','changepassword'])}}" method="POST">
                            @csrf
                            <h5 class="tx-thin">{{trans('vars.here_you_can_change_pass',[],$lang)}}</h5>
                            <div class="form-group">
                                <label class="form-control-label">{{trans('vars.old_pass',[],$lang)}}: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="old_pass"
                                       placeholder="Enter {{trans('vars.old_pass',[],$lang)}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{trans('vars.new_pass',[],$lang)}}: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="new_pass"
                                       placeholder="Enter {{trans('vars.new_pass',[],$lang)}}" required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">{{trans('vars.new_pass_conf',[],$lang)}}: <span
                                        class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="new_pass_confirmation"
                                       placeholder="Enter {{trans('vars.new_pass_conf',[],$lang)}}" required>
                            </div>
                            <button type="submit"
                                    class="btn btn-success px-3">{{trans('vars.save_new_pass',[],$lang)}}</button>
                        </form>
                    </div>
                </div>
            </div>
            @if(Auth::user()->type[0]->title == 'speaker')
            <div class="card">
                <div class="card-header" role="tab" id="headingOne2">
                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne3" aria-expanded="false"
                       aria-controls="collapseOne2" class="tx-gray-800 transition collapsed">
                        {{--{{trans('vars.change_pass',[],$lang)}}--}}
                        Paypal settings
                    </a>
                </div><!-- card-header -->

                <div id="collapseOne3" class="collapse" role="tabpanel" aria-labelledby="headingOne3" style="">
                    <div class="card-body">
                        <form action="{{url(request()->segment(1),['setting','paypalChangeEmail'])}}" method="POST">
                            @csrf
                            <h5 class="tx-thin">If you want to change your paypal email or set it, you have to ask
                                'paypal change email'</h5>
                            <h5 class="tx-thin">After you press 'paypal change email' you will get mail on your email,
                                you have to follow link and then you can change it</h5>
                            <h6 class="tx-thin tx-14 mt-4 mb-4"><span class="tx-warning">*</span>It's made for you
                                secure and it helps you keep save your money</h6>

                            <button type="submit"
                                    class="btn btn-info tx-uppercase tx-bold tx-12 px-3">paypal change email
                            </button>
                        </form>
                    </div>
                </div>
            </div>
                @endif
        </div>

    </div>

@endsection
@push('scripts')
    {{--    <script src="{{asset('assets/js/jquery-toggles/js/toggles.min.js')}}"></script>--}}
@endpush
