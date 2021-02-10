@extends(auth()->user()->admin ||auth()->user()->print_vendor ||auth()->user()->delivery_vendor ?'layouts.admin_layout': 'layouts.user_layout')
@php($message =  $data['data'])
@php($partner = $data['partner'])
@php($conversation = $data['conv'])

@section('custom_style')
    {{--Chatbox CSS--}}
    <style>
        .DivToScroll{
            background-color: #F5F5F5;
            border: 1px solid #DDDDDD;
            border-radius: 4px 0 4px 0;
            color: #3B3C3E;
            font-size: 12px;
            font-weight: bold;
            left: -1px;
            padding: 10px 7px 5px;
        }

        .DivWithScroll{
            height:50vh;
            overflow:scroll;
            overflow-x:hidden;
        }
    </style>
    <link rel="stylesheet" href="/css/chat_css/chat.css">
@endsection
@section('content')
    <div class="container-fluid px-lg-4">


        <!-- Content wrapper start -->
        <div class="content-wrapper">

            <!-- Row start -->
            <div class="row gutters">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    <div class="card m-0">

                        <!-- Row start -->
                        <div class="row no-gutters">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                                <div class="users-container">
                                    <div class="chat-search-box">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="Search">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="users">

                                        @foreach($data['data'] as $msg)
                                            @if($msg->senderID == auth()->user()->userID)
                                                <a href="" onclick="search_function(<?php echo $msg->receiverID ?>);return false;">
                                                <li class="person" data-chat="person1">
                                                    <div class="user">
                                                        <img src="{{$msg->rphoto_url != null ? url('storage'.$msg->rphoto_url):"/images/avatar/dummy.png"}}" alt="Retail Admin">
                                                        <span class="status busy"></span>
                                                    </div>
                                                    <p class="name-time">
                                                        <span class="name">{{$msg->rfirstname.' '.$msg->rlastname}}</span>
                                                        <span class="time">{{(new DateTime($msg->time))->format("d/m h:i A")}}</span>
                                                    </p>
                                                </li>
                                                </a>
                                            @elseif($msg->receiverID == auth()->user()->userID)
                                                <a href="" onclick="search_function(<?php echo $msg->senderID ?>);return false;">
                                                    <li class="person" data-chat="person1">
                                                        <div class="user">
                                                            <img src="{{$msg->sphoto_url != null ? url('storage'.$msg->sphoto_url):"/images/avatar/dummy.png"}}" alt="Retail Admin">
                                                            <span class="status busy"></span>
                                                        </div>
                                                        <p class="name-time">
                                                            <span class="name">{{$msg->sfirstname.' '.$msg->slastname}}</span>
                                                            <span class="time">{{(new DateTime($msg->time))->format("d/m h:i A")}}</span>
                                                        </p>
                                                    </li>
                                                </a>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
                                <div class="selected-user">
                                    <span>To: <span class="name">{{$partner->firstname.' '.$partner->lastname}}</span></span>
                                </div>
                                <div class="chat-container">
                                    <ul class="chat-box chatContainerScroll DivWithScroll" id="message_body">
                                        @foreach($conversation as $con)
                                            @if($con->senderID == $partner->userID)
                                                <li class="chat-left">
                                                    <div class="chat-avatar">
                                                        <img src="{{$partner->photo_url != null ? url('storage'.$partner->photo_url):"/images/avatar/dummy.png"}}" alt="Retail Admin">
                                                        <div class="chat-name">{{$partner->firstname}}</div>
                                                    </div>
                                                    <div class="chat-text bg-warning text-white" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0
                                            rgba(0,0,0,0.19);">{{$con->message}}</div>
                                                    <div class="chat-hour">{{(new DateTime($con->time))->format("h:i:s A")}} <span class="fa fa-check-circle"></span></div>
                                                </li>
                                            @else
                                                <li class="chat-right">
                                                    <div class="chat-hour">{{(new DateTime($con->time))->format("h:i:s A")}} <span class="fa fa-check-circle"></span></div>
                                                    <div class="chat-text bg-info text-white" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0
                                            rgba(0,0,0,0.19);">{{$con->message}}</div>
                                                    <div class="chat-avatar">
                                                        <img src="{{ auth()->user()->photo_url != null ? url('storage'.auth()->user()->photo_url):'images/avatar/dummy.png'}}" alt="">
                                                        <div class="chat-name">{{auth()->user()->firstname}}</div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                    <div class="form-group mt-3 mb-0">
                                        <form action="/send_message" method="post">
                                            @csrf
                                            <input type="hidden" name="receiver_id" value="{{$partner->userID}}">
                                            <input type="hidden" name="sender_id" value="{{auth()->user()->userID}}">
                                            <textarea class="form-control rounded-pill" rows="1" placeholder="Type your message here..." name="msg_txt"></textarea>
                                            <button type="submit" class="btn btn-primary btn-sm m-b-30 m-t-15 f-s-14 p-l-20 p-r-20 m-r-10 float-right my-1" onsubmit="return false" ><i class="fa fa-paper-plane m-r-5"></i> Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>

                </div>

            </div>
            <!-- Row end -->

        </div>
        <!-- Content wrapper end -->

    </div>

    <form id="search_form" method="post" action="/see_full_conversation">
        @csrf
        <input type="hidden" name="other_id" id="other_id" value="false">
    </form>
