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


                        <!-- title -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h2 class="text-primary mb-3 font-weight-bold">On Processing Orders</h2>
                                        @if($data['found'])
                                            <h5 class="text-success mb-5 font-weight-bold">Status : Print Vendor Assigned || Processing || Print Done</h5>
                                        @else
                                            <h5 class="text-danger mb-5">No Orders are being Processed/On Printing Yet</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- title -->

                    @if($data['found'])
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table table-hover" id="on_print_table" style="width:100%">
                                        <thead>
                                        <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                            <th class="border-top-0">Order ID</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Package ID</th>
                                            <th class="border-top-0">Customer Name</th>
                                            <th class="border-top-0">Order Date</th>
                                            <th class="border-top-0">Card Front</th>
                                            <th class="border-top-0">Card Back</th>
                                            <th class="border-top-0">Change</th>
                                            <th class="border-top-0">Action</th>
                                            <th class="border-top-0">Card Details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data['data'] as $all)
                                            <tr>
                                                <td>{{$all->orderID}}</td>
                                                <td>{{$all->status}}</td>
                                                <td>{{(new DateTime($all->placed))->format("d-m-Y h:i A")}}</td>
                                                <td>
                                                    <span class="m-b-0 font-16">{{$all->firstname." ".$all->lastname}}</span>
                                                </td>
                                                <td>{{$all->placed}}</td>
                                                {{--<td>
                                                    @if($all->glossy)
                                                        Glossy
                                                    @else
                                                        Normal
                                                    @endif
                                                </td>--}}
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
                                                <form action="/print_change_status" method="post">
                                                    @csrf
                                                    <input type="hidden" name="orderID" value="{{$all->orderID}}">
                                                    <input type="hidden" name="userID" value="{{$all->userID}}">
                                                    <td>
                                                        <div class="my-1">
                                                            <select class="form-control form-control-sm" name="change_status" id="inlineFormCustomSelect">
                                                                <option selected>Choose...</option>
                                                                @if($all->status == 'Print Vendor Assigned')
                                                                    <option value="Processing">Processing</option>
                                                                @elseif($all->status == 'Processing')
                                                                    <option value="Print Done">Print Done</option>
                                                                @elseif($all->status == 'Print Done' && auth()->user()->admin)
                                                                    <option value="Print Complete and Received">Print Complete and Received</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="my-1">
                                                            <button type="submit" class="btn btn-sm btn-warning">Change</button>
                                                        </div>
                                                    </td>
                                                </form>
                                                <td>
                                                    <form action="/view_order_details" method="Post">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{$all->orderID}}">
                                                        <button type="submit" class="btn btn-sm btn-primary">View</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

        </div>
    </div>




@endsection


@section('data_table')


    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#on_print_table').DataTable( {
                initComplete: function () {
                    this.api().columns([1]).every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.header()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
        } );
    </script>
@endsection
