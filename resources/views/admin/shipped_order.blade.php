@extends('layouts.admin_layout')
@section('content')
    @php
    $print = auth()->user()->print_vendor ;
    @endphp
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
                                <h1 class="card-title text-primary">Shipped Orders</h1>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of Shipped Orders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders Have been Shipped Yet</h5>
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
                                    <th class="border-top-0">Order Status</th>
                                    <th class="border-top-0">Package Type</th>
                                    <th class="border-top-0">User ID</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Order Date</th>
                                    <th class="border-top-0">Card Type</th>
                                    <th class="border-top-0">Card Front</th>
                                    <th class="border-top-0">Card Back</th>
                                    @if(!$print)<th class="border-top-0">Action</th>@endif


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
                                    <td>{{$all->status}}</td>
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
                                    @if(!$print)
                                    <td>
                                        <form action="/mark_as_shipped" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <label>
                                                    <input type="hidden" name="orderID" value="{{$all->orderID}}">
                                                    <input type="hidden" name="userID" value="{{$all->userID}}">
                                                </label>
                                                <button type="submit" class="btn btn-sm btn-primary my-auto">Mark as Delivered</button>
                                            </div>
                                        </form>
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
