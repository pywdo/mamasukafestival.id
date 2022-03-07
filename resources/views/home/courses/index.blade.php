@extends('layouts.app', ['class' => 'bg-default'])
@section('content')


 @if(!empty($event) and !$isSearch)
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @foreach($event as $i => $e)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="@if($i == 0) active @endif"></li>
            @endforeach
          </ol>
          <div class="carousel-inner">
            @foreach($event as $i => $e)

            <a href="{{ route('home.event.detail', $e->id) }}" class="carousel-item @if($i == 0) active @endif">
              <img class="d-block w-100" src="{{ asset('images') }}/{{ $e->thumbnail }}" height="450" style="object-fit: cover;">
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



<div class="header py-2 py-lg-2">
  <div class="container">   



    <div class="row mt-5">
      @if(!empty($category))
      <div class="col-md-3">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-dark">Kategori</h1>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link active text-sm" href="{{ url('/') }}"><b>Semua</b></a>
                  </li>
                  @foreach($category as $i => $c)
                  <li class="nav-item">
                 <a class="nav-link active text-sm" href="{{ route('home.category.detail', $c->id) }}">
                  <img class="text-sm" src="{{ asset('images') }}/{{$c->thumbnail}}" width="8%"> 
                <b> {{$c->name}}</b></a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      <div class="@if(!empty($category)) col-md-9 @else col-md-12 @endif">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-dark text-capitalize">{{$pageName}}</h1>
          </div>
          @foreach($data as $i => $value)
          <div class="col-md-4 mb-4">
            <div class="card card-stats mb-4 mb-xl-0">
              <a href="{{ route('home.courses.detail', $value->id) }}">
                <img class="card-img-top" src="{{ asset('images') }}/{{ $value->thumbnail }}" height="150px" style="object-fit: cover;">
              </a>
              <div class="card-body">
                <h4 class="card-title">{{$value->name}}</h4>
                <h3><strong> Rp. {{ number_format($value->price, 2) }}</strong></h3>
                <p class="card-text">{{Str::limit($value->description, 100, $end='...')}}</p>
                <a href="{{ route('home.courses.detail', $value->id) }}" class="btn btn-info">Lihat Detail</a>
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