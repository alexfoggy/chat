@extends('layouts.admin')
@push('title')
    {{trans('vars.task',[],$lang)}}: {{$task->title ?? ''}}
@endpush
@push('styles')
    {{--    <link href="{{asset('admin/css/AVRecord/AVRecord.css')}}" rel="stylesheet">--}}
@endpush

@section('content')

    <div class="card card-people-list mg-t-20">
        <div class="slim-card-title">Speakers</div>
        <div class="media-list">
            @if($users)
                @foreach($users as $one_user)
            <div class="media">
                <img src="@if($one_user->avatar){{asset('storage/'.$one_user->avatar)}}@else {{asset('images/no-person.svg')}} @endif" alt="">
                <div class="media-body">
                    <a href="{{url(request()->segment(1),'userinfo').'/'.$one_user->id}}">{{$one_user->first_user}} {{$one_user->last_name}}</a>
                    <p>Language: {{$one_user->mainUserLanguage->name ?? ''}}</p>
                </div><!-- media-body -->
            </div><!-- media -->
                @endforeach
            @endif
        </div><!-- media-list -->
    </div>

@endsection

