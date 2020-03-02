@extends('layouts.app')
@section('content')
<div class="box" style=" width: 100%; /*can be in percentage also.*/
height: auto;
margin: 0 auto;
padding: 10px;
position: right;">
    <form class="row" align=center method="POST" action="/file" enctype="multipart/form-data">
            @csrf
            <div class="col-md-2"></div>
            <div class="col-md-8 align-self-center" >
                <div class="form-group files color">
                    <label for="file">Upload Your File </label>
                    <input required type="file" id="file" name='file' onchange="submitForm();" class="form-control" >
                    <button type="submit" name="sub" id="sub" onclick="return confirm('Are you sure to Upload this file ?');" style="border: 0; background: none;">
                </div>
            </div>
            </form>
            <div class="com-md-2"></div>
    
</div>
<script type="text/javascript">
    function submitForm(){

        var selectButton = document.getElementById( 'sub' );
        selectButton.click();
}
</script>
    


@endsection

{{-- {!! Form::open(['action' => 'FilesController@store','class' => 'col-md-8', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group col-md-8" >
        {{Form::file('file')}}
        </div>
        <div class="col-md-8" >
       
          
              <a href="/file/create"><h1 style="font-size:6rem; color:white;" align=center><i class="fa fa-upload "></i></h1>
                
              </a><h3 style="font-size:1rem; color:white;" align=center>Click here to confirm upload</h3>
              
          </button>
    {!! Form::close() !!} </div>--}}