<!--**********************************
            Sidebar start
        ***********************************-->
@php
    $admin =auth()->user()->admin;
    $print = auth()->user()->print_vendor ;
    $delivery = auth()->user()->delivery_vendor;
@endphp

<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">

            @if($admin)
            <li>
                <a href="/admin_dash_board" >
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text font-weight-bold">Dashboard</span>
                </a>
            </li>
            @endif
            <li>
                <a href="/show_more_notification" >
                    <i class="icon-globe menu-icon"></i><span class="nav-text font-weight-bold">Notifications</span>
                </a>
            </li>
            <li>
                <a href="/see_more_message">
                    <i class="icon-envelope-letter menu-icon"></i><span class="nav-text font-weight-bold">Inbox</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i> <span class="nav-text font-weight-bold">Order Cycle</span>
                </a>
                <ul aria-expanded="false">
                    @if($admin)
                    <li><a href="/all_order">All Order</a></li>
                    <li><a href="/revenue_forecast">Revenue Forecast</a></li>
                    <li><a href="/placed_order">To Pay</a></li>
                    <li><a href="/verify_orders">On Verification</a></li>
                    <li><a href="/assign_print_vendor">Assign Print Vendor</a></li>
                    @endif
                    @if($print)
                            <li><a href="/print_vendor_all_order">Orders Against You</a></li>
                    @endif
                    @if($delivery)
                        <li><a href="/delivery_vendor_all_order">Orders Against You</a></li>
                    @endif
                    @if($print || $admin)
                    <li><a href="/on_print">Processing</a></li>
                    @endif
                    @if($admin)
                    <li><a href="/assign_delivery_vendor">Assign Delivery Vendor</a></li>
                    @endif
                    @if($delivery || $admin)
                    <li><a href="/shipped_order">Shipped</a></li>
                    <li><a href="/delivered_order">Delivered</a></li>
                    @endif
                    @if($admin)
                    <li><a href="/cancelled_order">Cancelled</a></li>
                    @endif
                </ul>
            </li>
            @if($admin)
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-screen-tablet menu-icon"></i><span class="nav-text font-weight-bold">Manage Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/view_all_user">All Users</a></li>
                    <li><a href="/admin_vendor_registration">Register Vendor</a></li>
                    <li><a href="/admin_user_registration">Register User</a></li>
                    <li><a href="/view_unverified_user">Verify User</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-screen-tablet menu-icon"></i><span class="nav-text font-weight-bold">Card Utilities</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/package">Packages</a></li>
                    <li><a href="/template">Templates</a></li>
                    <li><a href="/banner">Banners</a></li>
                    <li><a href="/weight">Card Weights</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-screen-tablet menu-icon"></i><span class="nav-text font-weight-bold">Blogs & FAQs</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/blog">Mobile App Blogs</a></li>
                    <li><a href="/web_app_blog">Web App Blogs</a></li>
                    <li><a href="/faq">FAQs</a></li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text font-weight-bold">Job Categories</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/account_type">Account Type</a></li>
                    <li><a href="/field">Field Type</a></li>
                    <li><a href="/sub_field">Sub Field Type</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-grid menu-icon"></i><span class="nav-text font-weight-bold">Feedback and Reports</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/feedback">Feedbacks</a></li>
                    <li><a href="/report">Reports</a></li>
                </ul>
            </li>
            @endif
            <li>
                <a class="" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="icon-grid menu-icon"></i><span class="nav-text font-weight-bold">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
