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
                  <a class="btn btn-info btn-md" href="{{ route('admin.teacher.create') }}">Tambah</a>
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
                  <th scope="col" class="text-center">Email</th>
                  <th scope="col" class="text-center">Posisi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($user as $key => $value)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">

    


                      <form action="{{ route('admin.teacher.destroy',$value->id) }}" method="post" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Delete  ')">
                                        Hapus </button>
                                </form>

                  </td>
                  <td>{{ $value->name }}</td>
                  <td>
                  {{ $value->email }}</td>
                  
                  <td>Teacher</td>
                  
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