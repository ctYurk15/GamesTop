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
                                    <i class="goods-item-pricetext" id="sumGameText{{$loop->index}}">${{$order->total_price()}}</i><br>
                                    <br>
                                    <button class="goods-item-button" data-route="{{route('changeCart')}}">+</button>
                                    <b id="gamesCountText{{$loop->index}}">{{$order->count}}</b>
                                    <button class="goods-item-button" data-route="{{route('changeCart')}}">-</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endforeach
                <br>
                <p align="right">
                    <i class="goods-item-total-pricetext" id="totalSumText">Разом: ${{$cartSum}}</i><br>
                    <button class="goods-buybutton" data-route="{{route('purchase')}}"> Купити </button>
                </p>
                <br>
            @else
                <h3>There`s empty here</h3>
            @endif
        </div>
    @else
        <h3>Log into your account to see your cart</h3>
    @endif
</main>
<div class="block">
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur tempore facere quam distinctio 
    laborum ducimus dolorum pariatur explicabo impedit suscipit dolorem eveniet atque, incidunt sapiente ipsam ut? Magni 
    doloremque a quidem porro ut cupiditate reiciendis at consequatur sed facilis distinctio, tempore odio eum. Possimus, 
    recusandae. Vero debitis sint consectetur error deserunt iste autem deleniti aperiam, modi fugit nisi nostrum natus fugiat
     hic sequi repudiandae. Quidem veniam natus architecto ab illo consequuntur reprehenderit quos, modi illum optio amet voluptate quia culpa vel 
     magni quibusdam. Dicta ullam repudiandae incidunt. Tempora, libero corporis! Veniam ipsa optio molestiae? Nesciunt minima ab ipsam ipsa eum?
     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur tempore facere quam distinctio 
    laborum ducimus dolorum pariatur explicabo impedit suscipit dolorem eveniet atque, incidunt sapiente ipsam ut? Magni 
    doloremque a quidem porro ut cupiditate reiciendis at consequatur sed facilis distinctio, tempore odio eum. Possimus, 
    recusandae. Vero debitis sint consectetur error deserunt iste autem deleniti aperiam, modi fugit nisi nostrum natus fugiat
     hic sequi repudiandae. Quidem veniam natus architecto ab illo consequuntur reprehenderit quos, modi illum optio amet voluptate quia culpa vel 
     magni quibusdam. Dicta ullam repudiandae incidunt. Tempora, libero corporis! Veniam ipsa optio molestiae? Nesciunt minima ab ipsam ipsa eum?
     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur tempore facere quam distinctio 
    laborum ducimus dolorum pariatur explicabo impedit suscipit dolorem eveniet atque, incidunt sapiente ipsam ut? Magni 
    doloremque a quidem porro ut cupiditate reiciendis at consequatur sed facilis distinctio, tempore odio eum. Possimus, 
    recusandae. Vero debitis sint consectetur error deserunt iste autem deleniti aperiam, modi fugit nisi nostrum natus fugiat
     hic sequi repudiandae. Quidem veniam natus architecto ab illo consequuntur reprehenderit quos, modi illum optio amet voluptate quia culpa vel 
     magni quibusdam. Dicta ullam repudiandae incidunt. Tempora, libero corporis! Veniam ipsa optio molestiae? Nesciunt minima ab ipsam ipsa eum?
     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur tempore facere quam distinctio 
    laborum ducimus dolorum pariatur explicabo impedit suscipit dolorem eveniet atque, incidunt sapiente ipsam ut? Magni 
    doloremque a quidem porro ut cupiditate reiciendis at consequatur sed facilis distinctio, tempore odio eum. Possimus, 
    recusandae. Vero debitis sint consectetur error deserunt iste autem deleniti aperiam, modi fugit nisi nostrum natus fugiat
     hic sequi repudiandae. Quidem veniam natus architecto ab illo consequuntur reprehenderit quos, modi illum optio amet voluptate quia culpa vel 
     magni quibusdam. Dicta ullam repudiandae incidunt. Tempora, libero corporis! Veniam ipsa optio molestiae? Nesciunt minima ab ipsam ipsa eum?
     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur tempore facere quam distinctio 
    laborum ducimus dolorum pariatur explicabo impedit suscipit dolorem eveniet atque, incidunt sapiente ipsam ut? Magni 
    doloremque a quidem porro ut cupiditate reiciendis at consequatur sed facilis distinctio, tempore odio eum. Possimus, 
    recusandae. Vero debitis sint consectetur error deserunt iste autem deleniti aperiam, modi fugit nisi nostrum natus fugiat
     hic sequi repudiandae. Quidem veniam natus architecto ab illo consequuntur reprehenderit quos, modi illum optio amet voluptate quia culpa vel 
     magni quibusdam. Dicta ullam repudiandae incidunt. Tempora, libero corporis! Veniam ipsa optio molestiae? Nesciunt minima ab ipsam ipsa eum?
     Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur tempore facere quam distinctio 
    laborum ducimus dolorum pariatur explicabo impedit suscipit dolorem eveniet atque, incidunt sapiente ipsam ut? Magni 
    doloremque a quidem porro ut cupiditate reiciendis at consequatur sed facilis distinctio, tempore odio eum. Possimus, 
    recusandae. Vero debitis sint consectetur error deserunt iste autem deleniti aperiam, modi fugit nisi nostrum natus fugiat
     hic sequi repudiandae. Quidem veniam natus architecto ab illo consequuntur reprehenderit quos, modi illum optio amet voluptate quia culpa vel 
     magni quibusdam. Dicta ullam repudiandae incidunt. Tempora, libero corporis! Veniam ipsa optio molestiae? Nesciunt minima ab ipsam ipsa eum?
</div>
@endsection


@section('custom_js')
    <script src="/js/cart.js"></script>
@endsection