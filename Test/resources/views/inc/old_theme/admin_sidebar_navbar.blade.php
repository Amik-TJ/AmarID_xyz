<!-- Sidebar -->
@php
$admin =auth()->user()->admin;
$print = auth()->user()->print_vendor ;
$delivery = auth()->user()->delivery_vendor;
@endphp
<nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
    <div class="simplebar-content" style="padding: 0px;">
        <a class="sidebar-brand" href="index.html">
            <img src="images/sidebar_images/amarid_logo.png" alt="" style="height: 40px;width: 40px;">
            <span class="align-middle">AmarID.xyz</span>
        </a>
        <hr>
        <ul class="navbar-nav align-self-stretch">
            <li class="sidebar-header">
                Order Cycles
            </li>

            <li class="">
                <a class="nav-link text-left" role="button"
                   aria-haspopup="true" aria-expanded="false" href="/admin_dash_board">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            @if($admin)
            <li class="">
                <a class="nav-link text-left" role="button"
                   aria-haspopup="true" aria-expanded="false" href="/all_order">
                    <i class="fas fa-cart-plus"></i> All
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button"
                   aria-haspopup="true" aria-expanded="false" href="/revenue_forecast">
                    <i class="fas fa-cart-plus"></i> Revenue Forecast
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button"
                   aria-haspopup="true" aria-expanded="false" href="/placed_order">
                    <i class="fab fa-cc-amazon-pay"></i> To Pay
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/verify_orders">
                    <i class="far fa-money-bill-alt"></i> On Verification
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/assign_print_vendor">
                    <i class="far fa-money-bill-alt"></i> Assign Print Vendor
                </a>
            </li>
            @endif
            @if($print || $admin)
            <li class="">
                <a class="nav-link text-left" role="button"
                   aria-haspopup="true" aria-expanded="false" href="/on_print">
                    <i class="fas fa-chalkboard-teacher"></i> Processing
                </a>
            </li>
            @endif
        @if($admin)
            <li class="">
                <a class="nav-link text-left" role="button" href="/assign_delivery_vendor">
                    <i class="fas fa-truck-loading"></i> Assign Delivery Vendor
                </a>
            </li>
        @endif
        @if($print)
            <li class="">
                <a class="nav-link text-left" role="button" href="/print_vendor_all_order">
                    <i class="fas fa-truck-loading"></i> All Orders
                </a>
            </li>
        @endif
        @if($delivery)
            <li class="">
                <a class="nav-link text-left" role="button" href="/delivery_vendor_all_order">
                    <i class="fas fa-truck-loading"></i> All Orders
                </a>
            </li>
        @endif
        @if($admin || $delivery)
            <li class="">
                <a class="nav-link text-left" role="button" href="/shipped_order">
                    <i class="fas fa-truck-loading"></i> Shipped
                </a>
            </li>
            @endif
            @if($admin)
            <li class="">
                <a class="nav-link text-left" role="button" href="/delivered_order">
                    <i class="fas fa-truck"></i> Delivered
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button"
                   aria-haspopup="true" aria-expanded="false" href="/cancelled_order">
                    <i class="fas fa-window-close"></i> Cancelled
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/admin_user_registration">
                    <i class="fas fa-archive"></i> Register User
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/view_unverified_user">
                    <i class="fas fa-archive"></i> Verify User
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/package">
                    <i class="fas fa-archive"></i> Packages
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/template">
                    <i class="far fa-address-card"></i> Templates
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/banner">
                    <i class="far fa-address-card"></i> Banners
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/blog">
                    <i class="far fa-address-card"></i> Blogs
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/faq">
                    <i class="fa fa-question-circle" aria-hidden="true"></i> FAQs
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/account_type">
                    <i class="far fa-address-card"></i> Account Type
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/field">
                    <i class="far fa-address-card"></i> Field
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/sub_field">
                    <i class="far fa-address-card"></i> Sub Field
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button" href="/weight">
                    <i class="far fa-address-card"></i> Weights
                </a>
            </li>
            <li class="has-sub">
                <a class="nav-link collapsed text-left" href="#collapseExample2" role="button"
                   data-toggle="collapse">
                    <i class="fas fa-cart-plus"></i> Feedback and Reports
                </a>
                <div class="collapse menu mega-dropdown" id="collapseExample2">
                    <div class="dropmenu" aria-labelledby="navbarDropdown">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-12 px-2">
                                    <div class="submenu-box">
                                        <ul class="list-unstyled m-0">
                                            <li><a href="/feedback"><i class="fas fa-comment-alt"></i>  Feedbacks</a></li>
                                            <li><a href="/report"><i class="fas fa-user-lock"></i>  Reports</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endif
            <hr>
            <li class="">
                <a class="nav-link text-left" role="button" href="/">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>

            <li>
                <a class="" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-2x"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            <!--<li class="">
                <a class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> invoice
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> Bank
                </a>
            </li>
            <li class="sidebar-header">
                tools and component
            </li>

            <li class="">
                <a class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> ui element
                </a>
            </li>

            <li class="">
                <a class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> form
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> table
                </a>
            </li>

            <li class="sidebar-header">
                tools and component
            </li>
            <li class="">
                <a class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> chart
                </a>
            </li>
            <li class="">
                <a class="nav-link text-left" role="button">
                    <i class="flaticon-map"></i> map
                </a>
            </li>-->

        </ul>


    </div>


</nav>
<!-- /#sidebar-wrapper -->
