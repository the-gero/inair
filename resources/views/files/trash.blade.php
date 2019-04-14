@extends('layouts.app')
@section('content')

<div class="row">
@foreach ($trash as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;">{{$file->file }} </div>
            <div class="card-body" >
            
            <form method="post" action="/file/{{$file->id}}">
                <a href="/file/m2f/{{$file->id}}" ><i class="fa fa-undo" onclick="return confirm('Are you sure to move this to My files ?');"></i></a> 
            <input type="hidden" name="_method" value="DELETE">
            @csrf
            <button type="submit"><i class="fa fa-trash" onclick="return confirm('Are you sure to delete this file permanently ?');"></i></button> 
            </form>
                {{$file->type}}
            </div>
        </div>
</div>
    
@endforeach
</div>
@endsection