@extends('layouts.admin_layout')

@section('custom_style')
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
                                <h1 class="card-title text-primary">Overview of All Users</h1>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Total User : <span class="text-info">{{$data['user_count']}}</span></h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Users has been registered</h5>
                                @endif
                            </div>
                        </div>
                        <!-- title -->
                    </div>
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table table-striped zero-configuration">
                                <thead>
                                <tr class="bg-info text-white font-weight-bold">
                                    <th class="border-top-0">User</th>
                                    <th class="border-top-0">User ID</th>
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">Phone</th>
                                    <th class="border-top-0">Location</th>
                                    <th class="border-top-0">Acc Type</th>
                                    <th class="border-top-0">Field Type</th>
                                    <th class="border-top-0">Sub Field Type</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($data['data'] as $all)
                                    <tr>
                                        <td><img src="{{ $all->photo_url != null ? url('storage'.$all->photo_url):'/images/avatar/avatar.png'}}" class=" rounded-circle mr-3" alt="" style="height: 40px; width: 40px">{{$all->firstname.' '.$all->lastname}}</td>
                                        <td>{{$all->userID}}</td>
                                        <td>{{$all->email}}</td>
                                        <td>{{$all->phone}}</td>
                                        <td>{{$all->location}}</td>
                                        <td>{{$all->acc_type}} - <span class="text-primary">{{$all->accTypeID}}</span></td>
                                        <td>{{$all->field_type}} - <span class="text-primary">{{$all->fieldID}}</span></td>
                                        <td>{{$all->sub_type}} - <span class="text-primary">{{$all->subFieldID}}</span></td>
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


@section('extra_js')
    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
@endsection
