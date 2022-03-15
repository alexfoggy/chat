@extends('layouts.admin')
@push('title')
    {{trans('vars.my_profile',[],$lang)}}
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


@endsection
@push('scripts')

@endpush
