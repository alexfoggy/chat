@extends('layouts.no-header')
@section('content')
    <div class="container pt-5">
        <div class="row">
            @foreach($users as $one_user)
                <div class="col-lg-12">
                    <a href="" class="p-2 m-1 rounded-10 border d-block tx-gray-800">{{$one_user->key}}</a>
                </div>
            @endforeach
        </div>
    </div>


@endsection
@push('scripts')

@endpush
