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
    <div class="section-wrapper">
        <label class="section-title d-flex justify-content-between align-items-center">
            <span>Form information</span>
            <div class="">
            <a href="{{url('cabinet',['editform',$form->id])}}" class="btn btn-indigo tx-12 px-2 py-1 tx-transform-none rounded">Edit</a>
            <span class="btn btn-danger tx-12 px-2 py-1 tx-transform-none rounded delete-it">Delete</span>
            </div>
        </label>
        <p class="mg-b-20 mg-sm-b-40"></p>

        <div class="row">
            <div class="col-lg-6">
                <input class="form-control" placeholder="Form head" type="text" value="{{$form->head ?? ''}}" name="head" readonly>
            </div><!-- col -->
            <div class="col-lg-6">
                <select name="type" id="" class="select2 w-100" disabled>
                    <option value="popup" @if($form->type == 'popup') checked @endif>Popup</option>
                    <option value="static" @if($form->type == 'static') checked @endif>Static</option>
                </select>
            </div><!-- col -->

        </div><!-- row -->

        <label class="section-title">Fields</label>

        <div class="row appendPR">
            @foreach($inputs as $one_inp)
            <div class="col-lg-12 mb-3 d-flex align-items-center">
                <input class="form-control" placeholder="Placehoder" value="{{$one_inp->placeholder}}" readonly type="text" name="pr[{{$one_inp->id}}]">
                <select name="pq[{{$one_inp->id}}]" id="" class="select2 w-100" disabled>
                    <option value="req" @if($one_inp->type == 'req') checked @endif>Required</option>
                    <option value="miss" @if($one_inp->type == 'miss') checked @endif>Not required</option>
                </select>
                <span class="btn-danger ml-4 px-2 py-1 rounded delete-field d-none"><i class="fa fa-close"></i></span>
            </div><!-- col -->
            @endforeach

        </div><!-- row -->

    </div>


@endsection
@push('scripts')
    <script src="{{asset('assets/js/select2/js/select2.full.min.js')}}"></script>

    <script>
        $('.select2').select2({
            minimumResultsForSearch: ''
        });

        let i = -3;

        $('.newRow').on('click',function (){

            let row = ('<div class="col-lg-12 mb-3 d-flex align-items-center">'+
                '<input class="form-control" placeholder="Placehoder" value="Your Phone" type="text" name="pr['+i+']">'+
                '<select name="pq['+i+']" id="" class="select2 w-100"><option value="req">Required</option><option value="miss">Not required</option></select>'+
                '<span class="btn-danger ml-4 px-2 py-1 rounded delete-field"><i class="fa fa-close"></i></span></div>');

            $(".appendPR").append(row);

            $('.select2').select2({
                minimumResultsForSearch: ''
            });

            i--;

        })

        $(document).on('click','.delete-field',function (){

            if($('.appendPR .col-lg-12').length > 3) {
                $(this).closest('.col-lg-12').remove();
            }
            else
            {
                alertAppend('minimum 3 fields','danger');
            }
        })

        $(document).on('click','.delete-it',function (){

           let apr = confirm('Are you sure ?');

           if(apr == true){
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
               $.ajax({
                   type: 'POST',
                   url: '/cabinet/formdelete/{{$form->id}}',
                   success: function (response) {
                       if (response.status == true) {
                           location.reload();
                       } else {
                           alertAppend(response.msg, 'danger');
                       }
                   }
               });
           }

        })

    </script>
@endpush
