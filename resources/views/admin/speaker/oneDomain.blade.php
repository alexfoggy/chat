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
        <div class="invoice-notes">
            <label class="section-label tx-gray-500 mb-5">Start working</label>
            <p class="mb-1">Link this between &lt;head&gt; &lt;/head&gt; tags</p>
            <code class="bg-gray-100 p-2 rounded-5 d-block">
            &lt;link rel="stylesheet" href="https://yolly.pro/build/css/main.css"&gt;
            </code>

            <p class="mb-1 mt-3">Link it before &lt;/body&gt; tag</p>
            <code class="bg-gray-100 p-2 rounded-5 d-block">
                &lt;script src="https://yolly.pro/build/js/main.js" data-key="{{$domain->site_key}}" id="chatme" defer&gt;&lt;/script&gt;
            </code>
        </div>
    </div>


@endsection
@push('scripts')

@endpush
