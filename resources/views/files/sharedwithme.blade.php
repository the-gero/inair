@extends('layouts.app')
@section('content')


@if(count($files)>0)
<div class="row">
@foreach ($files as $file)


<div class='col-md-3' style="height:25vh; " >
        <div class="card">
        <div class="card-header text-center" style="height:10vh;">{{$file->file_shared }} 
            <a href="/file/m2t/{{$file->id}}" >
                <i class="fa fa-trash" onclick="return confirm('Are you sure to delete this file ?');"></i>
            </a>
            <a href="/file/download/{{$file->id}}" >
                <i class="fa fa-download" onclick="return confirm('Are you sure to Download this file ?');"></i>
            </a>
        </div>
            <div class="card-body" >
                @if($file->type == "jpg")
                    {{-- <img src="{{ asset("storage/$file->file")}}">   --}} 
                    <img class="imgprev" src="{{url('/files'.'/images'.'/'.$file->file)}}{{-- {{ url('storage/'.Auth::id().'/files'.'/'.$file->file) }} --}}" alt="{{$file->file }}" >
                @endif
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