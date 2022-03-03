@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<div class="header py-2 py-lg-2">
  <div class="container-fluid">

    <div class="row mt-5">

      @if(!empty($category))
      <div class="col-md-2">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-dark">Kategori</h1>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link active text-sm" href="{{ url('/') }}">Semua</a>
                  </li>
                  @foreach($category as $i => $c)
                  <li class="nav-item">
                    <a class="nav-link active text-sm" href="{{ route('home.category.detail', $c->id) }}">{{$c->name}}</a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      <div class="col-md-10">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-dark text-capitalize">{{$pageName}}</h1>
          </div>
          @foreach($data as $i => $value)
          <div class="col-md-3 mb-4">
            <div class="card card-stats mb-4 mb-xl-0">
              <img class="card-img-top" src="{{ asset('images') }}/{{ $value->thumbnail }}" height="150px" style="object-fit: cover;">
              <div class="card-body">
                <h4 class="card-title">{{$value->name}}</h4>
                <h3><strong> Rp. {{ number_format($value->price, 2) }}</strong></h3>
                <p class="card-text">{{Str::limit($value->description, 100, $end='.......')}}</p>
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