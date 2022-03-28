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
        <label class="section-title">Feedback</label>
        <p class="mg-b-20 mg-sm-b-40">Your messages from website</p>

        <div class="row">
            @if($feedbackList)
                @foreach($feedbackList as $one_message)
            <div class="col-md-6 col-lg-4 mt-4">
                <ul class="list-group">
                    @foreach($one_message->children as $one_inp)
                    <li class="list-group-item">
                        <p class="mg-b-0 d-flex align-items-center justify-content-between">
                            <strong class="tx-inverse tx-medium">@if($one_inp->input){{$one_inp->input->placeholder}}@endif:</strong>
                            <span class="text-muted">{{$one_inp->msg_value}}</span></p>
                    </li>
                    @endforeach

                </ul>
            </div><!-- col-4 -->
                @endforeach
                @endif
        </div><!-- row -->
    </div>


@endsection
@push('scripts')

@endpush
