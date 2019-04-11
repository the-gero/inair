@extends('layouts.app')
@section('content')
<div class="container align-items-center" align=center>
{!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
        {{Form::file('file')}}
        </div>
       <button type="submit" onclick="return confirm('Are you sure to Upload this file ?');" style="border: 0; background: none;">
          
              <a href="/file/create"><h1 style="font-size:6rem; color:white;" align=center><i class="fa fa-upload "></i></h1>
                
              </a><h3 style="font-size:3rem; color:white;" align=center>Click here to confirm upload</h3>
              
          </button>
    {!! Form::close() !!}
</div>
@endsection

