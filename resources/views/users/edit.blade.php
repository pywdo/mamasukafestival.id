
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
            
                    @if(session('message'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                       <b> {{session('message')}}</b>
                    </div>
                    @endif
                <div class="card-header"><b>Update Your Profile Information</b></div>

                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}" novalidate>
                       @method('put')
                        @csrf


                    <div class="row mb-1">
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                     </div>
                                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',Auth::user()->name) }}" required autocomplete="name" autofocus>

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
                                       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',Auth::user()->email) }}"  required autocomplete="email">

                                @error('email')
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
                                <button type="submit" class="btn btn-kursus col-6">
                                    {{ __('Update') }}
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
