@extends('layouts.admin')
@push('title')
    {{trans('vars.my_profile',[],$lang)}}
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

    <div class="container">
        <div class="card card-dash-one mg-t-20">
            <div class="row no-gutters">
                <div class="col-lg-3">
                    <i class="icon ion-ios-analytics-outline"></i>
                    <div class="dash-content">
                        <label class="tx-primary">Last month unique visitors</label>
                        <h2>{{$lastMonth->where('created_at','>',\Carbon\Carbon::now()->subDays(30)->toDateTimeString())->count()}}</h2>
                    </div><!-- dash-content -->
                </div><!-- col-3 -->
                <div class="col-lg-3">
                    <i class="icon ion-ios-pie-outline"></i>
                    <div class="dash-content">
                        <label class="tx-success">Total visitors</label>
                        <h2>{{$lastMonth->count()}}</h2>
                    </div><!-- dash-content -->
                </div><!-- col-3 -->
                <div class="col-lg-3">
                    <i class="icon ion-ios-stopwatch-outline"></i>
                    <div class="dash-content">
                        <label class="tx-purple">Commision</label>
                        <h2>781,524</h2>
                    </div><!-- dash-content -->
                </div><!-- col-3 -->
                <div class="col-lg-3">
                    <i class="icon ion-ios-world-outline"></i>
                    <div class="dash-content">
                        <label class="tx-danger">Earnings</label>
                        <h2>369,657</h2>
                    </div><!-- dash-content -->
                </div><!-- col-3 -->
            </div><!-- row -->
        </div><!-- card -->



    </div>

@endsection
@push('scripts')

@endpush
