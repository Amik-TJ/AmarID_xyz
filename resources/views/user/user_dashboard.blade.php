@extends('layouts.user_layout')
@section('content')
    @php
        $found = $data['found'];
        $total_order = $data['total_order'];
        $to_pay = $data['to_pay'];
        $on_verification = $data['on_verification'];
        $processing  = $data['Processing'];
        $on_delivery = $data['on_delivery'];
        $delivered = $data['delivered'];
        if ($total_order > 0)
        {
            $to_pay_p = (int)(($to_pay/$total_order)*100);
            $delivered_p = (int)(($delivered/$total_order)*100);
            $on_delivery_p = (int)(($on_delivery/$total_order)*100);
            $processing_p = (int)(($processing/$total_order)*100);
            $on_verification_p = (int)(($on_verification/$total_order)*100);
        }
        else
            {
                $to_pay_p = 0;
                $delivered_p = 0;
                $on_delivery_p = 0;
                $processing_p = 0;
                $on_verification_p = 0;
            }
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
                                                Dasshboard
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="{{url('storage'.auth()->user()->photo_url)}}" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</h3>
                                        {{--<p class="text-muted mb-0">

                                        </p>--}}
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
                        <h3 class="card-title text-white">On Verification</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$on_verification}}</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-3 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Processing</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$processing}}</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-4 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Recieved</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$delivered}}</h2>
                            <p class="text-white mb-0">Jan - March 2019</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
        </div>
        {{------------------------Dashboard Cards Ends-------------------------------}}



        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card card-widget">
                    <div class="card-body">
                        <h4 class="text-muted font-weight-bold">Your Order Summary </h4>
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
                                <div class="progress-bar bg-info" style="width: {{$delivered_p}}%;" role="progressbar"><span class="sr-only">{{$delivered_p}}% Order</span>
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
                        @if($found)
                            <div class="active-member">
                                <div class="table-responsive">
                                    <table class="table table-xs mb-0">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Date</th>
                                            <th>Package Type</th>
                                            <th>Card Type</th>
                                            <th>Order Status</th>
                                            <th>Card Front</th>
                                            <th>Card Back</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach($data['latest_orders'] as $all)
                                            @php
                                                ++$count;
                                            @endphp
                                            <tr>
                                                <td>{{$all->orderID}}</td>
                                                <td>{{(new DateTime($all->placed))->format("Y-m-d")}}</td>
                                                <td>{{$all->title}}</td>
                                                <td>
                                                    @if($all->glossy)
                                                        Glossy
                                                    @else
                                                        Normal
                                                    @endif
                                                </td>
                                                <td>
                                                    <i class="fa fa-circle-o text-success  mr-2"></i>
                                                    @if($all->status == 'Print Vendor Assigned' || $all->status == 'Print Done' ||$all->status == 'Print Complete and Received' ||$all->status == 'Assign Delivery Vendor' || $all->status == 'Verification Done')
                                                        Processing
                                                    @else
                                                        {{$all->status}}
                                                    @endif
                                                </td>

                                                @if($all->orderUrl == null)
                                                    <td>No Images</td>
                                                    <td>No Images</td>
                                                @else
                                                    <td>
                                                        <img src="{{url('storage/'.$all->orderUrl.'resize_front.jpg')}}" alt="No Images" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                                    </td>
                                                    <td>
                                                        <img src="{{url('storage/'.$all->orderUrl.'resize_back.jpg')}}" alt="No Images" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                                    </td>
                                                @endif
                                            </tr>
                                            @break($count > 10)
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            You Have No Recent Orders
                        @endif
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
