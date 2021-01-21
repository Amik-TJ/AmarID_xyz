@extends(auth()->user()->admin ||auth()->user()->print_vendor ||auth()->user()->delivery_vendor ?'layouts.admin_layout': 'layouts.user_layout')
@php($message =  session()->get('message_data'))

@section('custom_style')
    {{--Chatbox CSS--}}
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
                                        <li class="person" data-chat="person1">
                                            <div class="user">
                                                <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                <span class="status busy"></span>
                                            </div>
                                            <p class="name-time">
                                                <span class="name">Steve Bangalter</span>
                                                <span class="time">15/02/2019</span>
                                            </p>
                                        </li>
                                        <li class="person" data-chat="person1">
                                            <div class="user">
                                                <img src="https://www.bootdey.com/img/Content/avatar/avatar1.png" alt="Retail Admin">
                                                <span class="status offline"></span>
                                            </div>
                                            <p class="name-time">
                                                <span class="name">Steve Bangalter</span>
                                                <span class="time">15/02/2019</span>
                                            </p>
                                        </li>
                                        <li class="person active-user" data-chat="person2">
                                            <div class="user">
                                                <img src="https://www.bootdey.com/img/Content/avatar/avatar2.png" alt="Retail Admin">
                                                <span class="status away"></span>
                                            </div>
                                            <p class="name-time">
                                                <span class="name">Peter Gregor</span>
                                                <span class="time">12/02/2019</span>
                                            </p>
                                        </li>
                                        <li class="person" data-chat="person3">
                                            <div class="user">
                                                <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                                                <span class="status busy"></span>
                                            </div>
                                            <p class="name-time">
                                                <span class="name">Jessica Larson</span>
                                                <span class="time">11/02/2019</span>
                                            </p>
                                        </li>
                                        <li class="person" data-chat="person4">
                                            <div class="user">
                                                <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" alt="Retail Admin">
                                                <span class="status offline"></span>
                                            </div>
                                            <p class="name-time">
                                                <span class="name">Lisa Guerrero</span>
                                                <span class="time">08/02/2019</span>
                                            </p>
                                        </li>
                                        <li class="person" data-chat="person5">
                                            <div class="user">
                                                <img src="https://www.bootdey.com/img/Content/avatar/avatar5.png" alt="Retail Admin">
                                                <span class="status away"></span>
                                            </div>
                                            <p class="name-time">
                                                <span class="name">Michael Jordan</span>
                                                <span class="time">05/02/2019</span>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
                                <div class="selected-user">
                                    <span>To: <span class="name">Emily Russell</span></span>
                                </div>
                                <div class="chat-container">
                                    <ul class="chat-box chatContainerScroll">
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
                                        </li>
                                    </ul>
                                    <div class="form-group mt-3 mb-0">
                                        <textarea class="form-control" rows="3" placeholder="Type your message here..."></textarea>
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
@endsection



@section('extra_js')
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
