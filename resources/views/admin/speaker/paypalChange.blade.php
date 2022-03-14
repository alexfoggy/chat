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

    <form class="section-wrapper" action="{{url('cabinet',['setting','paypalChangeEmailSave'])}}" method="POST">
        @csrf
        <label class="section-title">Here you can change your paypal email</label>
        <p class="mg-b-20 mg-sm-b-20">pay attention.</p>
        <span class="tx-thin tx-12">Currient email:{{\Illuminate\Support\Facades\Auth::user()->email ?? ''}}</span>
        <div class="row">
            <div class="col-12">
                <input class="form-control" name="email_paypal" placeholder="Email" type="text">
            </div><!-- col -->
            <div class="col-12 mt-3">
                <input class="form-control" name="email_paypal_confirmation" placeholder="Email confirmation" type="text">
            </div><!-- col -->
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-info">Submit changes</button>
            </div>

        </div><!-- row -->

    </form>

@endsection
@push('scripts')
    {{--    <script src="{{asset('assets/js/jquery-toggles/js/toggles.min.js')}}"></script>--}}
@endpush
