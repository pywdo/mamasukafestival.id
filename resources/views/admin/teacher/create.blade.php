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

          <form method="POST" action="{{ route('admin.teacher.store') }}" enctype="multipart/form-data" novalidate>
            @csrf

                    <div class="row mb-1">
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                     </div>
                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Full Name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                     </div>
                                    </div>
                             </div>
                        </div>
                        
                     <div class="row mb-1">
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                     </div>
                                       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                     </div>
                                    </div>
                             </div>
                        </div>
                    
                     <input id="is_admin" type="hidden" class="form-control @error('is_admin') is-invalid @enderror" name="is_admin" value="2"  required>

                        <div class="row mb-1">
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                     </div>
                                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password Baru" required autocomplete="new-password">
                                       @error('password')
                                      <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                     @enderror

                                </div>
                            </div>
                             </div>
                        </div>



                        <div class="row mb-1">
                            <div class="col-md-6 offset-md-0">
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