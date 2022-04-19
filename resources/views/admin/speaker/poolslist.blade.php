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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="slim-card-title">Pools</h6>
                <div class="">
                    <a href="{{url('cabinet/newpool')}}" class="btn btn-success tx-12 px-2 py-1 font-weight-bold rounded">new pool</a>
                </div>
            </div><!-- card-header -->
            @if($pools->isNotEmpty())
            <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                    <thead>
                    <tr class="tx-10">
                        <th class="pd-y-5">Name</th>
                        <th class="pd-y-5">Theme</th>
                        <th class="pd-y-5">Added at</th>
                        <th class="pd-y-5 tx-center">Status</th>
                        <th class="pd-y-5"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pools as $one_pool)
                        <tr>
                            <td><a href="{{url('cabinet',['pool','view',$one_pool->key])}}">{{$one_pool->title}}</a></td>
                            <td>{{$one_pool->theme}}</td>
                            <td>{{\Carbon\Carbon::parse($one_pool->created_at)->format('d.m.y')}}</td>
                            <td class="tx-center"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> </td>
                            <td class="tx-right"><span class="btn btn-danger rounded-10 popup-action" data-action="pool/delete/{{$one_pool->id}}"><i class="fa fa-close"></i></span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-responsive -->
                @else
            <p class="px-4 pt-3">No pools created</p>
            @endif
        </div>
    </div>



@endsection
@push('scripts')

@endpush
