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

    <div class="container container-messages with-sidebar">
        <div class="messages-left">
            <div class="slim-pageheader">
                <h6 class="slim-pagetitle">Messages</h6>
                {{--                <a href="" class="messages-compose"><i class="icon ion-compose"></i></a>--}}
            </div><!-- slim-pageheader -->

            <div class="messages-list ps ps--theme_default" data-ps-id="11b19783-0a1b-83d3-55bc-24eb08a97d59">
                @foreach($chats as $one_chat)
                    <a href="" class="media">
                        <div class="media-left">
                            <img src="http://via.placeholder.com/500x500" alt="">
                            <span class="square-10 bg-success"></span>
                        </div><!-- media-left -->
                        <div class="media-body">
                            <div>
                                <h6>@if($one_chat->last()->userStatus == 1) User @else You @endif</h6>
                                <p>{{$one_chat->last()->msg}}</p>
                            </div>
                            <div>
                                <span>{{\Carbon\Carbon::parse($one_chat->last()->created_at)->format('h:m (d.m.y)')}}</span>
                            </div>
                        </div><!-- media-body -->
                    </a><!-- media -->
                @endforeach

                <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                    <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;">
                    <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div><!-- messages-list -->

            {{--<div class="messages-left-footer">
                <button class="btn btn-slim btn-uppercase-sm btn-block">Load Older Messages</button>
            </div><!-- messages-left-footer -->--}}
        </div><!-- messages-left -->

        <div class="messages-right">
            <div class="message-header">
                <a href="" class="message-back"><i class="fa fa-angle-left"></i></a>
                <div class="media">
                    <img src="http://via.placeholder.com/500x500" alt="">
                    <div class="media-body">
                        <h6>Joyce Chua</h6>
                    </div><!-- media-body -->
                </div><!-- media -->

            </div><!-- message-header -->
            <div class="message-body ps ps--theme_default" data-ps-id="a1f20a6d-8b9b-ff34-1a88-f7aff7e87af3">
                <div class="media-list">
                    @foreach($chats[1] as $one_msg)
                        @if($one_msg->userStatus == 2)

                            @include('messages.adminRight')

                        @else

                            @include('messages.adminLeft')

                        @endif
                    @endforeach


                </div><!-- media-list -->
                <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                    <div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;">
                    <div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div><!-- message-body -->
            <div class="message-footer">
                <div class="row row-sm">
                    <div class="col-9 col-sm-8 col-xl-9">
                        <input type="text" class="form-control" placeholder="Type something here...">
                    </div><!-- col-8 -->
                    <div class="col-3 col-sm-4 col-xl-3 tx-right">
                        <button class="btn-primary btn">Send</button>
                        <div class="d-sm-none">
                            <a href=""><i class="icon ion-more"></i></a>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
            </div><!-- message-footer -->
        </div><!-- messages-right -->
        <div></div>
    </div>

@endsection
@push('scripts')

@endpush
