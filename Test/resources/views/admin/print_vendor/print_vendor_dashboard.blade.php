@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        {{-------------------Profile Info----------------}}
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-primary"><i class="icon-people"></i></span>
                                            <p class="text-dark px-4 font-weight-bold">
                                                    Print Vendor
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="{{ auth()->user()->photo_url != null ? url('storage'.auth()->user()->photo_url):'images/avatar/dummy.png'}}" width="80" height="80" alt="">
                                    <div class="media-body">
                                        <h3 class="mb-0">{{auth()->user()->firstname.' '.auth()->user()->lastname}}</h3>
                                        <p class="text-muted mb-0">
                                            Print Vendor
                                        </p>
                                    </div>
                                </div>
                                <button class="btn btn-danger my-3">Account Information</button>
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-4">Mobile</strong> <span>{{auth()->user()->phone}}</span></li>
                                    <li><strong class="text-dark mr-4">Email</strong> <span>{{auth()->user()->email}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{------------------------Dashboard Cards-------------------------------}}
        <div class="row mb-5">
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-1 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Jobs</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$data['total_print_job']}}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-2 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Pending Jobs</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$data['job_received']}}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-3 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Running Jobs</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$data['processing']}}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-1">
                <div class="card gradient-4 h-100">
                    <div class="card-body">
                        <h3 class="card-title text-white">Completed Orders</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{$data['print_complete']}}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                    </div>
                </div>
            </div>
        </div>
        {{------------------------Dashboard Cards Ends-------------------------------}}
    </div>







@endsection

@section('extra_js')

@endsection
