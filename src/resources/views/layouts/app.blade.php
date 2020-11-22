<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonNicV2</title>

    {{-- bootstrap css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-info">
    <!-- [container] start-->
    <div class="container">

        <!-- [navbar] start -->
        <nav class="navbar navbar-expand-sm mt-2 bg-dark navbar-dark rounded">
            <!-- Brand start-->
            <a class="navbar-brand" href="#">MinNicV2</a>
            <!-- Brand end-->

            <!-- Toggler/collapsibe start -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Toggler/collapsibe end -->

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <!-- Navbar links start-->
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="#">Switches</a>
                    </li>
                </ul>
                <!-- Navbar links end-->

                <!-- profile links start-->
                <ul class="navbar-nav  justify-content-end">
                    @auth()
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">{{ auth()->user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <form name="form" action="{{ route('logout') }}" method="post">
                                @csrf
                                <a class="nav-link" href="#" onclick="form.submit()">Logout</a>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest
                </ul>
                <!-- profile links end-->
            </div>
        </nav>
        <!-- [navbar] end -->

        <!-- [main] start -->
        @yield("content")
        <!-- [main] end -->
    </div>
    <!-- End of Container-->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
