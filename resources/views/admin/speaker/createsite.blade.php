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

    <div class="container">
        <form action="{{url('cabinet','createNewConnection')}}" method="POST">
            @csrf

            <div class="section-wrapper">
                <label class="section-title">Add new site</label>
                <p class="mg-b-20 mg-sm-b-40">Fill it.</p>

                <div class="row">
                    <div class="col-lg-12 my-2">
                        <input class="form-control" name="site_user_name" placeholder="Representor name" type="text">
                    </div><!-- col -->
                    <div class="col-lg-12 my-2">
                        <input class="form-control" name="site_user_role" placeholder="Representor role" type="text">
                    </div><!-- col -->
                    <div class="col-lg-12 my-2">
                        <input class="form-control" name="site_route" placeholder="Domain name" type="text">
                    </div><!-- col -->
                    <div class="col-lg-12 mt-2">
                        <button class="btn btn-dark w-100">Create</button>
                    </div>
                </div><!-- row -->

            </div>
        </form>
    </div>



@endsection
@push('scripts')

@endpush
