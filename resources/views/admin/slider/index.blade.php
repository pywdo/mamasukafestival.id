@extends('layouts.appadmin')

@section('content')
<div class="container mt-5">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{session('success')}}
  </div>
  @endif
  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase ls-1 mb-1">Master Data</h6>
              <h2 class="text-uppercase">{{ $pageName }}</h2>
            </div>
            <div class=" col">
              <ul class="nav nav-pills justify-content-end">
                <li class="nav-item">
                  <a class="btn btn-info btn-md" href="{{ route('admin.slider.create') }}">Tambah</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table align-items-center">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="text-center" style="width: 50px;">#</th>
                  <th scope="col" class="text-center" style="width: 100px;">#</th>
                  <th scope="col" class="text-center">Nama</th>
                  <th scope="col" class="text-center">Thumbnail</th>
                  <th scope="col" class="text-center">Konten</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">
                    <form action="{{ route('admin.slider.destroy',$value->id) }}" method="POST">
                      <a class="btn btn-primary btn-sm" href="{{ route('admin.slider.edit',$value->id) }}">Edit</a>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                  <td>{{ $value->name }}</td>
                  <td class="text-center">
                    <a href="{{ asset('images') }}/{{ $value->thumbnail }}" target="_blank" rel="noopener noreferrer">
                      <img src="{{ asset('images') }}/{{ $value->thumbnail }}" width="100px" height="70px">
                    </a>
                  </td>
                  <td class="text-wrap" style="width: 100px;">
                    {{Str::limit($value->content, 50, $end='.......')}}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection