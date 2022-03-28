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
            @if($sites->isNotEmpty())
            <div class="table-responsive">
                <table class="table mg-b-0 tx-13">
                    <thead>
                    <tr class="tx-10">
                        <th class="pd-y-5">Domain</th>
                        <th class="pd-y-5">Site key</th>
                        <th class="pd-y-5 tx-center">Status</th>
                        <th class="pd-y-5 tx-center">Forms</th>
                        <th class="pd-y-5 tx-center"></th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($sites as $one_site)
                    <tr>
                        <td>
                            <a href="javascript:;" class="tx-inverse tx-14 tx-medium d-block">
                                {{$one_site->site_route}}
                            </a>
                        </td>
                        <td>d430350a-907f-4b8f-a61d-dc7ec6d7fe35</td>

                        <td class="tx-center"><span class="square-8 bg-success mg-r-5 rounded-circle"></span> </td>
                        <td class="tx-center">Forms count</td>
                        <td class="tx-center">
                            <a href="{{url('cabinet',['form',$one_site->id])}}" class="btn tx-12 py-1 btn-indigo rounded">Open forms</a>
                        </td>
                    </tr>
                        @endforeach

                    </tbody>
                </table>
            </div><!-- table-responsive -->
            @else
                <p class="col-lg-12 mt-2 mb-2">You have no websites added</p>
                <div class="col-lg-12 mb-2">
                    <a href="{{url('cabinet/newsite')}}" class="btn btn-primary">Add website</a>
                </div>
            @endif
        </div>
    </div>

@endsection
@push('scripts')

@endpush
