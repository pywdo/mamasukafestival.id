@extends('dashboard.layouts.main')
@section('contain')



                <h3>View Messages</h3>
                <hr>
<div class="container mt-5">
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
             
              <h6 class="text-uppercase">{{ $pageName }}</h2>
            </div>
            
          </div>
        </div>

        
        <div class="card-body">
        <form method="GET" action="{{ url('/dashboard/contactusindex') }}">
        <input type="text" name="keyword" />
        <button type="submit">search</button>
        </form>
        <br>
          <div class="table-responsive">
            <table class="table align-items-center">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="text-center"">No</th>
                  
                  <th scope="col" class="text-center">Action</th>
                  <th scope="" class="text-cleft">Name</th>
                  <th scope="col" class="text-center">Phone</th>
                  <th scope="col" class="text-center">Email</th>
                 
                  <th scope="col" class="text-center">Subject</th>
                  <th scope="col" class="text-center">Time</th>
                
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $key => $value)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td class="text-center">
                    

                    @if($value->view==0)
                    <form method="POST" name="contact-us" action="/dashboard/contactusindex/{{ $value->id }}">
                        
                         @csrf                        
                       <input type="hidden" id="custId" name="view" value="1">

                <a class="text-success" href="/dashboard/contactusindex/{{ $value->id }}"><b>Read</b></a>
                
                
                </form>
                @else
                  <a href="/dashboard/contactusindex/{{ $value->id }}" class="text-decoration-none text-info"> <i class="fa fa-eye  mr-3"> </i></a>
                    @endif
            
                  </td>
                 
                  <td>{{ $value->name }}</td>
                     <td>{{ $value->phone }}</td>
                  <td class="text-center">{{ $value->email }}</td>
                  <td>{{Str::limit($value->subject, 20, $end='...')}}</td>
                  <td class="text-center">{{ $value->created_at }}</td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

 <div class="d-flex justify-content-center">
 {{ $data->links() }}
  </div> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection