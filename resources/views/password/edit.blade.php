
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
                <div class="card-header"><b>Update Your Password</b></div>

                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}" novalidate>
                       @method('put')
                        @csrf

                            <div class="row mb-1">
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                     </div>
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="Current Password" required autocomplete="new-password">
                                @error('current_password')
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
                                     <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                     </div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password" required autocomplete="new-password">
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
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                     </div>
                                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                           
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
