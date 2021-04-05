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
                                <h1 class="card-title text-primary mb-4">Assign Print Vendor</h1>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of verification done Orders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Order of status : Verification Done</h5>
                                @endif
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table table-striped zero-configuration">
                                <thead>
                                <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Order ID</th>
                                    <th class="border-top-0">Status</th>
                                    <th class="border-top-0">Package ID</th>
                                    <th class="border-top-0">Package Type</th>
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
                                        <td>{{$all->status}}</td>
                                        <td>{{$all->packageID}}</td>
                                        <td>{{$all->title}}</td>
                                        <td>
                                            {{$all->firstname." ".$all->lastname}}
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
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-primary my-auto" data-toggle="modal" data-target="#vendor_modal" data-order_id="{{$all->orderID}}" >Assign Print Vendor</button>
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






{{--------------------------- Print Vendor Assigning Modal Starts ---------------------------}}
    <div class="modal fade" id="vendor_modal" tabindex="-1" role="dialog" aria-labelledby="vendor_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary font-weight-bold text-center" id="vendor_modalLongTitle">Assign Print Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($data['vendor_found'])
                        <form method="POST" action="/select_print_vendor" >
                            @csrf
                            <input type="hidden" id="m_order_id" name="order_id" value="">
                            <div class="form-group">
                                <label for="vendor_id" class="col-form-label">Vendor Name : </label>
                                <select class="form-control" id="vendor_id" name="vendor_id">
                                    <option value="false">----</option>
                                    @foreach($data['vendor_info'] as $vendor)
                                        <option value="{{$vendor->userID}}">{{$vendor->firstname.' '.$vendor->lastname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-warning">Assign</button>
                            </div>
                        </form>
                    @else
                        <h1 class="text-info">No Vendor Found</h1>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
{{--------------------------- Print Vendor Assigning Modal Ends ---------------------------}}

@endsection

@section('extra_js')
    <script>
        $('#vendor_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var order_id = button.data('order_id')
            console.log(order_id)
            var modal = $(this)


            modal.find('.modal-body #m_order_id').val(order_id)
        })
    </script>
@endsection

@section('data_table')


    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
@endsection
