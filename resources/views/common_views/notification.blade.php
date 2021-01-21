@extends(auth()->user()->admin ||auth()->user()->print_vendor ||auth()->user()->delivery_vendor ?'layouts.admin_layout': 'layouts.user_layout')

@php($notification = $data)

@section('content')
    <div class="container-fluid px-lg-4">

        {{-------------------Profile Info----------------}}
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="card card-profile text-center">
                                            <span class="mb-1 text-primary"><i class="icon-globe"></i></span>
                                            <p class="text-dark px-4 font-weight-bold">
                                                Notification
                                            </p>
                                        </div>
                                        <div class="text-center">
                                            @if($notification['seen_count'] > 0)
                                                <span class="text-success"> {{$notification['seen_count'] }} New Notifications </span>
                                            @else
                                                <span class="text-danger"> No New Notifications </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{------------------------Notifications Cards-------------------------------}}
        @if($notification['n_found'])
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-media-object-1">

                                @foreach($notification['notifications'] as $not)
                                    <div class="media border-bottom-1 mb-2 p-t-15">
                                        @if($not->type == 1)
                                            <i class="align-self-start mr-3 cc BTC f-s-30"></i>
                                        @elseif($not->type == 2)
                                            <i class="align-self-start mr-3 cc XAI f-s-30"></i>
                                        @elseif($not->type == 3)
                                            <i class="align-self-start mr-3 cc FC2 f-s-30"></i>
                                        @elseif($not->type == 4)
                                            <i class="align-self-start mr-3 cc BC f-s-30"></i>
                                        @elseif($not->type == 5)
                                            <i class="align-self-start mr-3 cc NEO f-s-30"></i>
                                        @elseif($not->type == 6)
                                            <i class="align-self-start mr-3 cc ADC f-s-30"></i>
                                        @elseif($not->type == 7)
                                            <i class="align-self-start mr-3 cc GDC f-s-30"></i>
                                        @else($not->type == 8)
                                            <i class="align-self-start mr-3 cc GAME f-s-30"></i>
                                        @endif
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-lg-7 col-sm-12 mt-1">
                                                    @if($not->seen)
                                                        <h5 class="font-weight-bold text-primary-50">{{$not->message}}</h5>
                                                    @else
                                                        <h5 class="">{{$not->message}}</h5>
                                                    @endif
                                                </div>
                                                <div class="col-lg-5 col-sm-2 text-right">
                                                    <h5 class="text-muted"><i class="color-danger ti-minus m-r-5"></i><span class="BTC m-l-10">{{(new DateTime($not->time))->format("d-m-Y")}}</span></h5>
                                                    <p class="f-s-13 text-muted"><span class="m-l-10">{{(new DateTime($not->time))->format("h:i A")}}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{------------------------Notifications Cards Ends-------------------------------}}

    </div>
@endsection



@section('extra_js')
    <!-- Chartjs -->
    <script src="/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="/plugins/d3v3/index.js"></script>
    <script src="/plugins/topojson/topojson.min.js"></script>
    <script src="/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="/plugins/raphael/raphael.min.js"></script>
    <script src="/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="/plugins/chartist/js/chartist.min.js"></script>
    <script src="/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>



    <script src="/js/dashboard/dashboard-1.js"></script>
@endsection
