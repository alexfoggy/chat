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

    <div class="section-wrapper">
        <label class="section-title">New pool</label>

        <form action="{{url('cabinet','createpool')}}" method="POST" class="form-layout">
            @csrf
            <div class="row mg-b-25">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="title" value="" placeholder="Title...." required>
                    </div>
                </div><!-- col-4 -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label">Theme: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="theme" value="" placeholder="Theme...." required>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->

            <div class="form-layout-footer">
                <button class="btn btn-primary bd-0 rounded-5">Create</button>
            </div><!-- form-layout-footer -->
        </form><!-- form-layout -->
    </div>



@endsection
@push('scripts')

@endpush
