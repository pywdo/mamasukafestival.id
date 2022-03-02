@extends('layouts.appadmin')

@section('content')
<div class="container mt-5">
  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase ls-1 mb-1">Tambah Data</h6>
              <h2 class="text-uppercase">{{ $pageName }}</h2>
            </div>
          </div>
        </div>
        <div class="card-body">

          <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

            <div class="row">
              <div class="col-md-6">
                <label class="form-control-label" for="category">Kategori</label>
                <select class="form-control @error('category') is-invalid @enderror" name="category" id="category">
                  <option selected>Pilih Kategori</option>
                  @foreach ($category as $key => $value)
                  <option value="{{ $value->id }}" @if($value->id == old('category')) selected @endif>{{ $value->name }}</option>
                  @endforeach
                </select>

                @error('category')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-control-label" for="name">Nama Kursus</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Nama Kursus">

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-6">
                <label class="form-control-label" for="price">Harga Kursus</label>
                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="Harga Kursus">

                @error('price')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="col-md-6">
                <label class="form-control-label" for="thumbnail">Thumbnail</label>
                <input id="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" name="thumbnail" value="{{old('thumbnail')}}">

                @error('thumbnail')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-12">
                <label class="form-control-label" for="description">Deskripsi</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3" placeholder="Deskripsi">{{ old('description') }}</textarea>

                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <hr class="my-4">

            <div id="course-segment" class=" mt-3">
              <div class="row">
                <div class="col">
                  <h3>Segmen</h3>
                </div>
              </div>

              @if(old('segment'))

              @foreach (old('segment') as $i => $seg)

              <div class="row mt-2" id="segment_{{$i}}">
                <div class="col-md-4">
                  @if($i == 0)
                  <label class="form-control-label">Judul</label>
                  @endif
                  <input type="text" class="form-control @error('segment.'.$i.'.title') is-invalid @enderror" name="segment[{{$i}}][title]" value="{{ $seg['title']}}" placeholder="Judul">

                  @error('segment.'.$i.'.title')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="col-md-4">
                  @if($i == 0)
                  <label class="form-control-label">Embed</label>
                  @endif
                  <textarea class="form-control @error('segment.'.$i.'.embed') is-invalid @enderror" name="segment[{{$i}}][embed]" rows="3" placeholder="Embed">{{$seg['embed']}}</textarea>

                  @error('segment.'.$i.'.embed')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                @if($i > 0)
                <div class="col-md-2">
                  <button type="button" onclick="removeSegment('{{$i}}')" class="btn btn-danger">
                    Hapus
                  </button>
                </div>
                @endif
              </div>

              @endforeach

              @else
              <div class="row mt-2">
                <div class="col-md-4">
                  <label class="form-control-label" for="title">Judul</label>
                  <input id="title" type="text" class="form-control" name="segment[0][title]" placeholder="Judul">
                </div>
                <div class="col-md-4">
                  <label class="form-control-label">Embed</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" name="segment[0][embed]" rows="3" placeholder="Embed"></textarea>
                </div>
              </div>
              @endif

            </div>


            <div class="row mt-5">
              <div class="col-md-6">
                <button type="button" id="add-segment" class="btn btn-success">
                  Tambah Segmen
                </button>
              </div>
              <div class="col-md-6">
                <ul class="nav nav-pills justify-content-end">
                  <li class="nav-item">
                    <button type=" submit" class="btn btn-info">
                      Simpan
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
  var i = `@if(old('segment')) {{count(old('segment'))-1}} @else 0 @endif`;

  console.log(i)

  $("#add-segment").click(function() {
    ++i;
    $("#course-segment").append(`
      <div class="row mt-2" id="segment_` + i + `">
        <div class="col-md-4">
          <input type="text" class="form-control" name="segment[` + i + `][title]" placeholder="Judul">
        </div>
        <div class="col-md-4">
          <textarea class="form-control" name="segment[` + i + `][embed]" rows="3" placeholder="Embed"></textarea>
        </div>
        <div class="col-md-2">
          <button type="button" onclick="removeSegment(` + i + `)" class="btn btn-danger">
            Hapus
          </button>
        </div>
      </div>`);
  });

  function removeSegment(row) {
    $('#segment_' + row).remove()
  }
</script>
@endpush