@extends('layouts.layout')

@section('title', 'Каталог')

@section('custom_css')
<link href="/css/catalog.css" rel='stylesheet'>
@endsection

@section('content')

<main class='content'>
    <div class="checkboxdiv">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <span class="j_title">Жанри</span>

        <span class="bigcheck">
          <label class="bigcheck">
            <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
            <span class="bigcheck-target"></span>
            Гонки
          </label>
        </span>

        <span class="bigcheck">
          <label class="bigcheck">
            <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
            <span class="bigcheck-target"></span>
            Інді
          </label>
        </span>

        <span class="bigcheck">
          <label class="bigcheck">
            <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
            <span class="bigcheck-target"></span>
            Казуальні
          </label>
        </span>

        <span class="bigcheck">
          <label class="bigcheck">
            <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
            <span class="bigcheck-target"></span>
            Онлайн
          </label>
        </span>

        <span class="bigcheck">
          <label class="bigcheck">
            <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
            <span class="bigcheck-target"></span>
            Пригодницькі
          </label>
        </span>

        <span class="bigcheck">
          <label class="bigcheck">
            <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
            <span class="bigcheck-target"></span>
            Рольові
          </label>
        </span>

        <span class="bigcheck">
          <label class="bigcheck">
            <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
            <span class="bigcheck-target"></span>
            Симулятори
          </label>
        </span>

        <span class="bigcheck">
            <label class="bigcheck">
              <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
              <span class="bigcheck-target"></span>
              Спорт
            </label>
          </span>

          <span class="bigcheck">
            <label class="bigcheck">
              <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
              <span class="bigcheck-target"></span>
              Стратегії
            </label>
          </span>

          <span class="bigcheck">
            <label class="bigcheck">
              <input type="checkbox" class="bigcheck" name="cheese" value="yes"/>
              <span class="bigcheck-target"></span>
              Екшн
            </label>
          </span>

          <span class="j_title">Сортування</span><br>
          <select class="src">
            <option value="#" selected>За популярністю</option>
            <option value="#">Від дешевих до дорогих</option>
            <option value="#">Від дорогих до дешевих</option>
            <option value="#">За датою виходу</option>
            <option value="#">За алфавітом</option>
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
    </div>



    <!-------------- Try Checkbox ------------------>

    <ul class="products">
       @foreach($games as $game)
        <li class="product-wrapper">
            <a href="{{route('gamepage', [$game->id])}}" class="product">
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