@extends('layouts.layout')

@section('title', __('Main'))

@section('custom_css')
    <link rel="stylesheet" href="/css/slider.css">
    <link rel="stylesheet" href="/css/main.css">
@endsection

@section('content')
<main class='content' style="text-align: center">
    <br>
    <hr>
    <h1>Recent added games</h1>
    <hr>
    <div class="slider1">
        @foreach($new_games as $game)
            <div class="fade item">
                <a href="{{route('gamepage', $game->alias)}}"><img src="/images/{{$game->img}}" style="width:100%"></a>
            </div>
        @endforeach

        <a class="prev" onclick="minusSlide()" style="left: 0">❮</a> 
        <a class="next" onclick="plusSlide()">❯</a>
        
        <div class="slider-dots">
            <span class="slider-dots_item" onclick="currentSlide(1)"></span> 
            <span class="slider-dots_item" onclick="currentSlide(2)"></span> 
            <span class="slider-dots_item" onclick="currentSlide(3)"></span> 
            <span class="slider-dots_item" onclick="currentSlide(4)"></span>
        </div>
    </div>
    <br>
    <hr>
    <h1>8 random games</h1>
    <hr>
    <ul class="products">
       @foreach($random_games as $game)
        <li class="product-wrapper">
            <a href="{{route('gamepage', [$game->alias])}}" class="product">
                <div class="product-photo">
                    <img class = "product_img" src="/images/{{$game->img}}" alt="">
                    <div class="price"><b>{{$game->price}}</b></div>
                </div>
                <p>
                    {{$game->name}}
                </p>
                <div class="layout-buttons">
                    <span class="active icon icon-list"></span>
                    <span class="icon icon-table"></span>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
    <br>
    <hr>
    <h1>Bestsellers</h1>
    <hr>
    <ul class="products">
       @foreach($best_sellers as $game)
        <li class="product-wrapper">
            <a href="{{route('gamepage', [$game->alias])}}" class="product">
                <div class="product-photo">
                    <img class = "product_img" src="/images/{{$game->img}}" alt="">
                    <div class="price"><b>{{$game->price}}</b></div>
                </div>
                <p>
                    {{$game->name}}
                </p>
                <div class="layout-buttons">
                    <span class="active icon icon-list"></span>
                    <span class="icon icon-table"></span>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</main>
@endsection


@section('custom_js')
    <script src="/js/slider.js"></script>
@endsection