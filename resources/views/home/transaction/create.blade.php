@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase ls-1 mb-1">Beli Kursus</h6>
              <h2 class="text-uppercase">{{ $pageName }}</h2>
            </div>
          </div>
        </div>
        <div class="card-body">

          <form method="POST" action="{{ route('home.transaction.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">Nama Kursus</label>

              <div class="col-md-6">
                <input type="hidden" class="form-control" value="{{ $data->id }}" name="id">
                <input type="text" class="form-control" value="{{ $data->name }}" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">Harga Kursus</label>

              <div class="col-md-6">
                <input type="text" class="form-control" value="Rp. {{ number_format($data->price, 2) }}" readonly>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-md-4 col-form-label text-md-end">Bukti Pembayaran</label>

              <div class="col-md-6">
                <input type="file" class="form-control @error('proof') is-invalid @enderror" name="proof" required>

                @error('proof')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-info">
                  Simpan
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection