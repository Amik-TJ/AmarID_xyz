@extends('layouts.app')
{{--------------------------------Loading Custom CSS-------------------------------}}
@section('custom_css')
    <style>
        body{font-family:Comfortaa;}
        img.a {
            vertical-align: baseline;
        }
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endsection
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-6 col-sm-12 mb-3">
            <div class="card h-100 w-100 d-inline-block"
                 style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); ">
                <h1 class=" mt-4 text-justify text-center font-weight-bold display h4">Search On-Demand Services/Freelancer</h1>
                <div class="card-body">
                    <form id="search_form" method="post" action="/search">
                        @csrf
                        <input type="hidden" name="icon_keyword" id="search_from_icon" value="false">
                        <div class="form-group">
                            <div class="d-flex">
                                <input type="text" class="form-control rounded-pill border-dark font-weight-bold"
                                       placeholder="&#xf002; Find everyday service e.g. AC,TV" id="keyword"
                                       name="keyword" style="font-family:Comfortaa, FontAwesome">
                                <span class="pl-3 my-auto">
                                    <i class="fas fa-sort-amount-up fa-2x"></i>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="form-group">
                                    <select class="form-control rounded-pill text-primary font-weight-bold" id="city"
                                            name="city">
                                        <option value="dhaka">Dhaka</option>
                                        <option value="dhaka">Chittagong</option>
                                        <option value="dhaka">Khulna</option>
                                        <option value="dhaka">Barishal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select class="form-control rounded-pill text-primary font-weight-bold" id="area"
                                            name="area">
                                        <option value="dhaka">Mirpur DOHS</option>
                                        <option value="dhaka">Kalsi</option>
                                        <option value="dhaka">Cantonment</option>
                                        <option value="dhaka">Matikata</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <button type="submit" class="btn btn-danger rounded-pill btn-md mt-3" name="search_submit">
                                Search
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col my-auto">
                            <a href="" onclick="search_function('cleaning');return false;"><img src="images/search/cleaning.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('appliance_repair');return false;"> <img src="images/search/appliance_repair.jpg" class="img-fluid"  alt=""></a>

                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('electric');return false;"> <img src="images/search/electric.jpg" class="img-fluid" ></a>
                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('groceries');return false;">  <img src="images/search/groceries.jpg" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col my-auto">
                            <a href=""  onclick="search_function('paint');return false;"> <img src="images/search/paint.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('beauty');return false;"><img src="images/search/beauty.jpg" class="img-fluid"  alt=""></a>
                        </div>
                        <div class="col my-auto">
                            <a href=""  onclick="search_function('gadget');return false;"><img src="images/search/gadget.jpg" class="img-fluid" ></a>
                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('car');return false;"><img src="images/search/car.jpg" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col my-auto">
                            <a href="" onclick="search_function('delivery');return false;"><img src="images/search/delivery.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('education');return false;"><img src="images/search/education.jpg" class="img-fluid"  alt=""></a>
                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('Photography');return false;"><img src="images/search/photography.jpg" class="img-fluid" ></a>
                        </div>
                        <div class="col my-auto">
                            <a href="" onclick="search_function('Bike Care');return false;"><img src="images/search/bike_care.jpg" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="" onclick="search_function('plumber');return false;"><img src="images/search/plumber.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="col">
                            <a href="" onclick="search_function('Tailor');return false;"><img src="images/search/tailor.jpg" class="img-fluid"  alt=""></a>
                        </div>
                        <div class="col">
                            <a href="" onclick="search_function('Locksmith');return false;"><img src="images/search/locksmith.jpg" class="img-fluid" ></a>
                        </div>
                        <div class="col">
                            <a href="" onclick="search_function('Laundry');return false;"><img src="images/search/laundry.jpg" class="img-fluid" alt=""></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6 col-sm-12 mb-3">
            <div class="card h-100 w-100 d-inline-block"
                 style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                <h1 class=" mt-4 text-justify text-center font-weight-bold h4">Make Business ID/QR for free</h1>
                <div class="card-body mx-lg-3 mt-5">
                    @auth
                        <form method="post" action="/create_business_card">
                            @else
                                <form method="post" action="/generate_qr_code">
                                    @endauth
                                    @csrf
                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="rounded-pill form-control border border-dark"
                                                           placeholder="First Name" id="first_name" name="first_name"
                                                           value="{{old('first_name')}}">
                                                </div>
                                                @error('first_name')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="form-control border border-dark rounded-pill "
                                                           placeholder="Last Name" id="last_name" name="last_name"
                                                           value="{{old('last_name')}}">
                                                </div>
                                                @error('last_name')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Company Name" id="Company_name"
                                                           name="company_name"
                                                           value="{{old('company_name')}}">
                                                </div>
                                                @error('company_name')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Title/Designation" id="title" name="title"
                                                           value="{{old('title')}}">
                                                </div>
                                                @error('title')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="number"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Phone (Business)" id="phone_business"
                                                           name="phone_business"
                                                           value="{{old('phone_business')}}">
                                                </div>
                                                @error('phone_business')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="number"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Phone (Personal)" id="phone_personal"
                                                           name="phone_personal"
                                                           value="{{old('phone_personal')}}">
                                                </div>
                                                @error('phone_personal')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="email"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Email (Business)" id="email_business"
                                                           name="email_business"
                                                           value="{{old('email_business')}}">
                                                </div>
                                                @error('email_business')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="email"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Email (Personal)" id="email_personal"
                                                           name="email_personal"
                                                           value="{{old('email_personal')}}">
                                                </div>
                                                @error('email_personal')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Street Address" id="street_address"
                                                           name="street_address"
                                                           value="{{old('street_address')}}">
                                                </div>
                                                @error('street_address')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Zip Code" id="zip_code" name="zip_code"
                                                           value="{{old('zip_code')}}">
                                                </div>
                                                @error('zip_code')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="city"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="City"
                                                           id="city" name="city" value="{{old('city')}}">
                                                </div>
                                                @error('city')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="form-control  border border-dark rounded-pill"
                                                           placeholder="Country" id="country" name="country"
                                                           value="{{old('country')}}">
                                                </div>
                                                @error('country')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class="d-flex">
                                                    <input type="text"
                                                           class="form-control  border border-dark text-center rounded-pill"
                                                           placeholder="Website" id="website" name="website"
                                                           value="{{old('website')}}">
                                                </div>
                                                @error('website')
                                                <small class=" text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        @auth
                                            <button type="submit"
                                                    class="btn btn-danger btn-md mt-3  border border-dark rounded-pill"
                                                    name="submit">
                                                Generate ID
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-danger rounded-pill"
                                                    {{--data-toggle="modal" data-target="#exampleModalCenter"--}} name="qr_code">
                                                Generate Qr Code
                                            </button>
                                        @endauth
                                    </div>
                                </form>

                </div>
            </div>
        </div>
    </div>

    {{------------------------------------------Carousel Starts--------------------------------------}}
    <div class="row mt-5">
        <div class="col">
            <h1 class="h4 text-center my-4 font-weight-bold">Services for Home</h1>
        </div>
    </div>
    @php
        $banner = \App\Models\Banner::get();
    @endphp

    <div class="row mx-2 mb-5">
        <div class="owl-carousel owl-theme">
            @foreach($banner as $b)
                @if($b->banner_row == 1 || $b->banner_row == 3)
                    <div class="item h-100">
                        <div class="item h-100" >
                            <h1><img class="img-fluid" src="{{url('storage/'.$b->imgURL)}}" alt="{{$b->banner_seo}}" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"></h1>
                            <figcaption class="figure-caption text-center font-weight-bold text-danger">{{$b->banner_title}}</figcaption>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
    {{------------------------------------------Carousel Ends--------------------------------------}}



    {{------------------------------------------Carousel Starts--------------------------------------}}
    <div class="row mt-5">
        <div class="col">
            <h1 class="h4 text-center my-4 font-weight-bold">Services for Office</h1>
        </div>
    </div>
    <div class="row mx-2 mb-5">
        <div class="owl-carousel owl-theme">
            @foreach($banner as $b)
                @if($b->banner_row == 2 || $b->banner_row == 3)
                    <div class="item h-100">
                        <div class="item h-100">
                            <h1><img class="img-fluid" src="{{url('storage/'.$b->imgURL)}}" alt="{{$b->banner_seo}}" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"></h1>
                            <figcaption class="figure-caption text-center font-weight-bold text-danger">{{$b->banner_title}}</figcaption>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    {{------------------------------------------Carousel Ends--------------------------------------}}


    <div class="row">
        <div class="col ">
            <p><h1 class="h4 text-center pb-1 pt-3  font-weight-bold">Why you need AmarID</h1></p>
            <div class="card rounded h-75 w-100 d-inline-block"
                 style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                <div class="card-body">
                    <div class="card rounded-pill mt-2 mb-3">
                        <img src="images/red.png" alt="">
                        <div class="centered text-dark font-weight-bold" style="font-size: 14px">
                            Create Your Professional Identity for free
                        </div>
                    </div>
                    <div class="card rounded-pill mb-3">
                        <img src="images/green.png" alt="">
                        <div class="centered text-dark font-weight-bold" style="font-size: 14px">
                            Its easy to share and build your connection
                        </div>
                    </div>
                    <div class="card rounded-pill mb-auto">
                        <img src="images/blue.png" alt="">
                        <div class="display-6 centered text-dark font-weight-bold" style="font-size: 14px">
                            It creates your opportunity in business and job
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col ">
            <p><h1 class="h4 text-center pb-1 pt-3 font-weight-bold">Download Our APP</h1></p>
            <div class="card h-75 w-100 d-inline-block"
                 style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                <div class="card-body ">
                    <div class="row">
                        <div class="mt-sm-2 col-4 w-100 h-100">
                            <img src="images/mobile.jpg" class="img-fluid" alt="">
                        </div>
                        <div class="col-8">
                            <div class="row"><a href="https://play.google.com/store/apps/details?id=com.hurutech.amarid" target="_blank"><img class="w-100 h-100 pr-2 img-fluid" src="images/playstore.png"
                                                              alt=""></a></div>
                            <div class="row"><a href="/"><img class="w-100 h-100 pr-2 pb-5 img-fluid" src="images/apple.png"
                                                              alt=""></a></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="h4 text-center my-5 font-weight-bold">How Amar ID Works</h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <div class="card h-100 w-100 d-inline-block rounded"
                 style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                <div class="card-body m-0 p-0 rounded">
                    <img class="card-img rounded" src="images/how_amar_id_works.png" alt="Man Working">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 w-100 d-inline-block rounded"
                 style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                <div class="card-body m-0 p-0 rounded">
                    <img class="card-img rounded" src="images/man_working.jpg" alt="Man Working">
                </div>
            </div>
        </div>

    </div>







    {{---------------------------------------Search Result Modal --------------------------------}}
    @if($data['modal']  ?? '' == true)
        <div class="modal fade" id="search_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="text-success text-center font-weight-bold" style="text-align: center;">Search Results</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($data['found'] == true)
                            @foreach($data['data'] ?? '' as $user)
                                {{--<ul>
                                    <div class="card-body">
                                        <li>Name : {{$user->firstname}} {{$user->lastname}}</li>
                                        <li>Email : {{$user->email}}</li>
                                        <li>Phone : {{$user->phone}}</li>
                                    </div>
                                </ul>--}}
                                <div class="media shadow p-3 mb-2 bg-white rounded">
                                    <img class="mr-3 img-fluid mt-2" src="{{ $user->photo_url != null ? url('storage'.$user->photo_url):'images/avatar/dummy.png'}}" alt="Something" style="width: 64px; height: 64px;">
                                    <div class="media-body">
                                        <div class="col-sm-12">
                                            <div class="font-weight-bold text-info text-break">{{$user->firstname}} {{$user->lastname}} </div>
                                            @if($user->email)
                                                <i class="fa fa-envelope mr-2" aria-hidden="true"></i><span class="text-break" style="font-size: 15px;">{{$user->email}}</span><br>
                                            @endif
                                            @if($user->phone)
                                            <i class="fa fa-mobile mr-2 ml-1" aria-hidden="true"></i><span style="font-size: 15px;">{{$user->phone}}</span><br>
                                            @endif
                                            <i class="fas fa-briefcase mr-2 " aria-hidden="true"></i></i><span style="font-size: 15px;">{{$user->subFieldName}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @elseif($data['found'] == false)
                            <h2 class="text-center ">No Results found</h2>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    @elseif($card['token'] ?? '' == true)
        <div class="modal fade" id="qr_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="text-success text-center">Scan Your Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col text-center">
                                <img src="{{url('storage/'.$card['qr_path'])}}" alt="">
                                <a href="{{url('storage/'.$card['qr_path'])}}" download><h5 class="font-weight-bold my-3">Download</h5></a>
                            </div>
                            {{--<div class="col-9 py-3">{!! QrCode::size(200)->generate($card['card_string']) !!}</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection


@section('extra_js')

    {{----------------------OWL Carousel---------------}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:20,
            nav:false,
            autoplay:true,
            autoplayTimeout:2000,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>





    {{--Search Function--}}
    <script>
        function search_function(keyword) {
            console.log(keyword);
            document.getElementById("search_from_icon").value = keyword;
            document.getElementById('search_form').submit();
        }
    </script>

    @if($data['modal']  ?? '' == true)
        <script type="text/javascript">
            $(window).on('load', function () {
                $('#search_modal').modal('show');
            });
        </script>
    @elseif($card['token'] ?? '' == true)
        <script type="text/javascript">
            $(window).on('load', function () {
                $('#qr_modal').modal('show');
            });
        </script>
    @endif
@endsection

