@extends('layouts.admin')
@push('title')
    {{trans('vars.task',[],$lang)}}: {{$task->title ?? ''}}
@endpush
@push('styles')
    {{--    <link href="{{asset('admin/css/AVRecord/AVRecord.css')}}" rel="stylesheet">--}}
@endpush

@section('content')

    <div class="card card-people-list mg-t-20">
        <div class="slim-card-title">Project managers</div>

        <div class="table-responsive mt-4">
            <table class="table mg-b-0 tx-13">
                <thead>
                <tr class="tx-10">
                    <th class="wd-10p pd-y-5">&nbsp;</th>
                    <th class="pd-y-5">Name</th>
                    <th class="pd-y-5">Current projects</th>
                    {{--<th class="pd-y-5">Gain</th>--}}
                    <th class="pd-y-5">Join date</th>
                    <th class="pd-y-5 tx-center">Status</th>
                </tr>
                </thead>
                <tbody>
                @if($users)
                    @foreach($users as $one_user)
                        <tr>
                            <td class="pd-l-20">
                                <img
                                    src="@if($one_user->avatar){{asset('storage/'.$one_user->avatar)}}@else {{asset('images/no-person.svg')}} @endif"
                                    class="wd-55" alt="Image">
                            </td>
                            <td>
                                <a href=""
                                   class="tx-inverse tx-14 tx-medium d-block">{{$one_user->first_name}} {{$one_user->last_name}}</a>
                                <span
                                    class="tx-11 d-block tx-gray-500">{{\Carbon\Carbon::parse($one_user->created_at)->format('d.m.y')}}</span>
                            </td>
                            <td class="valign-middle">{{$one_user->Projects->count()}}</td>
                            {{--          <td class="valign-middle"><span class="tx-success"><i
                                                  class="icon ion-android-arrow-up mg-r-5"></i>33.34%</span> last week
                                      </td>--}}
                            <td class="valign-middle">
                                <span>{{\Carbon\Carbon::parse($one_user->created_at)->format('d.m.y')}}</span>
                            </td>
                            <td class="valign-middle tx-center">
                                <span class="square-8 bg-@if($one_user->status == '1')success @else danger @endif  mg-r-5 rounded-circle"></span>
                            </td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
        </div>

    </div>

@endsection

