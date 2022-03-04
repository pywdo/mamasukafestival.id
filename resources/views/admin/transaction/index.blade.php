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
          </div>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table align-items-center">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="text-center" style="width: 50px;">#</th>
                  <th scope="col" class="text-center" style="width: 100px;">#</th>
                  <th scope="col" class="text-center">Nama User</th>
                  <th scope="col" class="text-center">Email User</th>
                  <th scope="col" class="text-center">Nama Kursus</th>
                  <th scope="col" class="text-center">Harga Kursus</th>
                  <th scope="col" class="text-center">Bukti</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">
                    @if($value->status == 0)
                    <a class="btn btn-success btn-sm" href="{{ route('admin.transaction.approval', ['id' => $value->id, 'status' => 1]) }}">Approve</a>
                    <a class="btn btn-danger btn-sm" href="{{ route('admin.transaction.approval', ['id' => $value->id, 'status' => 2]) }}">Reject</a>
                    @elseif($value->status == 1)
                    <span class="text-success">Approved</span>
                    @else
                    <span class="text-danger">Rejected</span>
                    @endif
                  </td>
                  <td>{{ $value->user_name }}</td>
                  <td>{{ $value->user_email }}</td>
                  <td class="text-center">{{ $value->course_name }}</td>
                  <td class="text-right">Rp. {{ number_format($value->course_price, 2) }}</td>
                  <td class="text-center">
                    <a href="{{ asset('images') }}/{{ $value->proof }}" target="_blank" rel="noopener noreferrer">
                      <img src="{{ asset('images') }}/{{ $value->proof }}" width="100px" height="70px">
                    </a>
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