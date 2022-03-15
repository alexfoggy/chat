@extends('layouts.admin')
@push('title')
    {{trans('vars.tasks',[],$lang)}}
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

    <div class="section-wrapper mg-t-20">
        <div class="card card-table">
            <div class="card-header">
                <h6 class="slim-card-title">Your domains</h6>
            </div><!-- card-header -->
            <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                    <thead>
                    <tr class="tx-10">
                        <th class="pd-y-5">Domain</th>
                        <th class="pd-y-5">Representor name</th>
                        <th class="pd-y-5">Representor role</th>
                        <th class="pd-y-5">Site key</th>
                        <th class="pd-y-5">Added at</th>
                        <th class="pd-y-5 tx-center">Status</th>
                        <th class="pd-y-5 tx-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($domains as $one_domain)
                    <tr>
                        <td>
                            <a href="{{url('cabinet',['domain',$one_domain->id])}}" class="tx-inverse tx-14 tx-medium d-block">
                                @if($one_domain->test_status == 0)
                                {{$one_domain->site_route}}
                                @else
                                Test key
                                @endif
                            </a>
                        </td>
                        <td class="tx-12">
                            @if($one_domain->test_status == 0)
                         {{$one_domain->site_user_name}}
                                @endif
                        </td>
                        <td>
                            @if($one_domain->test_status == 0)
                                {{$one_domain->site_user_role}}
                                @endif
                        </td>
                        <td>{{$one_domain->site_key}}</td>
                        <td>{{\Carbon\Carbon::parse($one_domain->created_at)->format('d.m.y')}}</td>
                        <td class="tx-center"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>


@endsection
@push('scripts')

@endpush
