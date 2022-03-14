@extends('layouts.admin')

@push('title')
    {{trans('vars.user',[],$lang)}}
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

    <form class="section-wrapper" action="{{url('admin','generateNewProjectManager')}}" method="POST">
        @csrf
        <label class="section-title">Basic Form Input</label>
        <p class="mg-b-20 mg-sm-b-40">A basic form control with disabled and readonly mode.</p>

        <div class="row">
            <div class="col-lg">
                <input class="form-control" placeholder="First name" name="first_name" type="text" required>
            </div><!-- col -->
            <div class="col-lg">
                <input class="form-control" placeholder="Last name" name="last_name" type="text" required>
            </div><!-- col -->
            <div class="col-lg">
                <input class="form-control" placeholder="Email" name="email" type="text" required>
            </div><!-- col -->
            <div class="col-12 mt-4">
                <button class="btn btn-info"> Create new project manager</button>
            </div>

        </div><!-- row -->

    </form>

@endsection
@push('scripts')

@endpush
