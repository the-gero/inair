@extends('layouts.app')
@section('content')

    <div id="demo" class="carousel slide p-2 bd-highlight" data-ride="carousel" style="max-height: 60vh;max-width: 50vw;" align=center>
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>
      <div class="carousel-inner" style="max-height: 60vh;max-width: 50vw;border-radius:10px;">
        <div class="carousel-item active">
          <img src="{{ asset("students.jpg") }}" alt="Los Angeles" style="height: 60vh;width: 50vw;border-radius:10px;">
          <div class="carousel-caption">
              <h3 style="background:black; border-radius:3px;">We provide cloud strorage and sharing for students </h3>
            <p style="background:black; border-radius:3px;">Get started now!</p>
          </div>   
        </div>
        <div class="carousel-item">
          <img src="{{ asset("security.png") }}" alt="Chicago" style="height: 60vh;width: 50vw; border-radius:10px;">
          <div class="carousel-caption">
            <h3 style="background:black; border-radius:3px;">Your files are secure</h3>
            <p style="background:black; border-radius:3px;">Get your ID in seconds and share files with your friends !</p>
          </div>   
        </div>
        <div class="carousel-item">
          <img src="{{ asset("multidevice.png") }}" alt="Access From any device" style="height: 60vh;width: 50vw;border-radius:10px;">
          <div class="carousel-caption">
            <h3 style="background:black; border-radius:3px;">Access from any device</h3>
            <p style="background:black; border-radius:3px;">Android, iOS , Windows , Linux ! </p>
            <p style="background:black; border-radius:3px;">Anytime anywhere</p>
          </div>   
        </div>
      </div>
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>


    
    
                   
@endsection
