@extends('layouts.app')
@section('content')


@if(count($files)>0)
<div class="row">
@foreach ($files as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;">{{$file->file }} 
            <a href="/file/m2t/{{$file->id}}" >
                <i class="fa fa-trash" onclick="return confirm('Are you sure to delete this file ?');"></i>
            </a>
            <a href="/file/download/{{$file->id}}" >
                <i class="fa fa-download" onclick="return confirm('Are you sure to Download this file ?');"></i>
            </a>
            <a href="#" >
                <i class="fa fa-share" data-toggle="modal" data-target="#myModal" onclick="return confirm('Do you want to share this file ?');"></i>
            </a>
        </div>
            <div class="card-body" >
                <a href="/file/preview/{{$file->id}}" target="_blank" > Preview </a>
                @if($file->type == "jpg")
                    {{-- <img src="{{ asset("storage/$file->file")}}">   --}} 
                    <a href="/file/preview/{{$file->id}}" target="_blank" ><img class="imgprev" src="{{url('/files'.'/images'.'/'.$file->file)}}{{-- {{ url('storage/'.Auth::id().'/files'.'/'.$file->file) }} --}}" alt="{{$file->file }}" ></a>
                @endif
            </div>
        </div>
</div>
   
@endforeach

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
</div> 
@else
<div class="container align-items-center">
    <a href="/file/create"><h1 style="font-size:6rem; color:white;" align=center><i class="fa fa-upload "></i></h1></a>
    <h3 style="color:white;" align=center>No files uploaded yet click to upload now!</h3>
</div>
@endif
{{-- <script type="text/javascript">
    $('.imgprev').on('load',function(){
    $value=$(this).attr('src');
    $.ajax({
    type : 'get',
    url : '{{URL::to('imgprev')}}',
    data:{'search':$value},
    success:function(data){
    $('.imgprev').html(data);
    }
    });
    })
    </script>
    <script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script> --}}
@endsection