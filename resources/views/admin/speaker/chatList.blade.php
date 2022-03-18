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
    @if($chats)
    <div class="container container-messages with-sidebar">
        <div class="messages-left">
            <div class="slim-pageheader">
                <h6 class="slim-pagetitle">Messages</h6>
                {{--                <a href="" class="messages-compose"><i class="icon ion-compose"></i></a>--}}
            </div><!-- slim-pageheader -->

            <div class="messages-list rounded-10">
                @if($chats)
                    @foreach($chats as $one_chat)
                    <a href="javascript:;" data-chat="{{$one_chat->site_id}}" data-user="{{$one_chat->user_id}}"
                       class="chatChange media @if($loop->first) active @endif"
                       id="chat-{{$one_chat->site_id}}-{{$one_chat->user_id}}">
                        <div class="media-left">
                            <img src="http://via.placeholder.com/500x500" alt="">
                            <span class="square-10 bg-success"></span>
                        </div><!-- media-left -->
                        <div class="media-body">
                            <div class="pr-2">
                                <h6>@if($one_chat->userStatus == 1) User @else You @endif</h6>
                                <p>{{getLast($one_chat->user_id,$one_chat->site_id)}}</p>
                            </div>
                            <div>
                                <span>{{\Carbon\Carbon::parse($one_chat->created_at)->format('h:m')}}</span>
                                <div class="rounded-50 bg-success tx-12 tx-white px-2 messageStatus" data-msg="0"></div>
                            </div>
                        </div><!-- media-body -->
                    </a><!-- media -->
                    @endforeach
                @endif

            </div><!-- messages-list -->

            {{--<div class="messages-left-footer">
                <button class="btn btn-slim btn-uppercase-sm btn-block">Load Older Messages</button>
            </div><!-- messages-left-footer -->--}}
        </div><!-- messages-left -->

        <div class="messages-right rounded-10">
            <div class="message-header">
                <a href="" class="message-back"><i class="fa fa-angle-left"></i></a>
                {{-- <div class="media">
                     <img src="http://via.placeholder.com/500x500" alt="">
                     <div class="media-body">
                         <h6>Joyce Chua</h6>
                     </div><!-- media-body -->
                 </div>--}}

            </div><!-- message-header -->
            <div class="message-body position-relative">
                <div class="loading position-absolute" style="top:50%;left:50%;transform:translate(-50%,-50%)">
                    <div class="sk-folding-cube">
                        <div class="sk-cube1 sk-cube"></div>
                        <div class="sk-cube2 sk-cube"></div>
                        <div class="sk-cube4 sk-cube"></div>
                        <div class="sk-cube3 sk-cube"></div>
                    </div>
                </div>
                <div class="media-list heightFixedChat">
                    @if($firstChat)
                        @foreach($firstChat as $one_msg)
                        @if($one_msg->userStatus == 2)

                            @include('messages.adminRight')

                        @else

                            @include('messages.adminLeft')

                        @endif
                        @endforeach
                    @endif


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
                        <input type="text" class="form-control" id="textChatAssist"
                               placeholder="Type something here...">
                    </div><!-- col-8 -->
                    <div class="col-1 col-sm-1 col-xl-1 tx-right">
                        <button class="btn-primary btn d-block w-100 rounded-10" id="sendmsg"
                                data-id="{{$firstChat[0]->user_id}}" data-site-id="{{$firstChat[0]->site_id}}">Send <i
                                class="fa fa-send"></i></button>
                    </div><!-- col-4 -->
                </form><!-- row -->
            </div><!-- message-footer -->
        </div><!-- messages-right -->
        <div></div>
    </div>
        @else

        <div class="py-4 bg-gray-100 tx-center rounded-10 tx-20 tx-uppercase tx-primary"> You have no messages</div>

    @endif
@endsection
@push('scripts')
    <script>

        function gobot() {
            //scroll to bottom
            let d = $('.heightFixedChat');
            d.scrollTop(d.prop("scrollHeight"));
        }

        $(document).on('click', '#sendmsg', function (e) {

            e.preventDefault();
            let msg = $(document).find('#textChatAssist').val();
            if (msg != '') {
                $(document).find('#textChatAssist').val('');
                let url = "https://yolly.pro/api/sendmsgpanel";
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
            $('.loading').fadeIn();

            e.preventDefault();
            $(document).find('#textChatAssist').val('');

            let url = "https://yolly.pro/api/changechat";
            let userid = $(this).attr('data-user');
            let siteid = $(this).attr('data-chat');

            $('#sendmsg').attr('data-id', userid);
            $('#sendmsg').attr('data-site-id', siteid);

            $('.chatChange').removeClass('active');
            $(this).addClass('active');
            let statusMsg = $(this).find('.messageStatus');
            statusMsg.attr('data-msg','0');
            statusMsg.removeClass('active');

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
                    $('.loading').fadeOut();
                    gobot();
                }
            });
        });

        checkAns = setInterval(function () {
            let userid = $('#sendmsg').attr('data-id');
            let siteid = $('#sendmsg').attr('data-site-id');
            let url = "https://yolly.pro/api/checkResponsePanel";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'user_id': userid,
                    'site_id': siteid,
                    'yourId': {{\Illuminate\Support\Facades\Auth::user()->id}},
                },
                success: function (data) {
                    if (data.status == true) {
                        if (data.userText) {
                            $('.media-list').append(data.userText);
                            gobot();
                        }
                        if (data.newMsg) {
                            for (let i = 0; i < data.newMsg.length; i++) {
                                let block = $('#chat-' + data.newMsg[i][0] + '-' + data.newMsg[i][1]).find('.messageStatus');
                                block.addClass('active');
                                let k = parseInt(block.attr('data-msg'));
                                k++;
                                block.text(k);
                                block.attr('data-msg', k);
                            }
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
