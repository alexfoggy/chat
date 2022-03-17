@extends('layouts.no-header')
@section('content')

    <div class="modal-backdrop bg-gray-900 w-100 d-flex justify-content-center align-items-center flex-column">
        <img src="{{asset('yolly.svg')}}" alt="" class="w-25">
        <div class="mt-5">
        <a href="{{url('login')}}" class="btn btn-primary tx-bold mr-1 rounded-5">Login</a>
        <a href="{{url('register')}}" class="btn bg-white tx-black ml-1 rounded-5">Register</a>
        </div>
    </div>


@endsection
@push('scripts')

@endpush
