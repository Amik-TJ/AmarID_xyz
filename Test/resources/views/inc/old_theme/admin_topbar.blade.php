<nav class="navbar navbar-expand navbar-light my-navbar" style="background-color:#DDCDCD;">

    <!-- Sidebar Toggle (Topbar) -->
    <div type="button" id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed"
         data-toggle="offcanvas">
        <span></span>
        <span></span>
        <span></span>
    </div>


    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown">
                <span class="mr-2 d-none d-lg-inline text-dark-600 small font-weight-bold" style="color: #222E3C">
                    {{auth()->user()->firstname.' '.auth()->user()->lastname}}
                </span>
                    @if(auth()->user()->photo_url != null)
                        <img class="img-profile rounded-circle" src="{{url('storage'.auth()->user()->photo_url)}}"  alt="">
                    @else
                        <img class="img-profile rounded-circle" src="images/sidebar_images/user.png"  alt="">
                    @endif
            </a>
        </li>
        {{--<li>
            <a class="btn btn-danger rounded-pill my-2 mr-2 text-white" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>--}}

    </ul>

</nav>
