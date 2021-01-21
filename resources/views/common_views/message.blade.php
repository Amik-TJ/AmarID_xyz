@extends(auth()->user()->admin ||auth()->user()->print_vendor ||auth()->user()->delivery_vendor ?'layouts.admin_layout': 'layouts.user_layout')
@php($message = $data)


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
                                                Messages
                                            </p>
                                        </div>
                                        <div class="text-center">
                                            @if($message['seen_count'] > 0)
                                                <span class="text-success"> {{$message['seen_count'] }} New messages </span>
                                            @else
                                                <span class="text-danger"> No New messages </span>
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



        {{------------------------messages Cards-------------------------------}}
        @if($message['m_found'])
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="custom-media-object-2">
                                @foreach($message['messages']->unique('senderID') as $msg)
                                <div class="media border-bottom-1 p-t-15 mb-2" >
                                    <img class="rounded-circle mr-3" src="{{ $msg->sphoto_url != null ? url('storage'.$msg->sphoto_url):'images/avatar/dummy.png'}}" style="height: 35px; width: 35px">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-lg-7 col-sm-12 mt-1">
                                                <h5 class="{{$msg->seen == 0 ? 'font-weight-bold text-dark':''}}">{{$msg->sfastname.' '.$msg->slastname}}</h5>
                                                <p class="{{$msg->seen == 0 ? 'font-weight-bold text-primary':''}}">
                                                    @if(strlen($msg->message) < 100)
                                                        {{$msg->message}}
                                                    @else
                                                        {{substr($msg->message, 0, 100)}} ...
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-lg-5 col-sm-2 text-right">
                                                <h5 class="text-muted"><i class="color-danger ti-minus m-r-5"></i><span class="BTC m-l-10">{{(new DateTime($msg->time))->format("d-m-Y")}}</span></h5>
                                                <p class="f-s-13 text-muted"><span class="m-l-10">{{(new DateTime($msg->time))->format("h:i A")}}</span></p>
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
        {{------------------------messages Cards Ends-------------------------------}}

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
