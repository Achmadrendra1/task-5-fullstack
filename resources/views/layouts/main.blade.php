<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Blog | {{$title}}</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/styles.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="chevron-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </symbol>
    </svg>
    <!-- NAVBAR -->
    <section class="h-100 w-100" style="box-sizing: border-box; background-color: #004AAD">
        <nav class="navbar-1-3 navbar navbar-expand-lg navbar-dark p-4 px-md-4 sticky-top ">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Simple Blog
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link px-md-4" href="{{URL::to('/')}}">Home</a>
                        </li>


                    </ul>

                    <div class="d-flex justify-content-center">
                        @if (auth()->guard()->guest())
                        @if (Route::has('login')) 
                            <a class="btn btn-login text-white" href="{{route('login')}}">Login</a>
                        @endif

                        @if (Route::has('register')) 
                            <a class="btn btn-register btn-fill text-white" href="{{route('register')}}">Register</a>
                        @endif

                        @else


                        <a class="align-items-center text-white text-decoration-none dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}}

                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">

                            @if (Auth::user()->is_admin == 1)
                                <a class="dropdown-item" type="button" href="{{URL::to('admin')}}">Switch To Admin Page</a>
                          @endif

                            <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{__('Logout')}}

                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>

                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </section>
    <!--Akhir NAVBAR  -->
    @yield('content')
    <!-- Footer -->
    <footer class="page-footer font-small blue">
        <div class="footer text-center">

            <p class="copyright text-white">Dibuat Oleh </br> Achmad Rendra Artama</p>
        </div>
    </footer>
    <!-- Akhir Footer -->


    <<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
        </script>
        <script src=" {{URL::to('js/scripts.js')}}"></script>


        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>