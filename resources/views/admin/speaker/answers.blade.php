@extends('layouts.admin')
@push('title')
    Anwsers
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
        <label class="section-title">Anwsers</label>

        <div class="row">
            @if($pool_ans_id)
                @foreach($pool_ans_id as $one_ans_id)
                    <div class="col-md-6 col-lg-4">
                        <p class="mt-2 mb-0">#{{$loop->iteration}}</p>
                        <ul class="list-group">
                            @foreach($one_ans_id->children as $one_ans)
                            <li class="list-group-item">
                                <p class="mg-b-0 d-flex justify-content-between">
                                    <strong class="tx-inverse tx-medium">{{$one_ans->nameCheckbox->question->title}}</strong>
                                    <span class="text-muted">{{$one_ans->nameCheckbox->title}}</span></p>
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
