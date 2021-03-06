<!--**********************************
            Nav header start
        ***********************************-->

@php
    $message = \App\Helpers\Helper::get_user_messages(auth()->user()->userID);
    $notification = \App\Helpers\Helper::get_user_notifications(auth()->user()->userID);
@endphp



<div class="nav-header">
    <div class="brand-logo">
        <a href="/">
            <b class="logo-abbr"><img src="/images/sidebar_images/amarid_logo_large.png" alt=""> </b>
            <span class="logo-compact"><img src="/images/logo-compact.png" alt=""></span>
            <span class="brand-title">
                <img src="/images/sidebar_images/amarid_logo_large.png" alt="" style="height: 40px;width: 40px;"><span class="text-white font-weight-bold ml-2 my-auto">AmarID.xyz</span>
            </span>
        </a>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->

<!--**********************************
    Header start
***********************************-->
<div class="header">
    <div class="header-content clearfix">

        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
            </div>
        </div>
        <div class="header-left">
            <div class="input-group icons">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                </div>
                <input type="search" class="form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                <div class="drop-down animated flipInX d-md-none">
                    <form action="#">
                        <input type="text" class="form-control" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>
        <form id="conversation_form" method="post" action="/see_full_conversation">
            @csrf
            <input type="hidden" name="partner_id" id="partner_id" value="false">
        </form>






        <div class="header-right">
            <ul class="clearfix">
                <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="mdi mdi-email-outline"></i>
                        <span class="badge badge-pill @if($message['seen_count']) gradient-1 @endif">{{$message['seen_count']}}</span>
                    </a>
                    <div class="drop-down animated fadeIn dropdown-menu">
                        <div class="dropdown-content-heading d-flex justify-content-between">
                            <span class="">
                                @if($message['m_found'])
                                    {{$message['seen_count']}} New Messages
                                @else
                                    No new messages
                                @endif
                            </span>
                            <a href="javascript:void()" class="d-inline-block">
                                <span class="badge badge-pill gradient-1">{{$message['seen_count']}}</span>
                            </a>
                        </div>
                        <div class="dropdown-content-body">
                            <ul class="">
                                @php($count = 0)
                                @if($message['m_found'])
                                    @foreach($message['messages'] as $msg)
                                        @php($count ++)
                                        <li class="notification-unread">
                                            <a href="" onclick="conversation_function(<?php echo $msg->senderID ?>);return false;">

                                                <img class="float-left mr-3 avatar-img" src="{{ $msg->sphoto_url != null ? url('storage'.$msg->sphoto_url):'images/avatar/dummy.png'}}" alt="">
                                                {{--<div class="notification-content @if(!$msg->seen) text-warning @else text-dark @endif">--}}
                                                <div class="notification-content {{ $msg->seen == 0 ? 'text-warning' :'text-dark'}}">

                                                    <div class="notification-heading">{{$msg->sfirstname.' '.$msg->slastname}}</div>
                                                    <div class="notification-timestamp">{{$msg->time}}</div>
                                                    <div class="notification-text">
                                                        @if(strlen($msg->message) < 34)
                                                            {{$msg->message}}
                                                        @else
                                                            {{substr($msg->message, 0, 34)}} ...
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        @if($count>3)
                                            <li class="notification-unread">
                                                <a href="javascript:void()">
                                                    <div class="font-weight-bolder text-primary text-center">
                                                        <a href="/see_more_message">See More</a>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                        @break($count>3)
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        @if($notification['seen_count'] > 0)
                            <span class="badge badge-pill gradient-2">{{$notification['seen_count']}}</span>
                        @else
                            <span class="badge badge-pill"></span>
                        @endif
                    </a>
                    <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                        <div class="dropdown-content-heading d-flex justify-content-between">
                            @if($notification['seen_count'])
                                <span class="">{{$notification['seen_count']}} New Notifications</span>
                            @else
                                <span class="">No New Notifications</span>
                            @endif
                            <a href="javascript:void()" class="d-inline-block">
                                <span class="badge badge-pill gradient-2">{{$notification['seen_count']}}</span>
                            </a>
                        </div>
                        <div class="dropdown-content-body ">
                            <ul>
                                @if($notification['n_found'])
                                    @php($count = 0)
                                    @foreach($notification['notifications'] as $not)
                                        @php($count ++)
                                        <li>
                                            <?php
                                            if(auth()->user()->admin || auth()->user()->print_vendor || auth()->user()->delivery_vendor)
                                            {
                                                $url = \App\Helpers\Helper::get_order_url_for_admin($not->notificationID,$not->message,$not->type);
                                                echo '<a href="'.$url.'">';
                                            }else
                                            {
                                                $url = \App\Helpers\Helper::get_order_url_for_user($not->message,$not->type);
                                                echo '<a href="'.$url.'">';
                                            }

                                            ?>

                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">{{$not->message}}</h6>
                                                    <span class="notification-text">{{$not->time}}</span>
                                                </div>
                                            </a>
                                        </li>
                                        @if($count>3)
                                            <li class="notification-unread">
                                                <a href="javascript:void()">
                                                    <div class="font-weight-bolder text-primary text-center">
                                                        <a href="/show_more_notification">See More</a>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                        @break($count>3)
                                    @endforeach
                                @endif
                            </ul>

                        </div>
                    </div>
                </li>
                <li class="icons dropdown d-none d-md-flex">
                    <a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                        <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                    </a>
                    <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li><a href="javascript:void()">English</a></li>
                                <li><a href="javascript:void()">Dutch</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="icons dropdown">
                    <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="{{ auth()->user()->photo_url != null ? url('storage'.auth()->user()->photo_url):'images/avatar/dummy.png'}}" height="40" width="40" alt="">
                    </div>
                    <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                        <div class="dropdown-content-body">
                            <ul>
                                <li>
                                    <a href="/edit_profile"><i class="icon-user"></i> <span>Edit Profile</span></a>
                                </li>
                                <li>
                                    <a href="/see_more_message">
                                        <i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill @if($message['seen_count']) gradient-1 @endif">{{$message['seen_count']}}</div>
                                    </a>
                                </li>

                                <hr class="my-2">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i> <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--**********************************
    Header end ti-comment-alt
***********************************-->
