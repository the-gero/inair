@extends('layouts.app')
@section('content')


@if(count($files)>0)
<div class="row">
@foreach ($files as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;">{{$file->file }} <a href="/file/m2t/{{$file->id}}" ><i class="fa fa-trash" onclick="return confirm('Are you sure to delete this file ?');"></i></a></div>
            <div class="card-body" >
                {{$file->type}}
            </div>
        </div>
</div>
   
@endforeach
</div> 
@else
<div class="container align-items-center">
    <a href="/file/create"><h1 style="font-size:6rem; color:white;" align=center><i class="fa fa-upload "></i></h1></a>
    <h3 style="color:white;" align=center>No files uploaded yet click to upload now!</h3>
</div>
@endif

@endsection