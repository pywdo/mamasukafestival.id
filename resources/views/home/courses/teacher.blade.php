@extends('layouts.app')

@section('content')

<div class="container mt-5">
 
  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase ls-1 mb-1">Master Data</h6>
              <h2 class="text-uppercase">{{ auth()->user()->name }}</h2>
            </div>
            
          </div>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table align-items-center">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="text-center" style="width: 50px;">No</th>
                  <th scope="col" class="text-center">Kategori</th>
                  <th scope="col" class="text-center">Judul</th>
                  <th scope="col" class="text-center">Thumbnail</th>
                  <th scope="col" class="text-center">Harga</th>
                  <th scope="col" class="text-center">Deskripsi</th>
                  <th scope="col" class="text-center">Total User</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  
                  <td>{{ $value->category_name }}</td>
                  <td>{{ $value->name }}</td>
                  <td class="text-center">
                    <a href="{{ asset('images') }}/{{ $value->thumbnail }}" target="_blank" rel="noopener noreferrer">
                      <img src="{{ asset('images') }}/{{ $value->thumbnail }}" width="80px" height="45px">
                    </a>
                  </td>
                  <td class="text-center">{{ $value->price }}</td>
                  <td>{{Str::limit($value->description, 20, $end='.......')}}</td>
                  <td class="text-center">{{ $value->total_user }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

 <div class="d-flex justify-content-center">
 
 {{ $data->links() }}
  </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection