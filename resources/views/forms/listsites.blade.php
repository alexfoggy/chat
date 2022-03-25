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
    <div class="section-wrapper mg-t-20">
        <label class="section-title">Your Websites</label>
        <div class="row">
            @if($sites->isNotEmpty())
            @foreach($sites as $one_site)
            <div class="col-2">
                <div class="card rounded">
                    <div class="card-body py-3 d-flex align-items-center justify-content-between">
                        <h5 class="card-title tx-dark tx-medium my-0">{{$one_site->site_route}}</h5>
                        <a href="{{url('cabinet',['form',$one_site->id])}}" class="btn btn-indigo rounded">Forms</a>
                    </div>
                </div><!-- card -->
            </div><!-- col -->
                @endforeach
                @else
                <p class="col-lg-12">You have no websites added</p>
                <div class="col-lg-12">
                    <a href="{{url('cabinet/newsite')}}" class="btn btn-primary">Add website</a>
                </div>
            @endif

        </div><!-- row -->
    </div>
@endsection
@push('scripts')

@endpush
