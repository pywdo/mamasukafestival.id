@extends('layouts.app', ['class' => 'bg-default'])

@section('content')

<div class="container mt-5 mb-5">

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{session('success')}}
  </div>
  @endif

  <div class="row mt-3">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col">
              <h2 class="text-uppercase">{{ $data->name }}</h2>
              {{--  <h6>{{$data->created_at->format('j F, Y h:i')}}</h6>  --}}
              <h1>(
                        @for ($i = 0; $i < 5; $i++)
                         @if ($i < $sumrating)
                        <span class="fa fa-star checked"></span>
                        @else
                        <span class="fa fa-star"></span>
                        @endif
                        @endfor	
                        <b>{{ 
                          round($sumrating, 2);
                           }}</b> )</h1>
            </div>
            @auth
            @if($isPurchased == 0 and auth()->user()->is_admin == 0)

            <div class=" col">
              <ul class="nav nav-pills justify-content-end">
                <li class="nav-item">
                 @if($data->price==0)
                <a class="btn btn-kursus btn-md" href="#">Gratis</a>
                @else
                  <a class="btn btn-kursus btn-md" href="{{ route('home.transaction.create', $data->id) }}">Beli Kursus</a>
                @endif
                </li>
              </ul>
            </div>

            @endif

            @if($isPurchased == 99 and auth()->user()->is_admin == 0)

            <div class=" col">
              <ul class="nav nav-pills justify-content-end">
                <li class="nav-item">
                  <a class="btn btn-warning btn-md" href="#">Pending</a>
                </li>
              </ul>
            </div>

            @endif
            @endauth
          </div>
        </div>
        <div class="card-body">

          <p>
           
              <img class="card-img-top" src="{{ asset('images') }}/{{ $data->thumbnail }}" height="350px" style="object-fit: cover;">
          
          </p>
          
          <p style="white-space: pre-line;text-align: justify;">
            {!!$data->description!!}
          </p>
          <br>
         <h2>Preview</h2> 
			{!!$data->preview!!}
 <br>
			
			 @guest
                    
                    @if (Route::has('register'))
			<div class="row mb-1 text-right">
                            <div class="col-md-3 offset-md-0">
                   
	 				<a class="btn btn-kursus btn-md mt-2" href="{{ route('register') }}">Beli Kursus</a>
				</div>
			</div>
                    @else
			@endif
			@endguest
      
			
			<hr>
       
        
 <style>
.checked {
 color: orange;
}
</style>
<div class="container">
<div id="review_form_wrapper">
				<div id="comments">
				<h2 class="woocommerce-Reviews-title">Review kursus<span> {{ $data->name }}</span></h2>
						<div id="comment-20" class="comment_container"> 
						<div class="comment-text">
                      
                      	@if(count($review) > 1)
                           @foreach($review as $i => $value)
                         @for ($i = 0; $i < 5; $i++)
                         @if ($i < $value->rating)
                        <span class="fa fa-star checked"></span>
                        @else
                        <span class="fa fa-star"></span>
                        @endif
                        @endfor		
															<p class="meta"> 
																<strong class="woocommerce-review__author">{{ $value->username }}</strong> 
																<span class="woocommerce-review__dash">–</span>
																<time class="woocommerce-review__published-date" >{{ $value->created_at }}																</time>
															</p>
															<div class="description">
																<p>{{ $value->comment }}</p>
															</div>
										           @endforeach
                              				@endif
                    					{{ $review->links() }}

                    				</div>
								</div>
                        
                    </div>          
                 </div>
			   
    </div>
 
@if($isPurchased==1)

<a href="{{ route('users.review',['courses_id'=>$data->id])}}">
<button class="btn btn-icon btn-primary" type="button">
	<span class="btn-inner--icon"><i class="ni ni-like-2"></i></span>
    <span class="btn-inner--text">Ulasan</span>
</button>
</a>
@endif

@if($data->price == 0)
          <p>
            <hr class="my-4">
          <div class="accordion" id="accordionExample">

            @foreach($segments as $i => $segment)
            <div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$segment->name}}
                  </button>
                </h5>
              </div>

              <div id="collapse_{{$i}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  {!! $segment->embed !!}
                </div>
              </div>
            </div>
            @endforeach
          </div>
          </p>
          
          @elseif($isPurchased == 1)
          <p>
            <hr class="my-4">
          <div class="accordion" id="accordionExample">

            @foreach($segments as $i => $segment)
            <div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                    {{$segment->name}}
                  </button>
                </h5>
              </div>

              <div id="collapse_{{$i}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  {!! $segment->embed !!}
                </div>
              </div>
            </div>
            @endforeach
          </div>
          </p>
          @endif

        </div>
      </div>
    </div>
  </div>


</div>
@endsection