@extends('layouts.app')
@section('content')


@if(count($files)>0)
<div class="row">
@foreach ($files as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;background:grey;">{{$file->file }} 
            
        </div>
            <div class="card-body" style="background:lightgrey" >
                <a href="/file/m2t/{{$file->id}}" >
                <i class="fa fa-trash" onclick="return confirm('Are you sure you want to delete this file ?');"></i>
            </a>
            <a href="/file/download/{{$file->id}}" >
                <i class="fa fa-download" onclick="return confirm('Are you sure you want to Download this file ?');"></i>
            </a>
            <button href="#myModal{{$file->id}}" data-toggle="modal" data-target="#myModal{{$file->id}}">
            <i class="fa fa-share"  ></i>
            </button>
                <a href="/file/preview/{{$file->id}}" target="_blank" > Preview </a>
                @if($file->type == "jpg")
                    {{-- <img src="{{ asset("storage/$file->file")}}">   --}} 
                    <a href="/file/preview/{{$file->id}}" target="_blank" ><img class="imgprev" src="{{url('/files'.'/images'.'/'.$file->file)}}{{-- {{ url('storage/'.Auth::id().'/files'.'/'.$file->file) }} --}}" alt="{{$file->file }}" ></a>
                @endif
            </div>
        </div>
</div>
  
@endforeach


</div> 
@foreach ($files as $file)
<!-- Modal -->
<div id="myModal{{$file->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <form action="/file/share" method="post">
              @csrf
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              
              <h4 class="modal-title">Share {{$file->file}}</h4>
            </div>
            <div class="modal-body">
            <input type="text" name="owner" value="{{$file->user_id}}" hidden>
            <input type="text" name="file_id" value="{{$file->id}}" hidden>
            <input type="text" name="file_name" value="{{$file->file}}" hidden>
            <input type="text" class="form-control" name="shared_with"  placeholder="Enter Email to share with">
                
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success" >Share</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </form>
        </div>
      </div>   
      @endforeach
@else
<div class="container align-items-center">
    <a href="/file/create"><h1 style="font-size:6rem; color:white;" align=center><i class="fa fa-upload "></i></h1></a>
    <h3 style="color:white;" align=center>No files uploaded yet click to upload now!</h3>
</div>
@endif
<label class="float-right" style="margin-top:60vh" >{{$totalsize}} of 2GB used</label>

@endsection