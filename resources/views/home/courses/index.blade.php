@extends('layouts.app', ['class' => 'bg-default'])
@section('content')


	
 @if(!empty($slider) and !$isSearch)
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @foreach($slider as $i => $e)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="@if($i == 0) active @endif"></li>
            @endforeach
          </ol>
          <div class="carousel-inner">
            @foreach($slider as $i => $e)

            <a href="{{ route('home.slider.detail', $e->id) }}" class="carousel-item @if($i == 0) active @endif">
              <img class="d-block w-100" src="{{ asset('images') }}/{{ $e->thumbnail }}" width="100%" style="object-fit: cover;">
              {{-- <div class="carousel-caption d-none d-md-block"> --}}
                {{-- <h2 class="text-white">{{$e->name}}</h2> --}}
                {{--  <p>{{Str::limit($e->content, 100, $end='.')}}</p>  --}}
              {{-- </div> --}}
            </a>

            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      
    @endif
<br>




@if(!empty($category))

<br>
 <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-8 col-xs-8 ml-2">
        <div class="section-headline">
          <h3>ALL STORE</h3>          
        </div>
      </div>
    </div>  
    <div class="owl-carousel owl-theme">


 @foreach($category as $i => $e)
    
    <div class="item">
     <div class="desain">
          <div class="single-awesome-project">           
            <div class="desain-md-12 desain-sm-12 desain-xs-12 desain-lg-12" style=" max-height:200px; overflow:hidden;margin: 5px 5px 5px 5px;">
               <a class="text-black" href="{{ route('home.category.detail', $e->id) }}">
                <img src="{{ asset('images') }}/{{ $e->thumbnail }}">
                   </a>
            </div>
             
             
         </div>
        </div>
      </div>
      @endforeach
      </div>
  </div>
  </div>
<br>
<br>
@endif





<div class="header py-2 py-lg-2">
  <div class="container">   
      <div class="@if(!empty($category)) col-md-12 @else col-md-12 @endif">
        <div class="row">
          <div class="col-md-12">
      {{-- <h1 class ="text-dark text-capitalize">{{$pageName}}</h1>--}}
          </div>
          @foreach($data as $i => $value)
          <div class="col-md-4 mb-3" >
            <div class="card card-stats mb-3 mb-xl-0" >
				 @if($value->description=='Coming Soon')

                @else
              <a href="{{ route('home.courses.detail', $value->id) }}">
            
                @endif
				
				
                <img class="card-img-top" src="{{ asset('images') }}/{{ $value->thumbnail }}"  style="max-height:200px; overflow:hidden;object-fit: cover;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
              </a>
              <div class="card-bodyleft">
               <a href="{{ route('home.courses.detail', $value->id) }}"> <h3 data-toggle="tooltip" data-placement="top" title="{{$value->name}}" class="card-title text-white">{{Str::limit($value->name, 50)}}</h3></a>
                <h3 class="text-white"><strong> Rp. {{ number_format($value->price, 2) }}</strong></h3>
              {{-- <p class="card-text text-white">{{Str::limit($value->description, 60, $end='...')}}</p>--}}
				  
				  
				    
                @if($value->description=='Coming Soon')
                <center><a href="#" class="btn btn-kursus">Coming Soon</a>
              </center>
				  
				   @elseif($value->price==0)
              <center><a href="{{ route('home.courses.detail', $value->id) }}" class="btn btn-kursus">Gratis</a>
              </center>
                
                @else
              <center><a href="{{ route('home.courses.detail', $value->id) }}" class="btn btn-kursus">Lihat Detail</a>
              </center>
                @endif
               
               
              </center>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
    {{ $data->links() }}
    </div>
      
  </div>
</div>

<br>










@if(auth()->user())
@else
<div id="popup1" class="overlay">
	<div class="popup">
	
		<a class="close" href="#">&times;</a>
		<div class="content">
			 <img src="{{ asset('images/1648272014.jpg') }}" width="100%">
		</div>
	</div>
</div>
@endif
@endsection
