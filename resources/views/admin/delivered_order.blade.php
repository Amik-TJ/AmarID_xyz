@extends('layouts.admin_layout')
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
                            <table class="table v-middle  table-hover">
                                <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">#</th>
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

{{--<div class="d-flex align-items-center">
                                        <div class="m-r-10"><a class="btn btn-circle btn-info text-white">EA</a></div>
                                        <div class="">
                                            <h4 class="m-b-0 font-16">Elite Admin</h4>
                                        </div>
                                    </div>--}}
