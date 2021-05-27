@extends('layouts.layout')

@section('title', $game->name)

@section('custom_css')
<link href='/css/gamepage.css' rel="stylesheet">
@endsection

@section('content')

<div class="general">
    <div id="parent">
        <div id="left">
            <div id="upperDiv">
                <img src="/images/{{$game->img}}" width="300" class="gameavatar">
            </div>
            <div id="lowerDiv">
                <div class = "text1">
                    <h1><big>{{$game->name}}</big></h1>
                    <h2><big>Categories:</big> хуйня</h2>
                    <h3><big>Developer: </big>{{$game->developer->title}}</h3>
                    <h3><big>Price: </big>${{$game->price}}</h3>
                    <button id='buyButton'>Buy</button>
                </div>
            </div>
        </div>
        <div id="right">
            <div class="slidr">
                <div class="mySlides">
                    <img src="/images/dota21.png" style="width: 100%">
                </div>
              
                <div class="mySlides">
                    <img src="/images/dota22.png" style="width: 100%">
                </div>
              
                <div class="mySlides">
                    <img src="/images/dota23.jpg" style="width: 100%">
                </div>
              
                <div class="mySlides">
                    <img src="/images/dota24.jpg" style="width: 100%">
                </div>
              
                <div class="mySlides">
                    <img src="/images/dota25.jpg" style="width: 100%">
                </div>
              
                <div class="mySlides">
                    <img src="/images/dota26.jpg" style="width: 100%">
                </div>
              
                <!-- Thumbnail images -->
                <div class="row">
                  <div class="column">
                    <img class="demo cursor" src="/images/dota21.png" style="width:100%" onclick="currentSlide(1)" alt="1">
                  </div>
                  <div class="column">
                    <img class="demo cursor" src="/images/dota22.png" style="width:100%" onclick="currentSlide(2)" alt="2">
                  </div>
                  <div class="column">
                    <img class="demo cursor" src="/images/dota23.jpg" style="width:100%" onclick="currentSlide(3)" alt="3">
                  </div>
                  <div class="column">
                    <img class="demo cursor" src="/images/dota24.jpg" style="width:100%" onclick="currentSlide(4)" alt="4">
                  </div>
                  <div class="column">
                    <img class="demo cursor" src="/images/dota25.jpg" style="width:100%" onclick="currentSlide(5)" alt="5">
                  </div>
                  <div class="column">
                    <img class="demo cursor" src="/images/dota26.jpg" style="width:100%" onclick="currentSlide(6)" alt="6">
                  </div>
                </div>
                </div>
            <!-- Container for the image gallery -->

            <script src="/js/gallery.js"></script>
        </div>
    </div>
    <div id="info">
        <div class = "text2">
            <h1>Опис гри</h1>
            <p>{{$game->description}}</p>
        </div>
    </div>
</div>

@endsection