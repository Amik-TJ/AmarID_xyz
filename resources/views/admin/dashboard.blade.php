@extends('layouts.admin_layout')
@section('content')
    @php
        $found = $data['found'];
        $active_users = $data['active_users'];
        $total_order = $data['total_order'];
        $to_pay = $data['to_pay'];
        $to_pay_p = (int)(($to_pay/$total_order)*100);
        $on_verification = $data['on_verification'];
        $on_verification_p = (int)(($on_verification/$total_order)*100);
        $verification_done = $data['verification_done'];
        $print_vendor_assigned = $data['print_vendor_assigned'];
        $processing  = $data['Processing'];
        $processing_p = (int)(($processing/$total_order)*100);
        $print_done = $data['print_done'];
        $print_done_p = (int)(($print_done/$total_order)*100);
        $print_complete_and_received = $data['print_complete_and_received'];
        $assign_delivery_vendor = $data['assign_delivery_vendor'];
        $on_delivery = $data['on_delivery'];
        $on_delivery_p = (int)(($on_delivery/$total_order)*100);
        $delivered = $data['delivered'];
        $delivered_p = (int)(($delivered/$total_order)*100);
        $revenue_delivered = $data['revenue_delivered'];
        $revenue_all = $data['revenue_all'];
    @endphp
    <div class="container-fluid px-lg-4">

        {{-------------------Profile Info----------------}}
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                            <p class="text-dark px-4 font-weight-bold">
                                                @if(auth()->user()->admin == 1)
                                                    Admin
                                                @elseif(auth()->user()->print_vendor == 1)
                                                    Print Vendor
                                                @elseif(auth()->user()->delivery_vendor == 1)
                                                    Delivery Vendor
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="{{url('storage'.auth()->user()->photo_url)}}" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</h3>
                                        <p class="text-muted mb-0">
                                            @if(auth()->user()->admin == 1)
                                                Admin
                                            @elseif(auth()->user()->print_vendor == 1)
                                                Print Vendor
                                            @elseif(auth()->user()->delivery_vendor == 1)
                                                Delivery Vendor
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <button class="btn btn-danger my-3">Account Information</button>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{auth()->user()->phone}}</span></li>
                                    <li><strong class="text-dark mr-4">Email</strong> <span>{{auth()->user()->email}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{------------------------Dashboard Cards-------------------------------}}
        <div class="row mb-5">
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-1 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Order Requests</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$to_pay}}</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-2 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Revenue</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">$ {{$revenue_all}}</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-3 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Completed Orders</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$delivered}}</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-4 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Active Users</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$active_users}}</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
        </div>
        {{------------------------Dashboard Cards Ends-------------------------------}}



        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card card-widget">
                    <div class="card-body">
                        <h4 class="text-muted font-weight-bold">Order Overview </h4>
                        <div class="mt-4">
                            <h4>{{$to_pay}}</h4>
                            <h6>To Pay Order <span class="pull-right">{{$to_pay_p}}%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-primary" style="width: {{$to_pay_p}}%;" role="progressbar"><span class="sr-only">{{$to_pay_p}}% Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>{{$on_verification}}</h4>
                            <h6 class="m-t-10 text-muted">On Verification<span class="pull-right">{{$on_verification_p}}%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-success" style="width: {{$on_verification_p}}%;" role="progressbar"><span class="sr-only">50% Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>{{$processing}}</h4>
                            <h6 class="m-t-10 text-muted">Processing <span class="pull-right">{{$processing_p}}%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-warning" style="width: {{$processing_p}}%;" role="progressbar"><span class="sr-only">{{$processing_p}}% Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>{{$print_done}}</h4>
                            <h6 class="m-t-10 text-muted">Print Done <span class="pull-right">{{$print_done_p}}%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-info" style="width: {{$print_done_p}}%;" role="progressbar"><span class="sr-only">{{$print_done_p}}% Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>{{$on_delivery}}</h4>
                            <h6 class="m-t-10 text-muted">On delivery<span class="pull-right">{{$on_delivery_p}}%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-dark" style="width: {{$on_delivery_p}}%;" role="progressbar"><span class="sr-only">{{$on_delivery_p}}% Order</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4>{{$delivered}}</h4>
                            <h6 class="m-t-10 text-muted">Completed <span class="pull-right">{{$delivered_p}}%</span></h6>
                            <div class="progress mb-3" style="height: 7px">
                                <div class="progress-bar bg-primary" style="width: {{$delivered_p}}%;" role="progressbar"><span class="sr-only">{{$delivered_p}}% Order</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        {{-------------------------------graph-----------------------------}}
        {{--<div class="row">
            <div class="col-md-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Order Summary</h4>
                        <div id="morris-bar-chart"></div>
                    </div>
                </div>
            </div>
        </div>--}}


        {{---------------------------Table Starts---------------------------}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Orders</h4>
                        <div class="active-member">
                            <div class="table-responsive">
                                <table class="table table-xs mb-0">
                                    <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Customer ID</th>
                                        <th>Order ID</th>
                                        <th>Package Title</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['latest_orders'] as $all)
                                    <tr>
                                        <td>
                                            @if($all->photo_url != null)
                                                <img src="{{url('storage'.$all->photo_url)}}" class=" rounded-circle mr-3" alt="">
                                            @else
                                                <img src="{{url('storage/uploads/3.jpg')}}" class=" rounded-circle mr-3" alt="">
                                            @endif
                                            {{$all->firstname}} {{$all->lastname}}</td>
                                        <td>{{$all->userID}}</td>
                                        <td>{{$all->orderID}}</td>
                                        <td>
                                            <span>{{$all->title}}</span>
                                        </td>
                                        <td><i class="fa fa-circle-o text-success  mr-2"></i>{{$all->status}}</td>
                                        <td>
                                            {{(new DateTime($all->placed))->format("Y-m-d")}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{---------------------------Social Media--------------------------}}
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-facebook">
                        <span class="s-icon"><i class="fa fa-facebook"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-linkedin">
                        <span class="s-icon"><i class="fa fa-linkedin"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-googleplus">
                        <span class="s-icon"><i class="fa fa-google-plus"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="social-graph-wrapper widget-twitter">
                        <span class="s-icon"><i class="fa fa-twitter"></i></span>
                    </div>
                    <div class="row">
                        <div class="col-6 border-right">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">89k</h4>
                                <p class="m-0">Friends</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="pt-3 pb-3 pl-0 pr-0 text-center">
                                <h4 class="m-1">119k</h4>
                                <p class="m-0">Followers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
