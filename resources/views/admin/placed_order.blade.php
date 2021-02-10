@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <button type="button" class="btn-sm btn-danger shadow-sm ml-auto"
                            data-toggle="modal" data-target="#cancell_all_modal"><i class="fas fa-address-card"></i>
                        Cancel All Orders
                    </button>
                </div>
            </div>
        {{----------------------------------Table Starts-------------------------------------------}}

        <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h1 class="card-title text-primary">Placed Orders</h1>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of Placed Orders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders Have been Placed Yet</h5>
                                @endif
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table v-middle table-hover">
                                <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Order ID</th>
                                    <th class="border-top-0">Package ID</th>
                                    <th class="border-top-0">Package Type</th>
                                    <th class="border-top-0">Customer ID</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Order Date</th>
                                    <th class="border-top-0">Card Type</th>
                                    <th class="border-top-0">Card Front</th>
                                    <th class="border-top-0">Card Back</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($data['data'] as $all)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$all->orderID}}</td>
                                    <td>{{$all->packageID}}</td>
                                    <td>{{$all->title}}</td>
                                    <td>{{$all->userID}}</td>
                                    <td>
                                        <span class="m-b-0 font-16">{{$all->firstname." ".$all->lastname}}</span>
                                    </td>
                                    <td>{{$all->placed}}</td>
                                    <td>
                                        @if($all->glossy)
                                            Glossy
                                        @else
                                            Normal
                                        @endif
                                    </td>
                                    @if($all->orderUrl == null)
                                        <td>No Images</td>
                                        <td>No Images</td>
                                    @else
                                        <td>
                                            <img src="{{url('storage/'.$all->orderUrl.'/front.jpg')}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                        <td>
                                            <img src="{{url('storage/'.$all->orderUrl.'/back.jpg')}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                    @endif
                                    @php
                                        $start_date = new DateTime($all->placed);
                                        $since_start = $start_date->diff(now());
                                        $action = ($since_start->days > 2) ? true:false;
                                    @endphp
                                    <td>
                                        <form action="/cancel_order" method="post">
                                            @csrf
                                            <div class="form-row">
                                                @if($action)
                                                    <input type="hidden" name="orderID" value="{{$all->orderID}}">
                                                    <button type="submit" class="btn btn-sm btn-danger btn-sm">Cancel Order</button>
                                                @else
                                                    <button class="btn btn-sm btn-danger btn-sm" disabled>Cancel Order</button>
                                                @endif
                                            </div>
                                        </form>
                                    </td>
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

    <!----------------------------- Modal ----------------------------->
    <div class="modal fade" id="cancell_all_modal" tabindex="-1" role="dialog" aria-labelledby="examplcancell_all_modaleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cancel All Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are You want to sure to cancel all orders
                </div>
                <div class="modal-footer">
                    <form action="/cancel_all_order" method="post">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




@endsection


