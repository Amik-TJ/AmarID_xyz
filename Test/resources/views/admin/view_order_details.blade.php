@extends('layouts.admin_layout')
@section('data_table_bootstrap')
    <link href="/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@php($order = $data['order'])
@php($package = $data['package'])
@section('content')
    <div class="container-fluid px-lg-4">

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col mb-0">
                                <div class="card card-profile text-center mb-0">
                                    <span class="mb-0 text-primary"><i class="icon-credit-card"></i></span>
                                    <p class="text-dark px-2 font-weight-bold">
                                        Order No - {{$order->orderID}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center text-info font-weight-bold">Card Front</h4>
                        <div class="bootstrap-carousel">
                            <div class="carousel slide" data-ride="carousel">
                                <img class="d-block w-100" src="{{url('storage/'.$order->orderUrl.'/front.jpg')}}" alt="Third slide">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{url('storage/'.$order->orderUrl.'/front.jpg')}}" class="btn mb-1 btn-rounded btn-success" download><span class="btn-icon-left"><i class="fa fa-download color-warning"></i> </span>Download</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center text-info font-weight-bold">Card Back</h4>
                        <div class="bootstrap-carousel">
                            <div class="carousel slide" data-ride="carousel">
                                <img class="d-block w-100" src="{{url('storage/'.$order->orderUrl.'/back.jpg')}}" alt="Third slide">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{url('storage/'.$order->orderUrl.'/back.jpg')}}" class="btn mb-1 btn-rounded btn-success" download><span class="btn-icon-left"><i class="fa fa-download color-warning"></i> </span>Download</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title my-3">
                            <h4 class="text-primary">Order Details : </h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Description</th>
                                    <th>Weight</th>
                                    <th>Card Side</th>
                                    <th>Glossy</th>
                                    <th>Spot</th>
                                    <th>Rounded</th>
                                    <th>Texture</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>{{$order->orderID}}</th>
                                        <th>{{$package->description}}</th>
                                        <th>
                                            <span class="badge badge-primary px-2">{{$package->weight}}</span>
                                        </th>
                                        <td>
                                            @if($package->oneSidedCard)
                                                <span class="badge badge-warning px-2">One Sided</span>
                                            @else
                                                <span class="badge badge-info px-2">Both Sided</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->glossy)
                                                <span class="badge badge-success px-2">Yes</span>
                                            @else
                                                <span class="badge badge-danger px-2">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->spot)
                                                <span class="badge badge-success px-2">Yes</span>
                                            @else
                                                <span class="badge badge-danger px-2">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->rounded)
                                                <span class="badge badge-success px-2">Yes</span>
                                            @else
                                                <span class="badge badge-danger px-2">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($package->textureOption)
                                                <span class="badge badge-success px-2">Yes</span>
                                            @else
                                                <span class="badge badge-danger px-2">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
        <!-- Front Items -->
            @if($data['front_array'] != false)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title my-3">
                            <h4 class="text-primary">Front Items : <span class="text-success"> Custom Dragable Text</span></h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Text</th>
                                    <th>x Co ordinate</th>
                                    <th>Y Co ordinate</th>
                                    <th>Font Family</th>
                                    <th>Font Size</th>
                                    <th>Angle</th>
                                    <th>Color</th>
                                    <th>Italic</th>
                                    <th>Bold</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 0; ?>
                                @foreach($data['front_array'] as $front)
                                    @if($front->type == 'cdt')
                                    <tr>
                                        <th>{{++$count}}</th>
                                        <th>{{$front->text}}</th>
                                        <th>{{$front->x}}</th>
                                        <th>{{$front->y}}</th>
                                        <th>{{$front->fontFamily}}</th>
                                        <th>
                                            <span class="badge badge-primary px-2">{{$front->fontSize}}</span>

                                        </th>
                                        <th>{{$front->angle}}</th>
                                        <th>
                                            <span class="badge badge-warning px-2">#{{$front->color}}</span>
                                        </th>
                                        <td>
                                            @if($front->italic)
                                                <span class="badge badge-success px-2">Yes</span>
                                            @else
                                                <span class="badge badge-danger px-2">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($front->bold)
                                                <span class="badge badge-success px-2">Yes</span>
                                            @else
                                                <span class="badge badge-danger px-2">No</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <hr class="gradient-4-shadow">

                    <div class="card-body">
                        <div class="card-title my-3">
                            <h4 class="text-primary">Front Items : <span class="text-success"> Custom Dragable ICON</span></h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>x Co ordinate</th>
                                    <th>Y Co ordinate</th>
                                    <th>Icon Hex</th>
                                    <th>Icon Font</th>
                                    <th>Icon Package</th>
                                    <th>Icon Size</th>
                                    <th>Angle</th>
                                    <th>Color</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 0; ?>
                                @foreach($data['front_array'] as $front)
                                    @if($front->type == 'cdi')
                                        <tr>
                                            <th>{{++$count}}</th>
                                            <th>{{$front->x}}</th>
                                            <th>{{$front->y}}</th>
                                            <th>{{$front->iconHex}}</th>
                                            <th>{{$front->iconFont}}</th>
                                            <th>{{$front->iconPackage}}</th>
                                            <th>
                                                <span class="badge badge-primary px-2">{{$front->iconSize}}</span>

                                            </th>
                                            <th>{{$front->angle}}</th>
                                            <th>
                                                <span class="badge badge-success px-2">#{{$front->color}}</span>
                                            </th>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif


        <!-- Back Items -->
            @if($data['back_array'] != false)
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title my-3">
                                <h4 class="text-primary">Back Items : <span class="text-success"> Custom Dragable Text</span></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Text</th>
                                        <th>x Co ordinate</th>
                                        <th>Y Co ordinate</th>
                                        <th>Font Family</th>
                                        <th>Font Size</th>
                                        <th>Angle</th>
                                        <th>Color</th>
                                        <th>Italic</th>
                                        <th>Bold</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 0; ?>
                                    @foreach($data['back_array'] as $back)
                                        @if($back->type == 'cdt')
                                            <tr>
                                                <th>{{++$count}}</th>
                                                <th>{{$back->text}}</th>
                                                <th>{{$back->x}}</th>
                                                <th>{{$back->y}}</th>
                                                <th>{{$back->fontFamily}}</th>
                                                <th>
                                                    <span class="badge badge-primary px-2">{{$back->fontSize}}</span>

                                                </th>
                                                <th>{{$back->angle}}</th>
                                                <th>
                                                    <span class="badge badge-warning px-2">#{{$back->color}}</span>
                                                </th>
                                                <td>
                                                    @if($back->italic)
                                                        <span class="badge badge-success px-2">Yes</span>
                                                    @else
                                                        <span class="badge badge-danger px-2">No</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($back->bold)
                                                        <span class="badge badge-success px-2">Yes</span>
                                                    @else
                                                        <span class="badge badge-danger px-2">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="card-body">
                            <div class="card-title my-3">
                                <h4 class="text-primary">Back Items : <span class="text-success"> Custom Dragable ICON</span></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>x Co ordinate</th>
                                        <th>Y Co ordinate</th>
                                        <th>Icon Hex</th>
                                        <th>Icon Font</th>
                                        <th>Icon Package</th>
                                        <th>Icon Size</th>
                                        <th>Angle</th>
                                        <th>Color</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 0; ?>
                                    @foreach($data['back_array'] as $back)
                                        @if($back->type == 'cdi')
                                            <tr>
                                                <th>{{++$count}}</th>
                                                <th>{{$back->x}}</th>
                                                <th>{{$back->y}}</th>
                                                <th>{{$back->iconHex}}</th>
                                                <th>{{$back->iconFont}}</th>
                                                <th>{{$back->iconPackage}}</th>
                                                <th>
                                                    <span class="badge badge-primary px-2">{{$back->iconSize}}</span>

                                                </th>
                                                <th>{{$back->angle}}</th>
                                                <th>
                                                    <span class="badge badge-success px-2">#{{$back->color}}</span>
                                                </th>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>




@endsection
@section('data_table')
    <script src="/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
@endsection
