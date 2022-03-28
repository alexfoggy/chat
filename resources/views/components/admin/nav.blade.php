<div class="slim-header with-sidebar">
    <div class="container-fluid">
        <div class="slim-header-left">
            <h2 class="slim-logo"><a href="{{url('/cabinet')}}">
                    Yolly <span class="tx-warning">{{Cookie::get('lang')}}</span>
                    {{--                    {{dd($lang)}}--}}
                </a></h2>
            <a href="" id="slimSidebarMenu" class="slim-sidebar-menu"><span></span></a>
            {{--            <div class="search-box">--}}
            {{--                <input type="text" class="form-control" placeholder="Search">--}}
            {{--                <button class="btn btn-primary"><i class="fa fa-search"></i></button>--}}
            {{--            </div><!-- search-box -->--}}
        </div><!-- slim-header-left -->
        <div class="slim-header-right">
            <div class="dropdown dropdown-a">
                <a href="" class="header-notification" data-toggle="dropdown">
                    <i class="icon ion-ios-bell-outline"></i>
                    <span class="indicator"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-menu-header">
                        <h6 class="dropdown-menu-title">Notification</h6>
                        {{--<div>
                            <a href="">Filter List</a>
                            <a href="">Settings</a>
                        </div>--}}
                    </div><!-- dropdown-menu-header -->
                    <div class="dropdown-activity-list">
                    {{--    @if($notif->isNotEmpty())
                            @foreach($notif as $one_notif)
                                <div class="activity-item">
                                    @if($one_notif->clickable == 1)
                                        <a href="{{$one_notif->url}}" class="row no-gutters ">
                                            @else
                                                <div class="row no-gutters">
                                                    @endif
                                                    <div
                                                        class="col-2 tx-left tx-gray-600">{{\Carbon\Carbon::parse($one_notif->created_at)->format('d.m  g:i A')}}</div>
                                                    <div class="col-2 tx-center"><span
                                                            class="square-10 bg-{{$one_notif->type ?? 'info'}}"></span>
                                                    </div>
                                                    <div class="col-8">{{$one_notif->message ?? ''}}</div>
                                                @if($one_notif->clickable == 1)
                                        </a>
                                    @else
                                </div>
                                @endif
                    </div><!-- activity-item -->
                    @endforeach
                    @if($notif->count() > 8)
                        <div class="dropdown-list-footer">
                            <a href="page-activity.html"><i
                                    class="fa fa-angle-down"></i>{{trans('vars.show_all_notif',[],$lang)}}</a>
                        </div>
                    @endif
                    @else
                        <div class="activity-item">
                            <div class="row no-gutters">
                                <div class="col-2 tx-right">Start</div>
                                <div class="col-2 tx-center"><span class="square-10 bg-success"></span></div>
                                <div class="col-8">You are welcome</div>
                            </div><!-- row -->
                        </div><!-- activity-item -->
                    @endif--}}
                </div><!-- dropdown-activity-list -->

            </div><!-- dropdown-menu-right -->
        </div><!-- dropdown -->

        <div class="dropdown dropdown-c">
            <a href="#" class="logged-user" data-toggle="dropdown">
                <img
                    src="@if(Auth::user()->avatar){{asset('storage/'.Auth::user()->avatar)}}@else {{asset('images/no-person.svg')}} @endif"
                    alt="">
                <span>{{Auth::user()->first_name }}</span>
                <i class="fa fa-angle-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <nav class="nav">
                   {{-- @if(Auth::user()->type[0]->title == 'speaker')

                        <a href="{{url('cabinet')}}" class="nav-link"><i
                                class="icon ion-person"></i> {{trans('vars.view_profile',[],$lang)}}</a>
                        <a href="{{url('cabinet','edit')}}" class="nav-link"><i
                                class="icon ion-compose"></i> {{trans('vars.edit_profile',[],$lang)}}</a>
                        <a href="javascript:;" class="nav-link open-popup" data-open="modal-languages"><i
                                class="icon fa fa-globe"></i>{{trans('vars.languages',[],$lang)}}</a>
                        --}}{{--                        <a href="page-activity.html" class="nav-link"><i class="icon ion-ios-bolt"></i> Activity Log</a>--}}{{--
                        <a href="{{url('cabinet','settings')}}" class="nav-link"><i
                                class="icon ion-ios-gear"></i>{{trans('vars.acc_settings',[],$lang)}}</a>
                        <a href="{{url('accountOut')}}" class="nav-link "><i
                                class="icon ion-forward"></i>{{trans('vars.sign_out',[],$lang)}}</a>
                    @else
                        <a href="javascript:;" class="nav-link open-popup" data-open="modal-languages"><i
                                class="icon fa fa-globe"></i>{{trans('vars.languages',[],$lang)}}</a>
                        <a href="{{url('manager','settings')}}" class="nav-link"><i
                                class="icon ion-ios-gear"></i>{{trans('vars.acc_settings',[],$lang)}}</a>

                    @endif--}}
                    <a href="{{url('accountOut')}}" class="nav-link "><i
                            class="icon ion-forward"></i>{{trans('vars.sign_out',[],$lang)}}</a>
                </nav>
            </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
    </div><!-- header-right -->
