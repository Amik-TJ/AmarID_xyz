<!--**********************************
            Sidebar start
        ***********************************-->

<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="/user_dashboard" >
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text font-weight-bold">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/user_all_orders" >
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text font-weight-bold">My Orders</span>
                </a>
            </li>
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
                <a href="/package">
                    <i class="icon-screen-tablet menu-icon"></i><span class="nav-text font-weight-bold">Packages</span>
                </a>
            </li>
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
