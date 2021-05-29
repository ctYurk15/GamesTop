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