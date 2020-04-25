@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="card col-md-4 text-center">
      <h1>Trash</h1>
    </div>  
      
  </div>
  <hr>
<div class="row">
@if(count($trash)>0)
@foreach ($trash as $file)


<div class='col-md-3 ' style="height:25vh; " >
        <div class="card" align=center>
        <div class="card-header text-center" style="height:10vh;">{{$file->file }} </div>
            <div class="card-body " >
              <button href="#myDelModal{{$file->id}}" data-toggle="modal" data-target="#myDelModal{{$file->id}}" >
                <i class="fa fa-trash" {{-- onclick="return confirm('Are you sure you want to delete this file ?');" --}}></i>
                </button>
                <button href="#myResModal{{$file->id}}" data-toggle="modal" data-target="#myResModal{{$file->id}}" >
                <i class="fa fa-undo" {{-- onclick="return confirm('Are you sure you want to delete this file ?');" --}}></i>
                </button>
                
            {{-- <form method="post" action="/file/{{$file->id}}">
                 
            <input type="hidden" name="_method" value="DELETE">
            @csrf
            <button type="submit"><i class="fa fa-trash" onclick="return confirm('Are you sure to delete this file permanently ?');"></i></button> 
            </form> --}}
                
            </div>
        </div>
</div>
    
@endforeach
</div>
@foreach ($trash as $file)
      <!-- Modal -->
      <div id="myDelModal{{$file->id}}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Are you sure you want to permanently delete {{$file->file}}</h4>
                  </div>
                  <div>
                    
                    <form method="post" action="/file/{{$file->id}}">
                      <input type="hidden" name="_method" value="DELETE">
            @csrf
                      <button type="submit" class="btn btn-success form-control" >Delete</button>
                      <button type="button" class="btn btn-default form-control" data-dismiss="modal">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>   
      </div>
      @endforeach
@foreach ($trash as $file)
      <!-- Modal -->
      <div id="myResModal{{$file->id}}" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Restore{{$file->file}}  </h4>
                  </div>
                  <div>
                    <form action="/file/m2f/{{$file->id}}" class="form-group" method="get">
                      <button type="submit" class="btn btn-success form-control" >Move</button>
                      <button type="button" class="btn btn-default form-control" data-dismiss="modal">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>   
      </div>
@endforeach
@else 
<div class="container align-items-center">
  <h3 style="color:white;" align=center>Trash can is empty</h3>
</div>     
@endif
@endsection