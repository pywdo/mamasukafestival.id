@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><b>Create Account</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" novalidate>
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
                    
                   


 <div class="row mb-1">
                            <div class="col-md">
                                  <div class="form-group">
                                  <div class="input-group">
                                     <div class="input-group-prepend">
                                     <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                     </div>
                                       <input id="wanumber" type="wanumber" class="form-control @error('wanumber') is-invalid @enderror" name="wanumber" value="{{ old('wanumber') }}" placeholder="{{ __('Nomer Whatsapp') }}" required autocomplete="wanumber">

                                @error('wanumber')
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
                            <div class="col-md-4 offset-md-0">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
						<p>Sudah punya akun ? <a href="{{ route('login') }}">
						 <b> Sign In</b>
								</a>
					</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection