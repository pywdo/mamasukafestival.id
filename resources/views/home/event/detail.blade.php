@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

<div class="container mt-5 mb-5">

  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="text-uppercase">{{ $data->name }}</h2>
              <h6>{{$data->created_at->format('j F, Y h:i')}}</h6>
            </div>
          </div>
        </div>
        <div class="card-body">

          <p>
            <a href="{{ asset('images') }}/{{ $data->thumbnail }}" target="_blank" rel="noopener noreferrer">
              <img class="card-img-top" src="{{ asset('images') }}/{{ $data->thumbnail }}" height="350px" style="object-fit: cover;">
            </a>
          </p>

          <p style="white-space: pre-line">
            {{$data->content}}
          </p>

        </div>
      </div>
    </div>
  </div>

</div>

@endsection