@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="card col-md-4 text-center">
      <h1>Shared with me</h1>
    </div>  
      
  </div>
<hr>
@if(count($files)>0)
<div class="row">
@foreach ($files as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;">{{$file->file_name }} 
            <a href="/file/delbyS/{{$file->file_id}}" >
                <i class="fa fa-trash" onclick="return confirm('Remove Access from this file ?');"></i>
            </a>
            <a href="/file/download/{{$file->file_id}}" >
                <i class="fa fa-download" onclick="return confirm('Are you sure you want to Download this file ?');"></i>
            </a>
        </div>
            <div class="card-body" >
                @if($file->type == "jpg")
                    
                    <img class="imgprev" src="{{url('/files'.'/images'.'/'.$file->file)}}{{-- {{ url('storage/'.Auth::id().'/files'.'/'.$file->file) }} --}}" alt="{{$file->file }}" >
                @endif
                <p>Shared by : {{$file->owner_name }}</p><p>Email :{{$file->owner_email}}</p>
                <p>On : {{$file->created_at}}</p>
            </div>
        </div>
</div>
   
@endforeach
</div> 
@else
<div class="container align-items-center">
    <h3 style="color:white;" align=center>No files Shared with you</h3>
</div>
@endif

@endsection