@endsection



@section('extra_js')

    <script>
        function search_function(keyword) {
            console.log(keyword);
            document.getElementById("other_id").value = keyword;
            document.getElementById('search_form').submit();
        }

        var messageBody = document.querySelector('#message_body');
        messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
    </script>
    <!-- Chartjs -->
    <script src="/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="/plugins/d3v3/index.js"></script>
    <script src="/plugins/topojson/topojson.min.js"></script>
    <script src="/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="/plugins/raphael/raphael.min.js"></script>
    <script src="/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="/plugins/chartist/js/chartist.min.js"></script>
    <script src="/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>



    <script src="/js/dashboard/dashboard-1.js"></script>
@endsection


{{--
<li class="chat-left">
    <div class="chat-avatar">
        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
        <div class="chat-name">Russell</div>
    </div>
    <div class="chat-text">Hello, I'm Russell.
        <br>How can I help you today?</div>
    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
</li>
<li class="chat-right">
    <div class="chat-hour">08:56 <span class="fa fa-check-circle"></span></div>
    <div class="chat-text">Hi, Russell
        <br> I need more information about Developer Plan.</div>
    <div class="chat-avatar">
        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
        <div class="chat-name">Sam</div>
    </div>
</li>
<li class="chat-left">
    <div class="chat-avatar">
        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
        <div class="chat-name">Russell</div>
    </div>
    <div class="chat-text">Are we meeting today?
        <br>Project has been already finished and I have results to show you.</div>
    <div class="chat-hour">08:57 <span class="fa fa-check-circle"></span></div>
</li>
<li class="chat-right">
    <div class="chat-hour">08:59 <span class="fa fa-check-circle"></span></div>
    <div class="chat-text">Well I am not sure.
        <br>I have results to show you.</div>
    <div class="chat-avatar">
        <img src="https://www.bootdey.com/img/Content/avatar/avatar5.png" alt="Retail Admin">
        <div class="chat-name">Joyse</div>
    </div>
</li>
<li class="chat-left">
    <div class="chat-avatar">
        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
        <div class="chat-name">Russell</div>
    </div>
    <div class="chat-text">The rest of the team is not here yet.
        <br>Maybe in an hour or so?</div>
    <div class="chat-hour">08:57 <span class="fa fa-check-circle"></span></div>
</li>
<li class="chat-right">
    <div class="chat-hour">08:59 <span class="fa fa-check-circle"></span></div>
    <div class="chat-text">Have you faced any problems at the last phase of the project?</div>
    <div class="chat-avatar">
        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" alt="Retail Admin">
        <div class="chat-name">Jin</div>
    </div>
</li>
<li class="chat-left">
    <div class="chat-avatar">
        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
        <div class="chat-name">Russell</div>
    </div>
    <div class="chat-text">Actually everything was fine.
        <br>I'm very excited to show this to our team.</div>
    <div class="chat-hour">07:00 <span class="fa fa-check-circle"></span></div>
</li>--}}
