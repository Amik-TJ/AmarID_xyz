@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="/css/career/custom.css">
@endsection
@php($all = $data['data'])

@section('content')
    <section class="section section-bg" id="schedule" style="background-image: url(/images/career/blog_title.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2 class="display-4">READ OUR <em class="text-danger">BLOG</em></h2>
                        <img src="/images/career/line-dec.png" alt="">
                        <p>AmarID is a digital business card making platform which brings service seeker and service provider under one roof. Eventudatay creating the largest local service market place of your community no matter where you are.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Blog Start ***** -->
        @if($data['found'])
            <section class="section mt-5" id="our-classes">
            <div class="container">
                <div class="row" id="tabs">
                    <div class="col mx-auto">
                        <section class='tabs-content'>
                            <article id='tabs-1' class="mb-4">
                                @if($all->blog_photo_url != null)
                                    <img src="{{url('storage/'.$all->blog_photo_url)}}" alt="">
                                @endif
                                <h1 class="h4 text-dark my-3">{{$all->blog_title}}</h1>

                                <p><i class="fa fa-user"></i> {{$all->firstname.' '.$all->lastname}} &nbsp;|&nbsp; <i class="fa fa-calendar"></i> {{(new DateTime($all->created_at))->format("d-m-Y h:i A")}} &nbsp;|&nbsp; <i class="fa fa-comments"></i>  0 comments</p>
                                <p class="mb-5">
                                    {{$all->blog_content}}
                                </p>
                                    <span class="display-6 text-dark mb-5 font-weight-bold">Thanks for reading</span>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        @endif
    <!-- ***** Blog End ***** -->




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


