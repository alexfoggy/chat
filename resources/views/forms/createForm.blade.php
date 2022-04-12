@extends('layouts.admin')
@push('title')
    {{trans('vars.tasks',[],$lang)}}
@endpush

@push('styles')

    <link href="{{asset('assets/css/select2/css/select2.min.css')}}" rel="stylesheet">

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
    <form action="{{url('cabinet',['createandsave']).'?id='.request()->segment(3)}}" class="section-wrapper"
          method="POST">
        @csrf
        <label class="section-title">Create form</label>
        <p class="mg-b-20 mg-sm-b-40"></p>

        <div class="row">
            <div class="col-lg-6">
                <input class="form-control" placeholder="Form head" type="text" name="head">
            </div><!-- col -->
            <div class="col-lg-6">
                <select name="type" id="" class="select2 w-100 select-action" data-select="popup"
                        data-appear="popupHead">
                    <option value="">No selected</option>
                    <option value="popup">Popup</option>
                    <option value="static">Static</option>
                </select>
                <input type="text" name="popup-head" class="form-control mt-2 popupHead"
                       placeholder="Popup open button text">
            </div><!-- col -->

        </div><!-- row -->

        <label class="section-title">Fields</label>

        <div class="row appendPR">
            <div class="col-lg-12 mb-3 d-flex align-items-center">
                <span class="px-2 py-1 bg-indigo h-100 d-flex align-items-center tx-white"><i
                        class="icon ion-arrow-move"></i></span>
                <input class="form-control" placeholder="Placehoder" value="Your name" type="text" name="pr[0]">
                <select name="valid[0]" id="" class="select2 w-25">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="email">Email</option>
                </select>
                <select name="pq[0]" id="" class="select2 w-25">
                    <option value="req">Required</option>
                    <option value="miss">Not required</option>
                </select>
                <span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span>
            </div><!-- col -->
            <div class="col-lg-12 mb-3 d-flex align-items-center">
                <span class="px-2 py-1 bg-indigo h-100 d-flex align-items-center tx-white"><i
                        class="icon ion-arrow-move"></i></span>

                <input class="form-control" placeholder="Placehoder" value="Your email" type="text" name="pr[-1]">
                <select name="valid[-1]" id="" class="select2 w-25">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="email">Email</option>
                </select>
                <select name="pq[-1]" id="" class="select2 w-25">
                    <option value="req">Required</option>
                    <option value="miss">Not required</option>
                </select>
                <span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span>
            </div><!-- col -->
            <div class="col-lg-12 mb-3 d-flex align-items-center">
                <span class="px-2 py-1 bg-indigo h-100 d-flex align-items-center tx-white"><i
                        class="icon ion-arrow-move"></i></span>

                <input class="form-control" placeholder="Placehoder" value="Your Phone" type="text" name="pr[-2]">
                <select name="valid[-2]" id="" class="select2 w-25">
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="email">Email</option>
                </select>
                <select name="pq[-2]" id="" class="select2 w-25">
                    <option value="req">Required</option>
                    <option value="miss">Not required</option>
                </select>
                <span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span>
            </div><!-- col -->

        </div><!-- row -->
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary rounded">Create and save</button>
                <span type="submit" class="btn btn-indigo rounded newRow"><i class="fa fa-plus mr-1"></i> New row</span>
            </div>
        </div>

    </form>


@endsection
@push('scripts')
    <script src="{{asset('assets/js/select2/js/select2.full.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>


    <script>

        start();

    </script>
@endpush
