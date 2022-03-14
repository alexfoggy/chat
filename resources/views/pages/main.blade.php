@extends('layouts.no-header')
@section('content')
    <div class="container pt-5">
        <form class="row" action="{{url('createNewConnection')}}" method="POST">
            @csrf

            <div class="col-lg-4">
                <input type="text" name="site_user_name" placeholder="Representor name">
            </div>
            <div class="col-lg-4">
                <input type="text" name="site_user_role" placeholder="Representor role">
            </div>
            <div class="col-lg-4">
                <input type="text" name="site_route" placeholder="Domain name">
            </div>
            <div class="col-lg-4">
            <button>Create</button>
            </div>
        </form>
    </div>


@endsection
@push('scripts')

@endpush