</div><!-- container-fluid -->
</div><!-- slim-header -->


<div class="slim-body">
    <div class="slim-sidebar">
        <label class="sidebar-label">Menu</label>

        <ul class="nav nav-sidebar">
            @if(Auth::user()->type == 'user')

                <li class="sidebar-nav-item">
                    <a href="{{url('cabinet')}}" class="sidebar-nav-link"><i class="fa fa-bank"></i>Главная</a>
                </li>
               {{-- <li class="sidebar-nav-item">
                    <a href="{{url('cabinet/chats')}}" class="sidebar-nav-link"><i class="icon ion-chatbox-working"></i>Чаты</a>
                </li>--}}
                <li class="sidebar-nav-item">
                    <a href="{{url('cabinet/newsite')}}" class="sidebar-nav-link"><i class="fa fa-plus"></i>Add domain</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{url('cabinet/domains')}}" class="sidebar-nav-link"><i class="fa fa-clone"></i>Your domains</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{url('cabinet/forms')}}" class="sidebar-nav-link"><i class="icon ion-filing"></i>Forms</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{url('cabinet/feedbacks')}}" class="sidebar-nav-link"><i class="fa fa-envelope-o"></i>Feedbacks</a>
                </li>
                {{--<li class="sidebar-nav-item">
                    <a href="{{url('cabinet','tasks')}}" class="sidebar-nav-link"><i
                            class="icon icon ion-filing"></i>{{trans('vars.tasks',[],$lang)}}</a>
                </li>--}}
            @else
                <li class="sidebar-nav-item">
                    <a href="{{url('cabinet')}}" class="sidebar-nav-link"><i
                            class="icon ion-ios-contact"></i>{{trans('vars.profile',[],$lang)}}</a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="{{url('cabinet','tasks')}}" class="sidebar-nav-link"><i
                            class="icon icon ion-filing"></i>{{trans('vars.tasks',[],$lang)}}</a>
                </li>
            @endif
        </ul>
    </div><!-- slim-sidebar -->

  {{--  <div class="loading justify-content-center align-items-center position-fixed w-100 h-100"
         style="display:none;top:0;left:0;background:rgba(255,255,255,.6);z-index:9999;">
        <div class="justify-content-center flex-column align-items-center d-flex w-100 h-100">
            <div class="sk-wave">
                <div class="sk-rect sk-rect1 bg-gray-800"></div>
                <div class="sk-rect sk-rect2 bg-gray-800"></div>
                <div class="sk-rect sk-rect3 bg-gray-800"></div>
                <div class="sk-rect sk-rect4 bg-gray-800"></div>
                <div class="sk-rect sk-rect5 bg-gray-800"></div>
            </div>
            <div class="message-loading">
                Loading...
            </div>
        </div>
    </div>--}}

    <div class="errors-block">

    </div>

    <div class="modal modal-actions position-fixed">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content bd-0">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{trans('vars.approve_action',[],$lang)}}</h6>
                    <button type="button" class="close close-popup" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button"
                            class="btn btn-primary prove-button">{{trans('vars.approve',[],$lang)}}</button>
                    <button type="button"
                            class="btn btn-secondary close-popup">{{trans('vars.close',[],$lang)}}</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div>

    <div class="modal modal-languages position-fixed" style="background: rgba(0,0,0,.7)">
        <div class="modal-dialog" role="document">
            <div class="modal-content bd-0">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">{{trans('vars.select_language',[],$lang)}}</h6>
                    <button type="button" class="close close-it" data-close="modal-languages" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="body p-4">
                    <div class="row">
                        @foreach(config('general.languages') as $key => $value)
                            <div class="col-lg-3 mt-2">
                                <a href="javascript:;" style="text-transform: uppercase"
                                   class="tx-12 tx-black tx-bold lang-change" data-lang="{{$key}}">{{$value}}</a>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div><!-- modal-dialog -->
    </div>

