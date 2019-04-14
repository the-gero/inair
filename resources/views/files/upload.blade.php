@extends('layouts.app')
@section('content')

<div class="row" align=center>
{!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <button type="submit" onclick="return confirm('Are you sure to Upload this file ?');" style="border: 0; background: none;">
          
              <a href="/file/create"><h1 style="font-size:6rem; color:white;" align=center><i class="fa fa-upload "></i></h1>
                
              </a><h3 style="font-size:1rem; color:white;" align=center>Click here to confirm upload</h3>
              
          </button>
        <div class="form-group ">
            <div class="form-group files">
                <label>Upload Your File </label>
                <input type="file" class="form-control" multiple="">
            </div>
        </div>
   
       
    {!! Form::close() !!}

</div>
@endsection

