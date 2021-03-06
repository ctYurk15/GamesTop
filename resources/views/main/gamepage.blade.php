@extends('layouts.layout')

@section('title', $game->name)

@section('custom_css')
<link href='/css/gamepage.css' rel="stylesheet">
@endsection

@section('content')

<div class="general">
    <div id="parent">
        <div id="left">
            <div class="gameAvatarDiv">
              <img src="/images/{{$game->img}}" class="gameavatar">
            </div>
            <div class="text1">
              <h1><big id="gamename">{{$game->name}}</big></h1>
              <h2>
                    <big>Categories:</big> 
                    @foreach($game->categories as $category)
                        @if($loop->last) 
                            {{$category->title}}
                        @else
                            {{$category->title}},
                        @endif
                    @endforeach
                </h2>
              <h3><big>Developer:</big> {{$game->developer->title}}</h3>
              <h3><big>Price: </big>${{$game->price}}</h3>
                @if (Route::has('login'))
                    @auth
                        <button id='buyButton' data-route="{{route('changeCart')}}" data-cart-route="{{route('cart')}}">Buy</button>
                    @else
                        <h3 style='color: red'>Log into your account for purchase</h3>
                    @endauth
                @endif
            </div>
          </div>
        <div id="right">
            <div class="slidr">
                @foreach($game->gallery as $gallery_image)
                    <div class="mySlides">
                        <img src="/images/gallery/{{$gallery_image->img}}" style="width: 100%">
                    </div>
                @endforeach
                   
                
              
                <!-- Thumbnail images -->
                <div class="row">
                    @foreach($game->gallery as $gallery_image)
                        <div class="column">
                            <img class="demo cursor" src="/images/gallery/{{$gallery_image->img}}" style="width:100%" onclick="currentSlide({{$loop->index}}+1)" alt="1">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Container for the image gallery -->

            <script src="/js/gallery.js"></script>
        </div>
    </div>
    <div id="info">
        <div class = "text2">
            <h1>Description</h1>
            <p>{{$game->description}}</p>
        </div>
    </div>
    <br><br>
    @if (Route::has('login'))
        @auth
            <div class="new-comment-div">
                <form method="post" id='sendCommentForm'>
                    <h2> ?????? ????????????????</h2>
                    <textarea rows="5" cols="50" class="comment-input" name="commentArea"></textarea>
                    <br><br><button id="comment-button" name="sendCommentButton" data-route="{{route('addComment')}}">????????????????????</button>
                    <br><br>
                    <h3 id='errorText'></h3>
                    <br>
                </form>
            </div>
        @else
            <h3 style='color: red'>Log into your account to leave the comment</h3>
        @endauth
    @endif
    
    <br><br>
    <div id="comments-div">
        @foreach($game->comments as $comment)
            <div class="comment-div">
                <div class="comments-profile-div">
                    {{$comment->user->name}}
                    <img src="/images/profile.png" class="comments-profile-image">
                </div>
                <div class="comments-content-div">
                   {{$comment->commentText}}
                </div>
                <div class="comments-date-div">
                    ???????????????? ???????? ????????????<br>
                    {{$comment->created_at}}  
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection


@section('custom_js')
    <script src="/js/gamepage.js"></script>
@endsection