@extends('layouts.admin_layout')

@section('data_table_bootstrap')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.0.1/css/searchBuilder.dataTables.min.css">
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
                        <div class="table-responsive">
                            <table class="table v-middle  table-hover" id="my_table">
                                <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Order ID</th>
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
                                @php
                                $count = 0;
                                @endphp
                                @foreach($data['data'] as $all)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$all->orderID}}</td>
                                    <td>{{$all->status}}</td>
                                    <td>{{$all->userID}}</td>
                                    <td>{{$all->packageID}}</td>
                                    <td>{{$all->title}}</td>
                                    <td>{{$all->placed}}</td>
                                    <td>
                                        @if($all->glossy)
                                            Glossy
                                        @else
                                            Normal
                                        @endif
                                    </td>
                                   {{--@if($all->orderUrl == null)
                                        <td>No Images</td>
                                        <td>No Images</td>
                                    @else--}}
                                        <td>
                                            <img src="{{url('storage/'.$all->orderUrl.'/resize_front.jpg')}}" alt="No Images" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                        <td>
                                            <img src="{{url('storage/'.$all->orderUrl.'/resize_back.jpg')}}" alt="No Images" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                    {{--@endif--}}
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
