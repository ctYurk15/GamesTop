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
                    <h1><big id='gamename'>{{$game->name}}</big></h1>
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
                    <h3><big>Developer: </big>{{$game->developer->title}}</h3>
                    <h3><big>Price: </big>${{$game->price}}</h3>
                    @if (Route::has('login'))
                        @auth
                            <button id='buyButton' data-route="{{route('addToCart')}}">Buy</button>
                        @else
                            <h3 style='color: red'>Log into your account for purchase</h3>
                        @endauth
                    @endif
                </div>
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
            <div class="comment-div new-comment-div">
                <form method="post" id='sendCommentForm'>
                    <h3>Your comment</h3>
                    <textarea rows="5" cols="50" class="comment-input" name="commentArea"></textarea>
                    <br><br>
                    <button id="comment-button" data-route="{{route('addComment')}}">Send</button>
                    <br><br>
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
                <table border="0px">
                    <tr>
                        <td width="10%">
                            <div class="comments-profile-div">
                                {{$comment->user->name}}
                                <img src="/images/profile.png" class="comments-profile-image">
                            </div>           
                        </td>
                        <td align="left" valign="top"  width="80%">
                            <div class="comments-content-div">
                                {{$comment->commentText}}
                            </div>
                        </td>
                        <td  width="10%" valign="top" class="comments-date-div">   
                            Коментар було додано<br>
                            {{$comment->created_at}}
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
    </div>
</div>

@endsection


@section('custom_js')
    <script src="/js/gamepage.js"></script>
@endsection