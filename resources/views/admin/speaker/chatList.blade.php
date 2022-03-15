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

            <div class="messages-list ps ps--theme_default rounded-10">
                @foreach($chats as $one_chat)
                    <a href="javascript:;" data-chat="{{$one_chat->last()->user_id}}" class="chatChange media @if($loop->first) active @endif">
                        <div class="media-left">
                            <img src="http://via.placeholder.com/500x500" alt="">
                            <span class="square-10 bg-success"></span>
                        </div><!-- media-left -->
                        <div class="media-body">
                            <div>
                                <h6>@if($one_chat->last()->userStatus == 1) User @else You @endif:{{$one_chat->last()->msg}}</h6>
                            </div>
                            <div>
                                <span>{{\Carbon\Carbon::parse($one_chat->last()->created_at)->format('h:m (d.m.y)')}}</span>
                            </div>
                        </div><!-- media-body -->
                    </a><!-- media -->
                @endforeach

            </div><!-- messages-list -->

            {{--<div class="messages-left-footer">
                <button class="btn btn-slim btn-uppercase-sm btn-block">Load Older Messages</button>
            </div><!-- messages-left-footer -->--}}
        </div><!-- messages-left -->

        <div class="messages-right rounded-10">
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
                <div class="media-list heightFixedChat">
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
                <form class="row row-sm">
                    <div class="col-11 col-sm-11 col-xl-11">
                        <input type="text" class="form-control" id="textChatAssist" placeholder="Type something here...">
                    </div><!-- col-8 -->
                    <div class="col-1 col-sm-1 col-xl-1 tx-right">
                        <button class="btn-primary btn d-block w-100 rounded-10" id="sendmsg" data-id="{{$one_msg->user_id}}" data-site-id="{{$one_msg->site_id}}">Send <i class="fa fa-send"></i></button>
                    </div><!-- col-4 -->
                </form><!-- row -->
            </div><!-- message-footer -->
        </div><!-- messages-right -->
        <div></div>
    </div>

@endsection
@push('scripts')
    <script>

        function gobot(){
            //scroll to bottom
            let d = $('.heightFixedChat');
            d.scrollTop(d.prop("scrollHeight"));
        }

        $(document).on('click', '#sendmsg', function (e) {

            e.preventDefault();
            let msg = $(document).find('#textChatAssist').val();
            if(msg != '') {
                $(document).find('#textChatAssist').val('');
                let url = "https://chat/api/sendmsgpanel";
                let userid = $(this).attr('data-id');
                let siteid = $(this).attr('data-site-id');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        'msg': msg,
                        'user_id': userid,
                        'site_id': siteid,
                    },
                    success: function (data) {
                        $('.media-list').append(data.userText);
                        gobot();
                    }
                });
            }
        });


        $(document).on('click', '.chatChange', function (e) {
            $('.media-list').fadeOut();
            e.preventDefault();
                $(document).find('#textChatAssist').val('');
                let url = "https://chat/api/changechat";
                let userid = $(this).attr('data-chat');
                let siteid = $('#sendmsg').attr('data-site-id');
                $('#sendmsg').attr('data-id',userid);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        'user_id': userid,
                        'site_id': siteid,
                    },
                    success: function (data) {
                        $('.media-list').html('');
                        $('.media-list').append(data.userText);
                        $('.media-list').fadeIn();
                        gobot();
                    }
                });
        });

        checkAns = setInterval(function () {
            let userid = $('#sendmsg').attr('data-id');
            let siteid = $('#sendmsg').attr('data-site-id');
            let url = "https://chat/api/checkResponsePanel";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'user_id': userid,
                    'site_id': siteid,
                },
                success: function (data) {
                    if (data.status == true) {
                        if(data.userText) {
                            $('.media-list').append(data.userText);
                            gobot();
                        }
                    } else {
                        console.log('key is not got');
                    }
                },
            });
        }, 4000);

        gobot();
    </script>
@endpush
