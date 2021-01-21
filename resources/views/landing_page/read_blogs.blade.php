@extends('layouts.app')
@section('custom_css')
    <link rel="stylesheet" href="/css/career/custom.css">
@endsection
@section('content')

<section class="section section-bg" id="schedule" style="background-image: url(/images/career/blog_title.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-heading dark-bg">
                    <h2 class="display-4">READ OUR <em class="text-danger">BLOG</em></h2>
                    <img src="/images/career/line-dec.png" alt="">
                    <p>AmarID is a digital business card making platform which brings service seeker and service provider under one roof. Eventually creating the largest local service market place of your community no matter where you are.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Blog Start ***** -->
@if($data['found'])
<form id="read_more_form" method="post" action="/read_full_web_blog">
    @csrf
    <input type="hidden" name="blog_id" id="blog_id" value="">
    <section class="section mt-5" id="our-classes">
        <div class="container">
            <div class="row" id="tabs">
                <div class="col-lg-4">
                    <ul>
                        @php
                            $count = 0;
                        @endphp
                        @foreach($data['data'] as $all)
                            @php
                                ++$count;
                            @endphp
                            @if($all->blog_photo_url == null)
                                <li><a href="" onclick="form_function({{$all->blogID}});return false;">{{$all->blog_title}}</a></li>
                            @endif
                            @break($count>20)
                        @endforeach

                        {{--<div class="main-rounded-button"><a href="blog.html">Read More</a></div>--}}
                    </ul>
                </div>
                <div class="col-lg-8">
                    <section class='tabs-content'>
                        @foreach($data['data'] as $all)
                            @if($all->blog_photo_url != null)
                                <article id='tabs-1' class="mb-4">
                                    <img src="{{url('storage/'.$all->blog_photo_url)}}" alt="">
                                    <h1 class="h4 my-2">{{$all->blog_title}}</h1>

                                    <p><i class="fa fa-user"></i> {{$all->firstname.' '.$all->lastname}} &nbsp;|&nbsp; <i class="fa fa-calendar"></i> {{(new DateTime($all->created_at))->format("d-m-Y h:i A")}} &nbsp;|&nbsp; <i class="fa fa-comments"></i>  0 comments</p>
                                    @if(strlen($all->blog_content) < 450)
                                        <p class="">
                                            {{$all->blog_content}}
                                        </p>
                                        <span class="display-6 text-dark mb-5 font-weight-bold">Thanks for reading</span>
                                        @else
                                        <p>
                                            {{substr($all->blog_content, 0, 450)}}       ...............
                                        </p>
                                        <div class="main-button">
                                            <a class="btn" onclick="form_function({{$all->blogID}});return false;">Continue Reading</a>
                                        </div>
                                    @endif
                                </article>
                            @endif

                        @endforeach
                    </section>
                </div>
            </div>
        </div>
    </section>
</form>
@endif
<!-- ***** Blog End ***** -->




@endsection


@section('extra_js')
    {{--Search Function--}}
    <script>
        function form_function(keyword) {
            console.log(keyword);
            document.getElementById("blog_id").value = keyword;
            document.getElementById('read_more_form').submit();
        }
    </script>


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


