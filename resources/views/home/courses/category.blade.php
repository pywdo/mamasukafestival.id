@extends('layouts.app', ['class' => 'bg-default'])
@section('content')


 @if(!empty($slider) and !$isSearch)
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @foreach($slider as $i => $e)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="@if($i == 0) active @endif"></li>
            @endforeach
          </ol>
          <div class="carousel-inner">
            @foreach($slider as $i => $e)

            <a href="{{ route('home.slider.detail', $e->id) }}" class="carousel-item @if($i == 0) active @endif">
              <img class="d-block w-100" src="{{ asset('images') }}/{{ $e->thumbnail }}" width="100%" style="object-fit: cover;">
              {{-- <div class="carousel-caption d-none d-md-block"> --}}
                {{-- <h2 class="text-white">{{$e->name}}</h2> --}}
                {{--  <p>{{Str::limit($e->content, 100, $end='.')}}</p>  --}}
              {{-- </div> --}}
            </a>

            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      
    @endif

  @if(!empty($category))
 <div class="portfolio" id="portfolio">
            <div class="container">
                <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                    <h3>Kategori Kursus</h3>
                    <br>
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul id="portfolio-filter">
                            
                            <li data-filter="*" class="filter-active"> <a class="" href="{{ url('/') }}"><b>SEMUA</b></a></li>
                             @foreach($category as $i => $c)
                            <li data-filter=".filter-1" class="portfolio-filter "> <a class="text-white" href="{{ route('home.category.detail', $c->id) }}">
                              {{$c->name}}</a></li>
                            
                        @endforeach
                           
                        </ul>
                    </div>
                </div>
               </div>
               </div>
               @endif
        <!-- Portfolio End -->




<div class="header py-2 py-lg-2">
  <div class="container">   

  
      <div class="@if(!empty($category)) col-md-12 @else col-md-12 @endif">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-dark text-capitalize">{{$pageName}}</h1>
          </div>
          @foreach($data as $i => $value)
          <div class="col-md-4 mb-3" >
            <div class="card card-stats mb-3 mb-xl-0" >
            @if($value->description=='Coming Soon')

                @else
              <a href="{{ route('home.courses.detail', $value->id) }}">
            
                @endif
                <img class="card-img-top" src="{{ asset('images') }}/{{ $value->thumbnail }}" height="150px" style="object-fit: cover;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
              </a>
              <div class="card-bodyleft">
                <h3 class="card-title text-white">{{$value->name}}</h3>
                <h3 class="text-white"><strong> Rp. {{ number_format($value->price, 2) }}</strong></h3>
                {{--<p class="card-text text-white">{{Str::limit($value->description, 60, $end='...')}}</p>--}}
               
                @if($value->description=='Coming Soon')
                <center><a href="#" class="btn btn-kursus">Coming Soon</a>
              </center>
                @elseif($value->price==0)
              <center><a href="{{ route('home.courses.detail', $value->id) }}" class="btn btn-kursus">Gratis</a>
              </center>
                
                @else
              <center><a href="{{ route('home.courses.detail', $value->id) }}" class="btn btn-kursus">Lihat Detail</a>
              </center>
                @endif
               
                
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

  
  </div>
</div>

@endsection