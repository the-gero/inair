@extends('layouts.app')
@section('content')

<div class="row">
@foreach ($trash as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;">{{$file->file }} <a href="/file/m2f/{{$file->id}}" ><i class="fa fa-undo" onclick="return confirm('Are you sure to move this to My files ?');"></i></a> <form method="post" action="/file/{{$file->id}}">
            <input type="hidden" name="_method" value="DELETE">
            @csrf
            <button type="submit"><i class="fa fa-trash" onclick="return confirm('Are you sure to delete this file permanently ?');"></i></button> 
            </form></div>
            <div class="card-body" >
                {{$file->type}}
            </div>
        </div>
</div>
    
@endforeach
</div>
@endsection