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
                                <h4 class="card-title text-primary">All Orders</h4>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of All Orders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders have been placed Yet</h5>
                                @endif
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    @if($data['found'])
                        <div class="table-responsive mb-5">
                            <table class="table v-middle  table-hover" id="my_table">
                                <thead>
                                <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                    <th class="border-top-0">Order ID</th>
                                    <th class="border-top-0">Customer Name</th>
                                    <th class="border-top-0">Order Status</th>
                                    <th class="border-top-0">User ID</th>
                                    <th class="border-top-0">Package ID</th>
                                    <th class="border-top-0">Package Type</th>
                                    <th class="border-top-0">Order Date</th>
                                    <th class="border-top-0">Card Type</th>
                                    <th class="border-top-0">Card Front</th>
                                    <th class="border-top-0">Card Back</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data['data'] as $all)
                                <tr>
                                    <td>{{$all->orderID}}</td>
                                    <td>{{$all->firstname.' '.$all->lastname}}</td>
                                    <td>{{$all->status}}</td>
                                    <td>{{$all->userID}}</td>
                                    <td>{{$all->packageID}}</td>
                                    <td>{{$all->title}}</td>
                                    <td>{{(new DateTime($all->placed))->format("d-m-Y h:i A")}}</td>
                                    <td>
                                        @if($all->glossy)
                                            Glossy
                                        @else
                                            Normal
                                        @endif
                                    </td>
                                        <td>
                                            <img src="{{url('storage/'.$all->orderUrl.'/front.jpg')}}" alt="No Images" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                        <td>
                                            <img src="{{url('storage/'.$all->orderUrl.'/back.jpg')}}" alt="No Images" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
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




@endsection


@section('data_table')


    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#my_table').DataTable();
        } );
    </script>
@endsection
