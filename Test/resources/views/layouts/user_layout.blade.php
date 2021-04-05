<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="AmarID is a digital business card making platform which brings service seeker and service provider under one roof. Eventually creating the largest local service market place of your community no matter where you are.">
    <link rel="icon" href="/images/logo1.png">



{{-----------------------------Quixlab Theme Styles Starts-------------------------------------}}
<!-- Chartist -->
    <link rel="stylesheet" href="/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    {{-----------------------------Quixlab Theme Styles Ends-------------------------------------}}





    {{--    <!-- Bootstrap CSS -->--}}
    {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"--}}
    {{--          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">--}}
    {{--    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">--}}
    <title>AmarID.xyz</title>

    {{------------------------------------Font Family Starts----------------------------------}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Roboto:wght@300;400;500;700;900&display=swap"
          rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet'>

    {{------------------------------------Font Family Ends----------------------------------}}



    {{--DataLoader Table--}}
    @yield('data_table_bootstrap')
    @yield('custom_style')


    <style>

        .list-group{
            max-height: 300px;
            margin-bottom: 10px;
            overflow:scroll;
            -webkit-overflow-scrolling: touch;
        }
        body{font-family:Comfortaa;}
    </style>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '252656616326418');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=252656616326418&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">
    <!-- Topbar -->
@include('inc.quixlab_topbar')
<!-- End of Topbar -->


@include('inc.user.quixlab_user_sidebar')


<!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">

    {{--<div class="container-fluid mt-3">--}}

    <!-- Begin Page Content -->
    @include('inc.messages')
    @yield('content')
    <!-- /.container-fluid -->


    </div>
@include('inc.quixlab_footer')
<!--**********************************
       Main wrapper end
   ***********************************-->
</div>



{{--<!-- Option 2: jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>--}}


<!--**********************************
      Quix Lab Scripts
   ***********************************-->

<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>
<!--**********************************
      Quix Lab Scripts Ends
   ***********************************-->

{{------------------Navbar Message Javascript---------------------}}
<script>
    function conversation_function(keyword) {
        console.log(keyword);
        document.getElementById("partner_id").value = keyword;
        document.getElementById('conversation_form').submit();
    }
</script>
{{----------------------Navbar Message Javascript-----------------}}


@yield('data_table')
@yield('extra_js')
</body>
</html>





