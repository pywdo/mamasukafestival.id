<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('admin.home') }}">
         <img src="{{ asset('images/LOGOQA.PNG') }}" width="60%"></a>
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
                        <i class="ni ni-folder-17 text-warning"></i> Data Kategori
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.courses') }}">
                        <i class="ni ni-image text-success"></i> Data Kursus
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.event') }}">
                        <i class="ni ni-album-2 text-default"></i> Data Event
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.transaction') }}">
                        <i class="ni ni-credit-card text-info"></i> Data Transaksi
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>