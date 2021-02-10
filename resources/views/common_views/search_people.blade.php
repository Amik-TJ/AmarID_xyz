@extends(auth()->user()->admin ||auth()->user()->print_vendor ||auth()->user()->delivery_vendor ?'layouts.admin_layout': 'layouts.user_layout')

@php($people = $data)

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
                                                Search Results
                                        </p>
                                        <div class="text-center">
                                            <span class="h5 text-success font-weight-bold">{{count($people)}} People Found</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{------------------------Search Results-------------------------------}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="custom-media-object-1">
                        @foreach($people as $p)
                                @if($p->userID != auth()->user()->userID)
                                <div class="media p-t-15 mb-2" >
                                    <img class="rounded-circle mr-3" src="{{ $p->photo_url != null ? url('storage'.$p->photo_url):'images/avatar/dummy.png'}}" style="height: 35px; width: 35px">
                                    <div class="media-body">
                                        <div class="row">
                                            <div class="col-lg-7 col-sm-12 mt-1">
                                                <h5 class="font-weight-bold text-dark">{{$p->firstname.' '.$p->lastname}}</h5>
                                            </div>
                                            <div class="col-lg-5 col-sm-2 text-right">


                                                <button type="button" class="btn btn-sm btn-facebook" data-toggle="modal" data-target="#send_message_modal" data-other_id="{{$p->userID}}" data-firstname="{{$p->firstname}}" data-lastname="{{$p->lastname}}">
                                                    Send Message
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{------------------------Notifications Cards Ends-------------------------------}}

</div>





    {{--Modal Starts--}}
<div class="modal fade" id="send_message_modal" tabindex="-1" role="dialog" aria-labelledby="send_message_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Send Message to : <span id="receiver_name" class="text-purple"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="/send_message">
                    @csrf
                    <input type="hidden" name="sender_id" value="{{auth()->user()->userID}}">
                    <input type="hidden" name="receiver_id" id="receiver_id" value="">
                    <div class="form-group">
                        <label>Message:</label>
                        <textarea class="form-control h-150px" rows="6" id="comment" name="msg_txt"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-facebook">Send</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection



@section('extra_js')


    <script>
        $('#send_message_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var other_id = button.data('other_id')
            var first_name = button.data('firstname')
            var last_name = button.data('lastname')
            var modal = $(this)
            console.log(other_id);
            modal.find('.modal-body #receiver_id').val(other_id)

            /*if(last_name != null)*/
            first_name = first_name + ' ' + last_name;
            $("#receiver_name").text(first_name);

        })
    </script>





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
