@extends('layouts.app', ['class' => 'bg-default'])
@section('content')
<br>
<br>
<section id="contact-form" class="bg-white mb-5">
    <div class="container">
        <div class="section-content">
            <!-- Section Title -->
            <div class="title-wrap" data-aos="fade-up">
                <h2 class="section-title">Get In Touch</h2>
                <p class="section-sub-title">Praesent commodo cursus magna, vel scelerisque nisl consectetur et. <br> pharetra augue. Donec id elit non mi.</p>
            </div>


                            
            <!-- End of Section Title -->
            <div class="row">
            
                                 
                             
                <!-- Contact Form Holder -->
                <div class="col-md-8 offset-md-2 contact-form-holder mt-4" data-aos="fade-up">
                        
                                 @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 <strong>Hello</strong> {{ session('success') }}
                                  </div>
                                  @endif  

                    <form method="POST" name="contact-us" action="/contactusstore">
                        
                         @csrf

                        
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('name')is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                             @error('name')
                            <div class="invalid-feedback ml-3">
                            {{ $message }}
                            </div>
                            @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" class="form-control @error('email')is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                             @error('email')
                            <div class="invalid-feedback ml-3">
                            {{ $message }}
                            </div>
                            @enderror
                            
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="number" class="form-control @error('phone')is-invalid @enderror" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                            @error('phone')
                           <div class="invalid-feedback ml-3">
                            {{ $message }}
                            </div>
                            @enderror

                            </div>


                           <div class="col-md-12 form-group">
                                <input type="text" class="form-control @error('subject')is-invalid @enderror" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                             @error('subject')
                            <div class="invalid-feedback ml-3">
                            {{ $message }}
                            </div>
                            @enderror
                         </div>
                         
                            <div class="col-md-12 form-group">
                                <textarea class="form-control @error('message')is-invalid @enderror" id="message" name="message" rows="6" placeholder="Your Message ..." value="{{ old('message') }}"></textarea>
                             @error('message')
                            <div class="invalid-feedback ml-3">
                            {{ $message }}
                            </div>
                            @enderror

                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary btn-shadow btn-lg" type="submit" name="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Contact Form Holder -->
            </div>
        </div>
        <div class="section-content pt-0">
            <div class="title-wrap" data-aos="fade-up">
                <h2 class="section-title">Where To Find Us?</h2>
            </div>
            <div class="row text-center mt-4">
                <div class="col-md-3" data-aos="fade-up">
                    <span class="lnr lnr-location fs-40 py-4 d-block"></span>
                    <h5>LOCATION</h5>
                    <p>Jakarta</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <span class="lnr lnr-clock fs-40 py-4 d-block"></span>
                    <h5>WORKING TIME</h5>
                    <p>Monday - Saturday</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <span class="lnr lnr-phone fs-40 py-4 d-block"></span>
                    <h5>CALL US</h5>
                    <p>123-45678</p>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="600">
                    <span class="lnr lnr-phone fs-40 py-4 d-block"></span>
                    <h5>EMAIL</h5>
                    <p>company@gmail.com</p>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
