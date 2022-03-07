<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Quantum Academy</title>

    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>


    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endauth
    <div id="app">

    {{--  navbar  --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="navbar-main">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
               <img src="{{ asset('images/LOGOQA.PNG') }}" width="80%"></a>
                </a>

                <form action="{{ route('/') }}" method="GET" class="navbar-search navbar-search-light form-inline mr-3 d-none d-md-flex ml-lg-auto">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input class="form-control" placeholder="Search" type="text" name="search">
                        </div>
                    </div>
                </form>

                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.event') }}"><b>Event</b></a>
                    </li>

                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <b><a class="nav-link" href="{{ route('login') }}">{{ __('SignIn') }}</a></b>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <b><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></b>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><b><i class="ni ni-circle-08">  </i> {{ auth()->user()->name }}</b></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                            </div>

                            @if(!auth()->user()->is_admin)
                            <a href="{{ route('home.courses.mine') }}" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span><b>Kursus Saya</b></span>
                            </a>
                            @endif

                            @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.home') }}" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span>Admin Panel</span>
                            </a>
                            @endif

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="ni ni-user-run"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

{{--  main conten  --}}
        <div class="main-content">
            @yield('content')
        </div>
{{--  main conten  --}}
{{--  footer  --}}
<img src="{{ asset('images/footer.svg') }}" width="100%">
    <div class="footer wow fadeIn" data-wow-delay="0.3s">
        <div class="container-fluid">

            <div class="container">
                <div class="row align-items-center-top">
                    <div class="col-lg-3">

                        <div class="footer-info">
                            {{--  <img src="{{ asset('/img/logo-ecolify.svg') }}" width="50%">  --}}
                            <h3>Quantum Academy</h3>
                            <div class="footer-menu">
                                <b>Quantum Academy</b> adalah platform pelatihan kursus online.
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-info">
                            <h3>Peta Situs</h3>
                            <div class="footer-menu">
                                <h4>Home</h4>
                                <h4>Kursus Online</h4>
                                {{--  <h4>Kenapa?</h4>  --}}
                                <h4>Event</h4>
                                {{--  <h4>Layanan</h4>  --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-info">
                            <h3>Resource</h3>
                            <div class="footer-menu">
                                <h4>F A Q</h4>
                                <h4>Kebijakan Privasi</h4>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-2">

                        <div class="footer-info">
                            <h3>Hubungi kami</h3>
                            <div class="footer-menu">

                                <h2>email :</h2>
                                <p>priyadi.widodo@gmail.com</p>
                                <h2>wa / phone :</h2>
                                <p> 021-631-8909</p>
                                <h2>location:</h2>
                                <p>Jl. Kaji Raya No. 32 Kel. Petojo Utara, Kec. Gambir – Jakarta Pusat. 10130</p>
                               
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="footer-social">
                            <h3>Ikuti Kami</h3>
                            <a href="https://twitter.com/priyadi_widodo" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/priyadi.widodo" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/channel/UCdfDilhCljqY-xryJLefd2g" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.instagram.com/pywdo/" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/in/priyadi-widodo-b624a9197/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container copyright">
                <p> Quantum Academy &copy; 2022</a> - made with conscience "for a future worth living"</p>
            </div>
        </div>
    </div>
    <!-- Footer End -->




        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </div>
</body>

</html>