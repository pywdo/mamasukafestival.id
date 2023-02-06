@extends('layouts.appadmin')

@section('content')
<div class="container mt-5">
  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase ls-1 mb-1">Edit Data</h6>
              <h2 class="text-uppercase">{{ $pageName }}</h2>
            </div>
          </div>
        </div>
        <div class="card-body">

          <form method="POST" action="{{ route('admin.category.update', $category->id) }}" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="row mb-3">
              <label for="name" class="col-md-4 col-form-label text-md-end">Nama Store</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $category->name }}" required autocomplete="name" placeholder="Nama Store">

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mb-3">
              <label for="thumbnail" class="col-md-4 col-form-label text-md-end">Thumbnail</label>

              <div class="col-md-6">
                <input id="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail">

                @error('thumbnail')
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