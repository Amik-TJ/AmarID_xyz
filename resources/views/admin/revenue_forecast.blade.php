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
                                <h4 class="card-title text-primary">Revenue Forecast</h4>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of Revenues</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders have been placed Yet</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4><span class="font-weight-bold ">Total Revenue </span>  <span id="total_revenue"></span> Tk</h4>
                        <h4><span class="font-weight-bold">Filtered Revenue </span><span id="filter_revenue"></span> Tk</h4>
                    </div>
                </div>
                        <!-- title -->

                    @if($data['found'])
                       <div class="bg-white p-1 shadow" style="border-radius: 0.25rem">
                           <div class="table-responsive">
                               <table class="table v-middle  table-hover" id="my_table">
                                   <thead>
                                   <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                       <th class="border-top-0">Order ID</th>
                                       <th class="border-top-0">Status</th>
                                       <th class="border-top-0">Order Date</th>
                                       <th class="border-top-0">User ID</th>
                                       <th class="border-top-0">Customer Name</th>
                                       <th class="border-top-0">Card Type</th>
                                       <th class="border-top-0">Package ID</th>
                                       <th class="border-top-0">Payment Method</th>
                                       <th class="border-top-0">Tx ID</th>
                                       <th class="border-top-0">Total Amount</th>
                                       <th class="border-top-0">Cash Memo</th>
                                       <th class="border-top-0">Remarks</th>
                                   </tr>
                                   </thead>
                                   <tbody>

                                   @foreach($data['data'] as $all)
                                       <tr>
                                           <td>{{$all->orderID}}</td>
                                           <td>{{$all->status}}</td>
                                           <td>{{(new DateTime($all->order_date))->format("Y-m-d")}}</td>
                                           <td>{{$all->userID}}</td>
                                           <td>{{$all->firstname}} {{$all->lastname}}</td>
                                           <td>
                                               @if($all->hardCopyIncluded)
                                                   Hard ID
                                               @else
                                                   Soft ID
                                               @endif
                                           </td>
                                           <td>{{$all->packageID}}</td>
                                           <td>{{$all->payment_method}}</td>
                                           <td>{{$all->txID}}</td>
                                           <td>{{$all->total_price}}</td>
                                           <td><button class="btn-warning btn-sm">Print</button></td>
                                           <td>No Remarks</td>
                                       </tr>
                                   @endforeach
                                   </tbody>
                                   <tfoot class="mt-2 mb-4">
                                   <tr>
                                       <th colspan="9" class="font-weight-bold" style="text-align:right;">Total:</th>
                                       <th class=""></th>
                                   </tr>
                                   </tfoot>
                               </table>
                           </div>
                       </div>
                    @endif

            </div>
        </div>
    </div>




@endsection

@section('data_table')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/searchbuilder/1.0.1/js/dataTables.searchBuilder.min.js"></script>




    <script>
        $(document).ready(function() {
            $('#my_table').DataTable( {
                dom: 'Qlfrtip',
                searchBuilder: {
                    columns: [1,2,5],
                },
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column( 9 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotal = api
                        .column( 9, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    document.getElementById("total_revenue").innerHTML = ' :    '+total;
                    document.getElementById("filter_revenue").innerHTML = ' :    '+pageTotal;
                    // Update footer
                    $( api.column( 9 ).footer() ).html(
                        '$'+pageTotal
                    );
                }
            } );
        } );
    </script>
@endsection
