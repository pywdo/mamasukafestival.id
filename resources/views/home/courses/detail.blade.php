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
            @if(!$isPurchased)
            <div class=" col">
              <ul class="nav nav-pills justify-content-end">
                <li class="nav-item">
                  <a class="btn btn-info btn-md" href="{{ route('admin.event.create') }}">Beli Kursus</a>
                </li>
              </ul>
            </div>
            @endif
          </div>
        </div>
        <div class="card-body">

          <p>
            <a href="{{ asset('images') }}/{{ $data->thumbnail }}" target="_blank" rel="noopener noreferrer">
              <img class="card-img-top" src="{{ asset('images') }}/{{ $data->thumbnail }}" height="350px" style="object-fit: cover;">
            </a>
          </p>

          <p>
            {{$data->description}}
          </p>

          @if($isPurchased)
          <p>
            <hr class="my-4">
          <div class="accordion" id="accordionExample">

            @foreach($segments as $i => $segment)
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$segment->name}}
                  </button>
                </h5>
              </div>

              <div id="collapse_{{$i}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  {!! $segment->embed !!}
                </div>
              </div>
            </div>
            @endforeach
          </div>
          </p>
          @endif

        </div>
      </div>
    </div>
  </div>

</div>

@endsection