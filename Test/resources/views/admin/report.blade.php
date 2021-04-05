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
                                <h4 class="card-title text-primary">All Reports</h4>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of All Reports</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Reports have been created Yet</h5>
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
                                    <th class="border-top-0">Report ID</th>
                                    <th class="border-top-0">Reported By</th>
                                    <th class="border-top-0">By ID</th>
                                    <th class="border-top-0">Reported For</th>
                                    <th class="border-top-0">For ID</th>
                                    <th class="border-top-0">Report Message</th>
                                    <th class="border-top-0">Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $count = 0;
                                @endphp
                                @foreach($data['data'] as $all)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$all->reportID}}</td>
                                    <td>{{$all->byfirstname.' '.$all->bylastname}}</td>
                                    <td>{{$all->byID}}</td>
                                    <td>{{$all->forfirstname.' '.$all->forlastname}}</td>
                                    <td>{{$all->forID}}</td>
                                    <td>{{$all->message}}</td>
                                    <td>{{$all->time}}</td>
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


