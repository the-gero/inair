@extends('layouts.app')
@section('content')

<div class="row">
@foreach ($files as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;">{{$file->file }} <a href="/file/m2t/{{$file->id}}" ><i class="fa fa-trash"></i></a></div>
            <div class="card-body" >
                {{$file->type}}
            </div>
        </div>
</div>
    
@endforeach
</div>
@endsection