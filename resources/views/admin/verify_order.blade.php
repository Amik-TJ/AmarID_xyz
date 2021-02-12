@extends('layouts.admin_layout')
@section('data_table_bootstrap')
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
                                <h4 class="card-title text-primary">On Verify Orders</h4>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Overview of On Verify Orders</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Orders for Verification</h5>
                                @endif
                            </div>

                        </div>
                        <!-- title -->
                    </div>
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table v-middle  table-hover">
                                <thead>
                                <tr class="text-white font-weight-bold" style="background: linear-gradient(to right, #ec2F4B, #009FFF);">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Order ID</th>
                                    <th class="border-top-0">User ID</th>
                                    <th class="border-top-0">Order Date</th>
                                    <th class="border-top-0">Card Type</th>
                                    <th class="border-top-0"># of Soft Copies</th>
                                    <th class="border-top-0">Card Front</th>
                                    <th class="border-top-0">Card Back</th>
                                    <th class="border-top-0">Amount to be paid</th>
                                    <th class="border-top-0">TX ID</th>
                                    <th class="border-top-0">Transaction Option</th>
                                    <th class="border-top-0">Enter Amount and Verify</th>
                                    <th class="border-top-0">View More</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                  $count = 0;
                                @endphp

                                @foreach($data['order_details'] as $order)

                                    @php
                                        foreach ($data['options'] as $option) {
                                            if ($option->optionID == $order->optionID) {
                                                $payment_option_name = $option->name;
                                                $payment_option_logo_url = $option->logoUrl;
                                                $payment_option_instructions = $option->instructions;
                                                break;
                                            }
                                        }
                                    @endphp
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$order->orderID}}</td>
                                    <td>{{$order->userID}}</td>
                                    <td>{{$order->placed}}</td>
                                    <td>
                                        @if($order->glossy)
                                            Glossy
                                        @else
                                            Normal
                                        @endif
                                    </td>
                                    @if($order->noOfSoftID == null)
                                        <td>No Soft Copies</td>
                                    @else
                                        <td>{{$order->noOfSoftID}}</td>
                                    @endif
                                    @if($order->orderUrl == null)
                                        <td>No Images</td>
                                        <td>No Images</td>
                                    @else
                                        <td>
                                            <img src="{{url('storage/'.$order->orderUrl.'/front.jpg')}}" alt="No Image" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                        <td>
                                            <img src="{{url('storage/'.$order->orderUrl.'/back.jpg')}}" alt="No Image" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                    @endif
                                    <td>
                                        @if($order->total_price == null)
                                            0
                                        @else
                                            {{$order->total_price}}
                                        @endif
                                    </td>
                                    <td>{{$order->txID}}</td>
                                    <td>{{$payment_option_name}}</td>
                                    <td>
                                        <form action="/price_verify" method="post">
                                            @csrf
                                            <div class="form-row">
                                                <label>
                                                    <input type="number" name="amount" class="form-control" required>
                                                    <input type="hidden" name="by_pass" value="0">
                                                    <input type="hidden" name="userID" value="{{$order->userID}}">
                                                    <input type="hidden" name="packageID" value="{{$order->packageID}}">
                                                    <input type="hidden" name="orderID" value="{{$order->orderID}}">
                                                    <input type="hidden" name="paymentID" value="{{$order->paymentID}}">
                                                    <input type="hidden" name="hardCopyIncluded" value="{{$order->hardCopyIncluded}}">
                                                </label>
                                                <button type="submit" class="btn btn-sm btn-success">Verify</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view_more_modal" data-order_id="{{$order->orderID}}" data-user_id="{{$order->userID}}"  data-payment_id="{{$order->paymentID}}" data-package_id="{{$order->packageID}}" data-order_date="{{$order->placed}}" data-total_price="{{$order->total_price}}" data-title="{{$order->title}}" data-hard_copy_included="{{$order->hardCopyIncluded}}" data-one_sided_card="{{$order->oneSidedCard}}" data-rounded_option="{{$order->roundedOption}}" data-spot_option="{{$order->spotOption}}" data-status="{{$order->status}}" data-texture_option="{{$order->textureOption}}" data-discount="{{$order->discount}}" data-tx_id="{{$order->txID}}" data-payment_option_name="{{$payment_option_name}}" >
                                            View More
                                        </button>
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





