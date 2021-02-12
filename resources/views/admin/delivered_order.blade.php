@extends('layouts.admin_layout')
@section('data_table_bootstrap')
    <link href="/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">

        {{----------------------------------Table Starts-------------------------------------------}}

        <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title text-primary">Completed Order</h4>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of Delivered Orders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders have been Delivered Yet</h5>
                                @endif
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    @if($data['found'])
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table table-striped zero-configuration">
                                    <thead>
                                    <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);"><th class="border-top-0">#</th>
                                    <th class="border-top-0">Order ID</th>
                                    <th class="border-top-0">Package Type</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Order Date</th>
                                    <th class="border-top-0">Card Type</th>
                                    <th class="border-top-0">Card Front</th>
                                    <th class="border-top-0">Card Back</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $count = 1;
                                @endphp
                                @foreach($data['data'] as $package)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$package->orderID}}</td>
                                    <td>{{$package->title}}</td>
                                    <td>
                                        <span class="m-b-0 font-16">{{$package->firstname." ".$package->lastname}}</span>
                                    </td>
                                    <td>{{$package->placed}}</td>
                                    <td>
                                        @if($package->glossy)
                                            Glossy
                                        @else
                                            Normal
                                        @endif
                                    </td>
                                    @if($package->orderUrl == null)
                                        <td>No Images</td>
                                        <td>No Images</td>
                                    @else
                                        <td>
                                            <img src="{{url('storage/'.$package->orderUrl.'/front.jpg')}}" alt="" style="height: 40px;width: 60px;">
                                        </td>
                                        <td>
                                            <img src="{{url('storage/'.$package->orderUrl.'/back.jpg')}}" alt="" style="height: 40px;width: 60px;">
                                        </td>
                                    @endif
                                </tr>
                                @php
                                    $count ++;
                                @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>




@endsection

@section('data_table')
    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
@endsection
