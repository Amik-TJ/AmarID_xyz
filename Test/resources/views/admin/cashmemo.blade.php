
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/logo1.png" rel="icon" />
    <title>Order ID - {{$data->orderID}} || AmarID.xyz - Next Generation Business Card Solution</title>

    <!-- Web Fonts
    ======================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

    <!-- Stylesheet
    ======================= -->
    <link rel="stylesheet" type="text/css" href="css/cashmemo/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/cashmemo/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/cashmemo/stylesheet.css"/>

    <script src="js/pdf.js"></script>
    <script src="js/html2pdf.bundle.js"></script>
</head>
<body>
<!-- Container -->
<div class="container-fluid invoice-container" id="invoice">
    <!-- Header -->

        <div class="row align-items-center">
            <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0"> <img id="logo" src="images/navbar_icon.png" title="Koice" alt="Invoice" style="height: 60px; width: 200px"/> </div>
            <div class="col-sm-5 text-center text-sm-right">
                <h4 class="mb-0">Invoice</h4>
                <p class="mb-0">Order Number - {{sprintf("%04d", $data->orderID)}}</p>
            </div>
        </div>
        <hr>

    <!-- Main Content -->

        <div class="row">
            <div class="col-sm-6 text-sm-right order-sm-1"> <strong>Pay To:</strong>
                <address>
                    AmarID.xyz<br />
                    Address: Plot#485A, Road#7,<br/>
                    Avenue#6, Dhaka, 1216<br/>
                    Phone : 01312123848
                </address>
            </div>
            <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                <address>
                    {{$data->firstname.' '.$data->lastname}}<br />
                    {{$data->label}}<br/>
                    {{$data->address}}<br/>
                    Phone : {{$data->delivery_phone}}
                </address>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"> <strong>Payment Method:</strong><br>
                <span> {{$data->payment_method}} </span> <br />
                <br />
            </div>
            <div class="col-sm-6 text-sm-right"> <strong>Order Date:</strong><br>
                <span> {{(new DateTime($data->order_date))->format("d-m-Y")}}<br>
                    {{(new DateTime($data->order_date))->format("h:i A")}}<br>

        <br>
        </span> </div>
        </div>
        <div class="card">
            <div class="card-header"> <span class="font-weight-600 text-4">Order Summary</span> </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <td class="col-8 border-top-0"><strong>Description</strong></td>
                            <td class="col-2 text-center border-top-0"><strong>Package</strong></td>
                            <td class="col-2 text-right border-top-0"><strong>Amount</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="text-3">{{$data->description}}</span></td>
                            <td class="text-center">{{$data->package_title}}</td>
                            <td class="text-right">৳  {{$data->package_price}}</td>
                        </tr>
                        <tr>
                            <td>Delivery Charge: </td>
                            <td class="text-center">+</td>
                            <td class="text-right">+৳  60</td>
                        </tr>
                        <tr>
                            <td>Promotional Discount: </td>
                            <td class="text-center">-</td>
                            <td class="text-right">-৳  {{$data->discount}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="bg-light-2 text-right"><strong>Sub Total</strong></td>
                            <td class="bg-light-2 text-right">৳  {{$data->total_price}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="bg-light-2 text-right"><strong>Tax</strong></td>
                            <td class="bg-light-2 text-right">৳  00</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="bg-light-2 text-right"><strong>Total</strong></td>
                            <td class="bg-light-2 text-right text-danger">৳  {{$data->total_price}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="text-center"><strong>Transaction Date</strong></td>
                    <td class="text-center"><strong>Payment Status</strong></td>
                    <td class="text-center"><strong>Transaction ID</strong></td>
                    <td class="text-center"><strong>Paid</strong></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">{{(new DateTime($data->payment_time))->format("d-m-Y || h:i A")}}</td>
                    <td class="text-center">{{$data->payment_status}}</td>
                    <td class="text-center">{{$data->txID}}</td>
                    <td class="text-center text-primary">৳  {{$data->amount_received}} BDT</td>
                </tr>
                </tbody>
            </table>
        </div>

    <!-- Footer -->
    <div class="text-center">
        <p class="text-1"><strong>NOTE :</strong> This is computer generated receipt and does not require physical signature.</p>
        {{--<div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-primary border text-white shadow-none"><i class="fa fa-print" aria-hidden="true"></i> Print</a> <a href="{{ url('download_order_invoice/'.$data->orderID) }}" class="btn btn-warning border text-white shadow-none"><i class="fa fa-download"></i> Download</a> </div>--}}

    </div>
</div>
<div class="col text-center btn-group d-print-none "> <a href="javascript:window.print()" class="btn btn-primary border text-white shadow-none"><i class="fa fa-print" aria-hidden="true"></i> Print</a> <button class="btn btn-warning border text-white shadow-none" id="download"><i class="fa fa-download"></i> Download</button> </div>
<!-- Back to My Account Link -->
<p class="text-center d-print-none"><a href="/revenue_forecast">&laquo; Back to Revenue Forecast</a></p>
</body>
</html>
