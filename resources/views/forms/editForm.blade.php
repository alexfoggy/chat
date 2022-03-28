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
    <form action="{{url('cabinet',['createandsave']).'?id='.$form->site_id.'&form_id='.$form->id.'&formkey='.$form->formkey}}" class="section-wrapper" method="POST">
        @csrf
        <label class="section-title">Edit form</label>
        <p class="mg-b-20 mg-sm-b-40"></p>

        <div class="row">
            <div class="col-lg-6">
                <input class="form-control" placeholder="Form head" type="text" value="{{$form->head ?? ''}}" name="head">
            </div><!-- col -->
            <div class="col-lg-6">
                <select name="type" id="" class="select2 w-100 select-action" data-select="popup" data-appear="popupHead">
                    <option>No selected</option>
                    <option value="popup" @if($form->type == 'popup') selected @endif>Popup</option>
                    <option value="static" @if($form->type == 'static') selected @endif>Static</option>
                </select>
                <input type="text" name="popup-head" class="form-control mt-2 popupHead" placeholder="{{$form->popup_head}}">
            </div><!-- col -->

        </div><!-- row -->

        <label class="section-title">Fields</label>

        <div class="row appendPR">
            @foreach($inputs as $one_inp)
                <div class="col-lg-12 mb-3 d-flex align-items-center">
                    <span class="px-2 py-1 bg-indigo h-100 d-flex align-items-center tx-white"><i class="icon ion-arrow-move"></i></span>
                    <input class="form-control" placeholder="Placehoder" value="{{$one_inp->placeholder}}"type="text" name="pr[{{$one_inp->id}}]">
                    <select name="valid[{{$one_inp->id}}]" id="" class="select2 w-25">
                        <option value="text" @if($one_inp->valid == 'text') selected @endif>Text</option>
                        <option value="number" @if($one_inp->valid == 'number') selected @endif>Number</option>
                        <option value="email" @if($one_inp->valid == 'email') selected @endif>Email</option>
                    </select>
                    <select name="pq[{{$one_inp->id}}]" id="" class="select2 w-100" >
                        <option value="req" @if($one_inp->type == 'req') checked @endif>Required</option>
                        <option value="miss" @if($one_inp->type == 'miss') checked @endif>Not required</option>
                    </select>
                    <span class="btn-danger ml-4 px-2 py-1 rounded delete-field" data-id="{{$one_inp->id}}"><i class="fa fa-close"></i></span>
                </div><!-- col -->
            @endforeach

        </div><!-- row -->
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary rounded">Save</button>
                <span type="submit" class="btn btn-indigo rounded newRow"><i class="fa fa-plus mr-1"></i> Add row</span>
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
