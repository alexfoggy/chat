@extends('layouts.admin')
@push('title')
    {{trans('vars.tasks',[],$lang)}}
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

   {{-- <div class="section-wrapper mg-t-20">
        <form class="invoice-notes" action="{{url('cabinet','createNewConnection')}}?id={{$domain->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="section-label tx-gray-500 mb-5">Chat settings</label>
            <div class="row">
                <div class="col-lg-3">
                    <span>Site domain</span>
                    <input class="form-control" name="site_route" placeholder="Domain name" value="{{$domain->site_route}}" type="text">
                </div>
                <div class="col-lg-3">
                    <span>Representor name</span>
                    <input class="form-control" name="site_user_name" placeholder="Representor name" value='{{$domain->site_user_name}}' type="text">
                </div>
                <div class="col-lg-3">
                    <span>Representor role</span>
                    <input class="form-control" name="site_user_role" placeholder="Represontor role" value="{{$domain->site_user_role}}" type="text">
                </div>
                <div class="col-lg-12 mb-4 mt-4">
                    <img src="@if($domain->site_image){{asset('storage/'.$domain->site_image)}}@endif" alt="">
                    <label class="form-control-label d-block mt-2">{{trans('vars.photo',[],$lang)}}: </label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept="image/*" name="avatar" id="customFile">
                        <label class="custom-file-label"
                               for="customFile">{{trans('vars.choose_avatar',[],$lang)}}</label>
                    </div>
                </div>
               --}}{{-- <div class="col-lg-3">
                    <span>Representor name</span>
                    <input class="form-control" name="site_route" placeholder="Domain name" type="text">
                </div>--}}{{--
                <div class="col-lg-12 mt-4">
                    <button class="btn btn-primary w-100">Save changes</button>
                </div>
            </div>

        </form>
    </div>--}}


    <div class="section-wrapper mg-t-20">
        <div class="invoice-notes">
            <label class="section-label tx-gray-500 mb-5">Start working</label>
            <p class="mb-1">Link this between &lt;head&gt; &lt;/head&gt; tags</p>
            <code class="bg-gray-100 p-2 rounded-5 d-block">
            &lt;link rel="stylesheet" href="https://yolly.pro/build/css/main.css"&gt;
            </code>

            <p class="mb-1 mt-3">Link it before &lt;/body&gt; tag</p>
            <code class="bg-gray-100 p-2 rounded-5 d-block">
                &lt;script src="https://yolly.pro/build/js/main.js"&gt;&lt;/script&gt;
            </code>

            <code class="bg-gray-100 p-2 rounded-5 d-block">

                &lt;script&gt;
                <pre class="tx-danger">
                $(window).yollyform({
                    site_key: "{{$domain->site_key}}",
                    form_key: "form key",
                    append:'#block', // div where appear form
                    type:'static', // type or static or popup
                });</pre>
                &lt;/script&gt;
            </code>
        </div>
    </div>
    @if (\Session::has('error_domain'))
        <div class="alert mt-4 alert-{{\Session::get('error_domain')['type']}}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {!! \Session::get('error_domain')['msg'] !!}
        </div>
    @endif
    <div class="section-wrapper mg-t-20 border-danger" id="deleteDomain">
        <form class="invoice-notes" action="{{url('cabinet','deletedomain')}}?id={{$domain->id}}" method="POST">
            @csrf
            <label class="section-label tx-gray-500 mb-5">Delete account</label>
            <div class="row">
                <div class="col-lg-12">
                    <span class="tx-16">Site domain name: <span class="tx-bold tx-warning">{{$domain->site_route}}</span></span>
                </div>
                <div class="col-lg-12 mt-1">
                    <p>When you delete domain all chats will be deleted too</p>
                    <span>Please repeat domain name to delete Domain</span>
                    <input class="form-control" name="site_route" type="text" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <button class="btn btn-danger">Delete Domain</button>
                </div>
            </div>

        </form>
    </div>


@endsection
@push('scripts')

@endpush
