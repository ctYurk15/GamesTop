@extends('layouts.layout')

@section('title', __('Goods'))

@section('custom_css')
    <link rel="stylesheet" href="/css/cart.css">
@endsection

@section('content')

<main class='content'>
    
    @if($authorized)
        <div class="goods-div" align="center">
            <br>
            <p class="goods-header">Корзина</p>
            <br>
            @if(count($orders) != 0)
                @foreach($orders as $order)
                    <div class="goods-item">
                        <table border="0px">
                            <tr>
                                <td width="25%">
                                    <a href="{{route('gamepage', $order->game->alias)}}"><img src="/images/{{$order->game->img}}" class="goods-item-image"></a>
                                </td>
                                <td width="60%" align="center">
                                    {{$order->game->name}}
                                </td>
                                <td width="15%" align="right" valign="bottom">
                                    <i class="goods-item-pricetext" id="sumGameText1">11.99$</i><br>
                                    <br>
                                    <button class="goods-item-button" onclick="changeGamesCount(11.99, 1, 'gamesCountText1', 'sumGameText1', 'totalSumText', 'goods-item-pricetext')">+</button>
                                    <b id="gamesCountText1">{{$order->count}}</b>
                                    <button class="goods-item-button" onclick="changeGamesCount(11.99, -1, 'gamesCountText1', 'sumGameText1', 'totalSumText', 'goods-item-pricetext')">-</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endforeach
                <br>
                <p align="right">
                    <i class="goods-item-total-pricetext" id="totalSumText">Разом: 11.99$</i><br>
                    <button class="goods-buybutton"> Купити </button>
                </p>
                <br>


                <script src="/js/gamesCountScript.js"></script>
                <script>updateGoodsSumText('goods-item-pricetext', 'totalSumText');</script>
            @else
                <h3>There`s empty here</h3>
            @endif
        </div>
    @else
        <h3>Log into your account to see your cart</h3>
    @endif
</main>

@endsection