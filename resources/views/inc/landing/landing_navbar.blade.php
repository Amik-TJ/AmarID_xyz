<nav class="navbar navbar-expand-md navbar-light border-bottom border-dark" style="background-color:#DDCDCD;">

{{--    <a class="navbar-brand" href="/"--}}
{{--       style="font-family:Comfortaa; font-size: 25px; letter-spacing: -0.015em;  font-weight: bold;">AmarID.xyz</a>--}}
    <a class="navbar-brand m-0 p-0" href="/">
        <div class="logo-image">
            <img src="<?= asset('images/navbar_icon.png') ?>" class="img-fluid my-0" style="height: 58px;width: 213px;">
        </div>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="form-inline ml-auto">
            <p class="my-auto" >

            <div class="btn-group" role="group">

                @auth
                    <a class="btn btn-secondary rounded-pill" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a class="btn btn-secondary rounded-pill mr-2" href="{{ route('login') }}" >Login</a>
                    <a class="btn btn-secondary rounded-pill " href="{{ route('register') }}">Register</a>
                @endauth
            </div>


            </p>
        </div>
    </div>
</nav>
