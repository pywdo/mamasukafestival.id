@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        
       
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                <b>Sign In to Mamasuka Festival</b>
                </div>

                <div class="card-body">

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{session('error')}}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf





                        

                        <div class="row mb-1">
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                     </div>
                                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Email Address') }}" required autocomplete="email" autofocus>
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
                                <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required autocomplete="current-password">
                           </div>
                            </div>
                             </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md">
                                <button type="submit" class="btn btn-danger col-md-12">
                                    {{ __('Sign Up') }}
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