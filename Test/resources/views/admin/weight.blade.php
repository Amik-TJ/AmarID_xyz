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
                                <h4 class="card-title text-primary">All Weights</h4>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of All Weights</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Weights have been created Yet</h5>
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
                                    <th class="border-top-0">Weights ID</th>
                                    <th class="border-top-0">Weights Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $count = 0;
                                @endphp
                                @foreach($data['data'] as $all)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$all->weightID}}</td>
                                    <td>{{$all->weightName}}</td>
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


