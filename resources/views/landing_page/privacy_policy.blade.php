@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="/css/career/custom.css">
@endsection
@section('content')
    <!-- ***** Testimonials Item Start ***** -->


    <section class="section section-bg" id="schedule" style="background-image: url(/images/career/privacy_policy.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2><span class="text-white">Read</span> <em class="text-danger">Privacy Policy</em></h2>
                        <img src="/images/career/line-dec.png" alt="waves">
                        <p>AmarID is a digital business card making platform which brings service seeker and service provider under one roof.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="section my-5" id="features" >
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <ul class="features-items">
                    <li class="feature-item">
                        <div class="left-icon">
                            <img src="/images/career/policy_1.png" alt="First One">
                        </div>
                        <div class="right-content">
                            <h4>Best Quality</h4>
                            <p class="text-justify">Our RND team is working day and night to present you the best product & we ensure quality before product reach you.</p>
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="left-icon">
                            <img src="/images/career/policy_2.png" alt="second one">
                        </div>
                        <div class="right-content">
                            <h4>Payment Safety & Trustworthy</h4>
                            <p>Never store your credit card information. Quality insurance system for superb product quality.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="features-items">
                    <li class="feature-item">
                        <div class="left-icon">
                            <img src="/images/career/policy_3.png" alt="fourth muscle">
                        </div>
                        <div class="right-content">
                            <h4>Print-Direct</h4>
                            <p>
                                Factory directly to cut the middle man Starting to make your OEM innovation within 36 hours.
                            </p>
                        </div>
                    </li>
                    <li class="feature-item">
                        <div class="left-icon">
                            <img src="/images/career/policy_4.png" alt="training fifth">
                        </div>
                        <div class="right-content">
                            <h4>After Sell Service</h4>
                            <p>
                                Factory directly to cut the middle man Starting to make your OEM innovation within 36 hours.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <br>

        <div class="main-button text-center">
            <a href="" class="bg-danger">Read More</a>
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
