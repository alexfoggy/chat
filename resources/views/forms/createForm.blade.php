@extends('layouts.admin')
@push('title')
    {{trans('vars.tasks',[],$lang)}}
@endpush

@push('styles')

    <link href="{{asset('assets/css/select2/css/select2.min.css')}}" rel="stylesheet">

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
    <form action="{{url('cabinet',['createandsave'])}}" class="section-wrapper">
        <label class="section-title">Create form</label>
        <p class="mg-b-20 mg-sm-b-40"></p>

        <div class="row">
            <div class="col-lg-6">
                <input class="form-control" placeholder="Form head" type="text" name="head">
            </div><!-- col -->
            <div class="col-lg-6">
                <select name="type" id="" class="select2 w-100">
                    <option value="popup">Popup</option>
                    <option value="static">Static</option>
                </select>
            </div><!-- col -->

        </div><!-- row -->

        <label class="section-title">Fields</label>

        <div class="row">
            <div class="col-lg-12 mb-3 d-flex align-items-center">
                <input class="form-control" placeholder="Placehoder" value="Your name" type="text" name="pr[0]">
                <span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span>
            </div><!-- col -->
            <div class="col-lg-12 mb-3 d-flex align-items-center">
                <input class="form-control" placeholder="Placehoder" value="Your email" type="text" name="pr[-1]">
                <span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span>
            </div><!-- col -->
            <div class="col-lg-12 mb-3 d-flex align-items-center">
                <input class="form-control" placeholder="Placehoder" value="Your Phone" type="text" name="pr[-2]">
                <span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span>
            </div><!-- col -->
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary rounded">Create and save</button>
            </div>
        </div><!-- row -->

    </form>


@endsection
@push('scripts')
    <script src="{{asset('assets/js/select2/js/select2.full.min.js')}}"></script>

    <script>
        $('.select2').select2({
            minimumResultsForSearch: ''
        });
    </script>
@endpush
