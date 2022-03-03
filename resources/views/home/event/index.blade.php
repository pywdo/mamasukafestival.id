@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
<div class="header py-2 py-lg-2">
  <div class="container">

    <div class="row mt-5">
      <div class="col-md-12">
        <h1 class="text-dark">Event Terbaru</h1>
      </div>
      @foreach($data as $i => $value)
      <div class="col-lg-6 mb-4">
        <div class="card card-stats mb-4 mb-xl-0">
          <img class="card-img-top" src="{{ asset('images') }}/{{ $value->thumbnail }}" height="250px" style="object-fit: cover;">
          <div class="card-body">
            <h4 class="card-title">{{$value->name}}</h4>
            <h6>{{$value->created_at->format('j F, Y h:i')}}</h6>
            <p class="card-text">{{Str::limit($value->content, 250, $end='.......')}}</p>
            <a href="{{ route('home.event.detail', $value->id) }}" class="btn btn-primary">Lihat Detail</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</div>

@endsection