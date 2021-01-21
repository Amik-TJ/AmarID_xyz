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
                                <h1 class="card-title text-primary">Your ALl Orders</h1>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of All Oders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders against you</h5>
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
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Order Date</th>
                                    <th class="border-top-0">Package ID</th>
                                    <th class="border-top-0">Package Type</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Card Type</th>
                                    <th class="border-top-0">Card Front</th>
                                    <th class="border-top-0">Card Back</th>
                                    <th class="border-top-0">View More</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp

                                @foreach($data['data'] as $order)
                                    <tr>
                                        <td>{{++$count}}</td>
                                        <td>{{$order->orderID}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->placed}}</td>
                                        <td>{{$order->packageID}}</td>
                                        <td>{{$order->title}}</td>
                                        <td>{{$order->firstname.' '.$order->lastname}}</td>
                                        <td>
                                            @if($order->glossy)
                                                Glossy
                                            @else
                                                Normal
                                            @endif
                                        </td>
                                        @if($order->orderUrl == null)
                                            <td>No Images</td>
                                            <td>No Images</td>
                                        @else
                                            <td>
                                                <img src="{{url('storage/'.$order->orderUrl.'/front.jpg')}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                            </td>
                                            <td>
                                                <img src="{{url('storage/'.$order->orderUrl.'/back.jpg')}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                            </td>
                                        @endif
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view_more_modal" data-order_id="{{$order->orderID}}"   data-package_id="{{$order->packageID}}" data-title="{{$order->title}} "data-order_date="{{$order->placed}}"  data-status="{{$order->status}}">
                                                View More
                                            </button>
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





    {{--------------------------------View More Details Modal Starts---------------------------}}

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="view_more_modal" tabindex="-1" role="dialog" aria-labelledby="view_more_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-centers text-secondary font-weight-bold" id="view_more_modal_title">Order No<span id="m_order_id"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table>
                        <tbody>
                        {{--<tr>
                            <td class="text-primary font-weight-bold">Order Date</td>
                            <td id="m_order_date"></td>
                        </tr>--}}

                        <tr>
                            <td class="text-primary font-weight-bold">Package Id</td>
                            <td id="m_package_id"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Package Type</td>
                            <td id="m_package_type"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Order Status</td>
                            <td id="m_status"></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    {{--------------------------------View More Details Modal Starts---------------------------}}















@endsection

@section('extra_js')
    <script>
        $('#view_more_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var order_id = button.data('order_id')
            //var order_date = button.data('placed')
            var package_id = button.data('package_id')
            var package_title = button.data('title')
            var status = button.data('status')
            var payment_option_name = button.data('payment_option_name')



            var modal = $(this)




            document.getElementById("m_order_id").innerHTML = ' :    '+order_id;
            //document.getElementById("m_order_date").innerHTML = ' :    '+order_date;
            document.getElementById("m_package_id").innerHTML = ' :    '+package_id;
            document.getElementById("m_package_type").innerHTML = ' :    '+package_title;
            document.getElementById("m_status").innerHTML = ' :    '+status;
        })
    </script>
@endsection
