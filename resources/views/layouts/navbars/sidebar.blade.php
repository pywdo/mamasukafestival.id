<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('admin.home') }}">
         <img src="{{ asset('images/LOGOQA.png') }}" width="65%"></a>
        </a>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.category') }}">
                        <i class="ni ni-folder-17 text-warning"></i> Data Store
                    </a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.teacher') }}">
                        <i class="ni ni-folder-17 text-warning"></i> Data Admin Store
                    </a>
                </li>
               {{--   <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.courses') }}">
                        <i class="ni ni-image text-success"></i> Data Kursus
                    </a>
                </li>
                --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.event') }}">
                        <i class="ni ni-album-2 text-default"></i> Data Event
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.slider') }}">
                        <i class="ni ni-album-2 text-default"></i> Data Slider
                    </a>
                </li>
                 {{--
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.client') }}">
                        <i class="ni ni-album-2 text-default"></i>Client
                    </a>
                </li>
--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.transaction') }}">
                        <i class="ni ni-credit-card text-info"></i> Data Transaksi
                    </a>
                </li>

                <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    
                         <i class="ni ni-single-02 text-info"> </i> {{ auth()->user()->name }}
                        
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('/') }}" class="dropdown-item">
                        <i class="ni ni-air-baloon"></i>
                        <span>{{ __('Beranda') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Edit profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('password.edit') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Ubah Password') }}</span>
                    </a>


                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
            </ul>
        </div>
    </div>
</nav>