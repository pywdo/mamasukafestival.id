<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Mamasuka Festival</title>

    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/flexslider.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chosen.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/color-01.css') }}">
</head>

<body>
    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    </form>
    @endauth
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="navbar-main">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
               <img src="{{ asset('images/logo.png') }}" width="80%">     
               </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                    <a href="{{ url('/') }}">
                    <img src="{{ asset('images/LOGOQA.png') }}" width="60%">   
                    </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item">
                <form action="{{ route('/') }}" method="GET" class="navbar-search navbar-search-light mr-3 form-inline d-md-flex ml-lg-auto">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            
                            <input class="form-control" placeholder="Search" type="text" name="search" >
                        	</div>
							</div>
                    </div>
                </form>
            </li>
				
            <li class="nav-item"><h3>
                        <a class="nav-link mt-2" href="/"><b>Beranda</b></a>
            </li>
            <li class="nav-item"><h3>
                        <a class="nav-link mt-2" href="{{ route('home.event') }}"><b>Events</b></a>
            </li>
				
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item"><h3>
                        <b><a class="nav-link mt-2" href="{{ route('login') }}">{{ __('Masuk') }}</a></b>
                    </li>
                    @endif
                    @if (Route::has('register'))
                    <li class="nav-item"><h3>
                        <b><a class="nav-link mt-2" href="{{ route('register') }}">{{ __('Daftar') }}</a></b>
                    </li>
                    @endif
                    @else

                    <li class="nav-item dropdown"><h3>
                    <a class="nav-link nav-link-icon mt-2" href="#" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <span class="mb-0 text-sm font-weight-bold"><b><i class="ni ni-circle-08">  </i> {{ auth()->user()->name }}</b></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                            </div>
                            @if(auth()->user()->is_admin == 1)
                            <a href="{{ route('admin.home') }}" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span>Admin Panel</span>
                            </a> 
                            
                            @elseif(auth()->user()->is_admin == 2)
                            
                            <a href="{{ route('home.courses.teacher') }}" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span><b>Materi Saya</b></span>
                            </a>

                           @else

                            <a href="{{ route('home.courses.mine') }}" class="dropdown-item">
                                <i class="ni ni-support-16"></i>
                                <span><b>Akun Saya</b></span>
                            </a>    
                                
                            @endif

                            <div class="dropdown-divider"></div>
                            <a href="{{ route('profile.edit') }}" class="dropdown-item" >
                               <i class="ni ni-settings-gear-65"></i>
                             <span>{{ __('Edit profile') }}</span>
                            </a>
                      
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('password.edit') }}" class="dropdown-item" >
                               <i class="ni ni-settings-gear-65"></i>
                             <span>{{ __('Ubah password') }}</span>
                            </a>
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

{{--  <img src="{{ asset('images/footer.svg') }}" width="100%">  --}}
    <div class="footer wow fadeIn mt-8" data-wow-delay="0.3s">
        <div class="container-fluid">

            <div class="container">
                <div class="row align-items-center-top">
                    <div class="col-lg-3">

                        <div class="footer-info mt-3">
                            {{--  <img src="{{ asset('/img/logo-ecolify.svg') }}" width="50%">  --}}
                            <h3>Mamasuka</h3>
                              <div class="divider"></div>
                            <div class="footer-menu">
                                <b>PT Daesang Agung Indonesia</b>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-info mt-3">
                            <h3>Peta Situs</h3>
                            <div class="footer-menu">
                                <h4>Home</h4>
                                <h4>Kursus Online</h4>
                                <h4>Events</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-info mt-3">
                            <h3>Resource</h3>
                            <div class="footer-menu">
                                <h4>FAQ</h4>
                                <h4>Kebijakan Privasi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                       <div class="footer-social mt-3">
                        <h3>Kontak Kami</h3>
                           <a href = "mailto:info@quantumacademy.id">
                          <i class="fa fa-envelope"></i></a>
                                <p><b>info@mamasuka.com</b></p><br>
                                <a href="https://api.whatsapp.com/send?phone=6281901911999" target="_blank">
                               <i class="fab fa-whatsapp"></i>
						   </a>
                                <p><b>(62-21) 4892908, 4704280</b></p><br>
						    	<a href=" https://goo.gl/maps/qKApmhogFZX78jHc8" target="_blank">
									<i class="fa fa-map-marker"></i></a>
                                <p><b>Lokasi</b></p>
                                <p>Jl. Perintis Kemerdekaan No. 1-3,
Pulo Gadung, Kota Jakarta Timur,
DKI Jakarta 13260</p>
                            
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="footer-social mt-3">
                            <h3>Ikuti Kami</h3>
                            <a href="https://www.facebook.com/mamasukaindonesia/
" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/c/MamaSukaIndonesia" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.instagram.com/mamasukaindonesia/" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://twitter.com/MamaSukaID" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.tiktok.com/@mamasukaindonesia?lang=en" target="_blank"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
         
    </div>
    <!-- Footer End -->

 <div class="container copyright mt-2">
                <p>Mamasuka Festival &copy; 2023</a> - </p>
            </div>
 </div>
<script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{ asset('assets/js/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{ asset('assets/js/jquery.flexslider.js')}}"></script>
	<script src="{{ asset('assets/js/chosen.jquery.min.js')}}"></script>
	<script src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{ asset('assets/js/jquery.countdown.min.js')}}"></script>
	<script src="{{ asset('assets/js/jquery.sticky.js')}}"></script>
	<script src="{{ asset('assets/js/functions.js')}}"></script>
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @stack('js')

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
      <script>
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();
	});
</script>

 
</body>

</html>