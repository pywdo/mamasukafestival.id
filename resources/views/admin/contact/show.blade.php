
@extends('dashboard.layouts.main')
@section('contain')




<div class="container-fluid">
            <div class="row my-3 align-items-center-top">
                <div class="col-lg-8">
                    <div class="about-img">

                  
               
                
                  
              

                        
                        <a href="/dashboard/contactusindex" class="btn btn-success mb-3"><i class="fa fa-chevron-circle-left " aria-hidden="true"></i> Back</a>
                <h3>{{ $data->subject }}</h3>
                <h6><b>From :</b> {{ $data->name }} < {{ $data->email }} > </h6>       
                <h6><b>Telepone :</b> {{ $data->phone }}</h6>
                
                <h6><b>Date :</b> {{ $data->created_at }}</h6>
                        


          <p class="card-text"><p class="text-justify">{!! $data->message !!}</p>
           
                    </div>
                </div>

            </div>

        </div>




  @endsection
