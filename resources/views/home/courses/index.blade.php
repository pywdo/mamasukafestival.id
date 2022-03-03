@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<div class="header py-2 py-lg-2">
  <div class="container">

    <div class="row mt-5">
      <div class="col-md-12">
        <h1 class="text-dark">Kursus Terbaru</h1>
      </div>
      @foreach($data as $i => $value)
      <div class="col-lg-4 mb-4">
        <div class="card card-stats mb-4 mb-xl-0">
          <img class="card-img-top" src="{{ asset('images') }}/{{ $value->thumbnail }}" height="150px" style="object-fit: cover;">
          <div class="card-body">
            <h4 class="card-title">{{$value->name}}</h4>
            <h3><strong> Rp. {{ number_format($value->price, 2) }}</strong></h3>
            <p class="card-text">{{Str::limit($value->description, 120, $end='.......')}}</p>
            <a href="{{ route('home.courses.detail', $value->id) }}" class="btn btn-primary">Lihat Detail</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</div>

@endsection