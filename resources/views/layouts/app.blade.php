<!DOCTYPE html>
<html>
<head>
    <title>AmarID.xyz - Next Generation Business Card Solution</title>
    <meta charset="utf-8">
    <meta name="description" content="AmarID is a digital business card making platform which brings service seeker and service provider under one roof. Eventually creating the largest local service market place of your community no matter where you are.">
    <meta name=”robots” content="index, follow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/c68141eb2d.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>
    <link rel="icon" href="/images/logo1.png">



    {{----------------------  Footer  Starts  -----------------------}}
    <link rel='stylesheet' id='hfe-style-css'  href='/css/footer/footer_1.css' media='all' />
    <link rel='stylesheet' id='elementor-icons-css'  href='/css/footer/footer_2.css' media='all' />
    <link rel='stylesheet' id='elementor-animations-css'  href='/css/footer/footer_3.css' media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'  href='/css/footer/footer_4.css' media='all' />
    <link rel='stylesheet' id='font-awesome-5-all-css'  href='/css/footer/footer_5.css' media='all' />
    <link rel='stylesheet' id='font-awesome-4-shim-css'  href='/css/footer/footer_6.css' media='all' />
    <link rel='stylesheet' id='elementor-global-css'  href='/css/footer/footer_7.css' media='all' />
    <link rel='stylesheet' id='elementor-post-15-css'  href='/css/footer/footer_8.css' media='all' />
    <link rel='stylesheet' id='hfe-widgets-style-css'  href='/css/footer/footer_9.css' media='all' />
    <link rel='stylesheet' id='elementor-post-1165-css'  href='/css/footer/footer_10.css' media='all' />
    {{------------------------    Footer  Ends   ---------------------------------}}

    {{------------------- Custom CSS -------------------------}}
    @yield('custom_css')
    {{------------------- Custom CSS -------------------------}}



    {{--------------------------Owl Carousel starts------------------------------------}}
    <link rel='stylesheet' href='css/owl_carousel/owl.carousel.css' >
    <link rel='stylesheet' href='css/owl_carousel/owl.theme.default.css'>
    {{-------------------------- Owl Carousel Ends ------------------------------------}}

</head>
<body>

@include('inc.landing.landing_navbar')

    @include('inc.messages')
    @yield('content')

<!-- Footer -->
@include('inc.landing.landing_footer')











<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

@yield('extra_js')
</body>
</html>



































