@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="/css/career/custom.css">
@endsection
@section('content')

    <!-- ***** Call to Action Start ***** -->
    <section class="section section-bg" id="call-to-action" style="background-image: url(/images/career/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <h2>Send us a <em class="text-danger">message</em></h2>
                        <p>AmarID is a digital business card making platform which brings service seeker and service provider under one roof. Eventually creating the largest local service market place of your community no matter where you are.</p>
                        <div class="main-button">
                            <a href="" class="bg-danger">Contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->


    <div class="row bg-muted">
        <div class="col mt-5">
            <h1 class="text-danger text-center">Your Message is very important to US</h1>
        </div>
    </div>
    <div class="row my-5">
        <div class="col col-sm-10 col-lg-6 mx-auto my-1 ">
            <form>
                <div class="mx-sm-2 m-auto">
                    <div class="form-group row">
                        <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Your Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Enter Message"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="" class="btn btn-danger ml-auto">Send</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>


@endsection


@section('extra_js')
    <!-- Plugins -->
    <script src="/js/career/scrollreveal.min.js"></script>
    <script src="/js/career/waypoints.min.js"></script>
    <script src="/js/career/jquery.counterup.min.js"></script>
    <script src="/js/career/imgfix.min.js"></script>
    <script src="/js/career/mixitup.js"></script>
    <script src="/js/career/accordions.js"></script>

    <!-- Global Init -->
    <script src="/js/career/custom.js"></script>
@endsection
