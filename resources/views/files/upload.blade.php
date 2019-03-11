@extends('layouts.app')
@section('content')
Upload files here
{!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
        {{Form::file('file')}}
        </div>
       <button type="submit" onclick="return confirm('Are you sure to Upload this file ?');" style="border: 0; background: none;">
            <i class="fa fa-upload" style="color:white" aria-hidden="true"></i>
          </button>
    {!! Form::close() !!}
    
@endsection

