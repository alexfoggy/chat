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
        <div class="d-flex justify-content-between align-items-center">
            <label class="section-title">Your Forms</label>
            <a href="{{url('cabinet',['createform',request()->segment(3)])}}" class="btn-indigo tx-12 rounded tx-white px-2 py-1"><i class="icon ion-plus-circled mr-1"></i> Create form</a>
        </div>
        <div class="row">
            @if($forms->isNotEmpty())
                @foreach($forms as $one_form)
                    <div class="col-2">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <h5 class="card-title tx-dark tx-medium my-0">{{$one_form->head ?? 'Your form'}}</h5>
                                <a href="{{url('cabinet',['formpage',$one_form->id])}}" class="btn btn-indigo rounded">check
                                    form</a>
                            </div>
                        </div><!-- card -->
                    </div><!-- col -->
                @endforeach
            @else
                <p class="col-lg-12">You have no forms</p>
            @endif

        </div><!-- row -->
    </div>
@endsection
@push('scripts')

@endpush
