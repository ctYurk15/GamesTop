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