@extends('layouts.layout')

@section('title',  __('Catalog'))

@section('custom_css')
<link href="/css/catalog.css" rel='stylesheet'>
@endsection

@section('content')

<main class='content'>
    <div class="checkboxdiv">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <span class="j_title">{{__('Categories')}}</span>

        @foreach($categories as $category)
            <span class="bigcheck">
              <label class="bigcheck">
                <input type="checkbox" class="bigcheck category" name="{{$category->title}}" value="yes"/>
                <span class="bigcheck-target"></span>
                {{$category->title}}
              </label>
            </span>
        @endforeach

          <span class="j_title">Сортування</span><br>
        <select class="src" id='sortingSelect'>
            <option value="popularity" selected>By popularity</option>
            <option value="price-low-high">By price from low to high</option>
            <option value="price-high-low">By price from high to low</option>
            <option value="name-a-z">By name A-Z</option>
            <option value="name-z-a">By name Z-A</option>
        </select><br>

        <span class="j_title">Ціна до, грн</span><br>
        <div class="form-price">
            <div class="form-group">
                <input type="text" placeholder="0" class="form-control form-control-min">
            </div>
            <i>-</i>
            <div class="form-group">
                <input type="text" placeholder="2000" class="form-control form-control-max">
            </div>
        </div>
        <button id='sortButton' data-route="{{route('catalog')}}">Sort</button>
    </div>



    <!-------------- Try Checkbox ------------------>

    <ul class="products">
       @foreach($games as $game)
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
<script src='/js/sortCatalog.js'></script>
@endsection