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
                                <h4 class="card-title text-primary">Cancelled</h4>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of On Cancelled Orders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders are Cancelled Yet</h5>
                                @endif
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table v-middle  table-hover" id="my_table">
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
                                $count = 0;
                                @endphp
                                @foreach($data['data'] as $package)
                                <tr>
                                    <td>{{++$count}}</td>
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
                                            <img src="{{$package->orderUrl.'/front.jpg'}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                        <td>
                                            <img src="{{$package->orderUrl.'/back.jpg'}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                    @endif
                                </tr>
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


