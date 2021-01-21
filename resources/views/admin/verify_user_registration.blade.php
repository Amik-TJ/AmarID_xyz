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
                                <h1 class="card-title text-primary">Verify User</h1>
                                @if($data['found'])
                                    <h5 class="card-subtitle text-success">Status : Unverified Users</h5>
                                @else
                                    <h5 class="card-subtitle text-danger">No Users to Verify</h5>
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
                                    <th class="border-top-0">Temporary ID</th>
                                    <th class="border-top-0">Name</th>
                                    <th class="border-top-0">Email</th>
                                    <th class="border-top-0">Phone</th>
                                    <th class="border-top-0">Location</th>
                                    <th class="border-top-0">Acc Type</th>
                                    <th class="border-top-0">Field Type</th>
                                    <th class="border-top-0">Sub Field Type</th>
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
                                        <td>{{$all->userID}}</td>
                                        <td>{{$all->firstname.' '.$all->lastname}}</td>
                                        <td>{{$all->email}}</td>
                                        <td>{{$all->phone}}</td>
                                        <td>{{$all->location}}</td>
                                        <td>{{$all->acc_type}} - <span class="text-primary">{{$all->accTypeID}}</span></td>
                                        <td>{{$all->field_type}} - <span class="text-primary">{{$all->fieldID}}</span></td>
                                        <td>{{$all->sub_type}} - <span class="text-primary">{{$all->subFieldID}}</span></td>
                                        <td>
                                            <form action="/verify_user_registration" method="post">
                                                @csrf
                                                <div class="form-row">
                                                    <label>
                                                        <input type="hidden" name="user_id" value="{{$all->userID}}">
                                                    </label>
                                                    <button type="submit" class="btn btn-sm btn-warning">Verify</button>
                                                </div>
                                            </form>
                                        </td>
                                        {{--<td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view_more_modal" data-order_id="{{$data->orderID}}" data-user_id="{{$data->userID}}"  data-payment_id="{{$data->paymentID}}" data-package_id="{{$data->packageID}}" data-order_date="{{$data->placed}}" data-total_price="{{$data->total_price}}" data-title="{{$data->title}}" data-hard_copy_included="{{$data->hardCopyIncluded}}" data-one_sided_card="{{$data->oneSidedCard}}" data-rounded_option="{{$data->roundedOption}}" data-spot_option="{{$data->spotOption}}" data-status="{{$data->status}}" data-texture_option="{{$data->textureOption}}" data-discount="{{$data->discount}}" data-tx_id="{{$data->txID}}" data-payment_option_name="{{$payment_option_name}}" >
                                                View More
                                            </button>
                                        </td>--}}

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





  {{--  --}}{{--------------------------------View More Details Modal Starts---------------------------}}{{--

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
                        --}}{{--<tr>
                            <td class="text-primary font-weight-bold">Order Date</td>
                            <td id="m_order_date"></td>
                        </tr>--}}{{--
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



    --}}{{--------------------------------View More Details Modal Starts---------------------------}}{{--













    --}}{{-------------------------More Money Modal Starts----------------------}}{{--
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
    --}}{{-------------------------More Money Modal Ends----------------------}}{{--


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
    </script>--}}
@endsection