{{--------------------------------View More Details Modal Starts---------------------------}}

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="view_more_modal" tabindex="-1" role="dialog" aria-labelledby="view_more_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-centers text-secondary font-weight-bold" id="view_more_modal_title">Order No<span id="m_order_id"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <table>
                    <tbody>

                        <tr>
                            <td class="text-primary font-weight-bold">User ID</td>
                            <td id="m_user_id"></td>
                        </tr>
                        {{--<tr>
                            <td class="text-primary font-weight-bold">Order Date</td>
                            <td id="m_order_date"></td>
                        </tr>--}}
                        <tr>
                            <td class="text-primary font-weight-bold">Payment ID</td>
                            <td id="m_payment_id"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Package Id</td>
                            <td id="m_package_id"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Package Type</td>
                            <td id="m_package_type"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Round Option</td>
                            <td id="m_round_option"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Spot Option</td>
                            <td id="m_spot_option"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Current Status</td>
                            <td id="m_status"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Amount to be Paid</td>
                            <td id="m_amount"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Transaction Option</td>
                            <td id="m_payment_option_name"></td>
                        </tr>
                        <tr>
                            <td class="text-primary font-weight-bold">Transaction ID</td>
                            <td id="m_tx_id"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



{{--------------------------------View More Details Modal Starts---------------------------}}













{{-------------------------More Money Modal Starts----------------------}}
    <!-- Button trigger modal -->
    @if($data['excess_amount'] == true)
    <!-- Modal -->
    <div class="modal fade" id="more_money_modal" tabindex="-1" role="dialog" aria-labelledby="more_money_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-warning" id="more_money_modalTitle">Warning !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    You have entered More amount than the actual price !
                    Do you want to further proceed ? <br>
                    <span class="text-primary">Order no : </span>  {{$data['order_id']}} <br>
                    <span class="text-primary">User ID : </span> {{$data['user_id']}} <br>
                    <span class="text-primary">Actual Amount : </span> {{$data['actual_amount']}} <br>
                    <span class="text-primary">Entered Amount : </span> {{$data['entered_amount']}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <form action="/price_verify" method="post">
                        @csrf
                        <input type="hidden" name="by_pass" value="1">
                        <input type="hidden" name="userID" value="{{$data['user_id']}}">
                        <input type="hidden" name="amount" value="{{$data['entered_amount']}}">
                        <input type="hidden" name="packageID" value="{{$data['package_id']}}">
                        <input type="hidden" name="orderID" value="{{$data['order_id']}}">
                        <input type="hidden" name="paymentID" value="{{$data['payment_id']}}">
                        <input type="hidden" name="hardCopyIncluded" value="{{$data['hard_copy_included']}}">
                        <button type="submit" class="btn btn-danger">Proceed</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endif
{{-------------------------More Money Modal Ends----------------------}}


@endsection


@section('excess_amount_verify')
    @if($data['excess_amount'] == true)
        <script type="text/javascript">
            $(window).on('load', function () {
                $('#more_money_modal').modal('show');
            });
        </script>
    @endif
@endsection

@section('extra_js')
    <script>
        $('#view_more_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var order_id = button.data('order_id')
            var user_id = button.data('user_id')
            //var order_date = button.data('placed')
            var payment_id = button.data('payment_id')
            var package_id = button.data('package_id')
            var amount = button.data('total_price')
            var package_title = button.data('title')
            var hard_copy_included = button.data('hard_copy_included')
            var one_sided_card = button.data('one_sided_card')
            var rounded_option = button.data('rounded_option')
            var texture_option = button.data('texture_option')
            var spot_option = button.data('spot_option')
            var discount = button.data('discount')
            var status = button.data('status')
            var tx_id = button.data('tx_id')
            var payment_option_name = button.data('payment_option_name')


            if(rounded_option == '1'){
                rounded_option = 'Yes'
            }else{
                rounded_option = 'No'
            }
            if(spot_option == '1'){
                spot_option = 'Yes'
            }else{
                spot_option = 'No'
            }
            console.log(amount)
            if(amount == '') {
                amount = '0/-'
            }
            var modal = $(this)




            document.getElementById("m_order_id").innerHTML = ' :    '+order_id;
            document.getElementById("m_user_id").innerHTML = ' :    '+user_id;
            //document.getElementById("m_order_date").innerHTML = ' :    '+order_date;
            document.getElementById("m_payment_id").innerHTML = ' :    '+payment_id;
            document.getElementById("m_package_id").innerHTML = ' :    '+package_id;
            document.getElementById("m_package_type").innerHTML = ' :    '+package_title;
            document.getElementById("m_round_option").innerHTML = ' :    '+rounded_option;
            document.getElementById("m_spot_option").innerHTML = ' :    '+spot_option;
            document.getElementById("m_status").innerHTML = ' :    '+status;
            document.getElementById("m_amount").innerHTML = ' :    '+amount;
            document.getElementById("m_payment_option_name").innerHTML = ' :    '+payment_option_name;
            document.getElementById("m_tx_id").innerHTML = ' :    '+tx_id;
        })
    </script>
@endsection

@section('data_table')
    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
@endsection
