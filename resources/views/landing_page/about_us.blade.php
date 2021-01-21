@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="/css/career/custom.css">
@endsection
@section('content')

    <section class="section section-bg" id="schedule" style="background-image: url(/images/career/about-fullscreen-1-1920x700.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2>Read <em class="text-danger">About Us</em></h2>
                        <img src="/images/career/line-dec.png" alt="">
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-content text-center">
                        <p>AmarID is a digital business card making platform which brings service seeker and service provider under one roof. Eventually creating the largest local service market place of your community no matter where you are.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>




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
