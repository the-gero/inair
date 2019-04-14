@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header text-center" style="height:10vh;background:grey;"> <h2 style="color:black">Welcome to InAir</h2>
        
    </div>
        <div class="card-body" style="background:#55585c80" >
            <div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset("students.jpg") }}" alt="Los Angeles" width="1100" height="500">
        <div class="carousel-caption">
            <h3 style="color:lightpink">We provide cloud strorage and sharing for students </h3>
          <p>Get started now!</p>
        </div>   
      </div>
      <div class="carousel-item">
        <img src="{{ asset("security.png") }}" alt="Chicago" width="1100" height="500">
        <div class="carousel-caption">
          <h3>Your files are secure</h3>
          <p>Get your ID in seconds and share files with your friends !</p>
        </div>   
      </div>
      <div class="carousel-item">
        <img src="{{ asset("multidevice.png") }}" alt="New York" width="1100" height="500">
        <div class="carousel-caption">
          <h3>New York</h3>
          <p>We love the Big Apple!</p>
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
        </div>
    </div>



    
    
                   
@endsection
