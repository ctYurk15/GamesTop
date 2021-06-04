@extends('layouts.layout')

@section('title',  __('Home') )

@section('custom_css')
 <link rel="stylesheet" href="/css/account.css">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <h1 class="Username" id="username">
                        {{$user->name}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        ( {{ __('Logout') }} )
                    </a>
                    </h1>
                    <hr class="liniya">
                    <div id="wrapper">
                        <div id="c1">
                           <a class="Change"> Change Password: </a>
                           <input class="input6" type="Password" name="changepassword" placeholder="12345">
                           <br>
                            <a class="Change"> Change Login: </a>
                            <input class="input7" type="TEXT" name="changeemail" placeholder="your_new_login">
                            <br>
                            <input class="input8" type="submit" value="Apply" data-url="{{route('changeUserData')}}">
                        </div>
                        <div class="buyedkeys" id="c2">
                            <p>{{$user->keys_purchased}}</p>
                            <p>Buyed Keys</p>
                       </div>    
                    </div>
                    <div>
                        <hr class="liniya">
                        <h1 class="Username">Achievements</h1>
                        <hr class="liniya">
                    </div>
                    <ul class="products">
                       <!-- Opened achievements -->
                        @foreach($user->opened_achievments as $achievment)
                            <li class="product-wrapper">
                                <div class="product">
                                    <div class="product-photo">
                                        <img class="product_img" src="/images/achievements/{{$achievment->active_img}}" alt="">
                                        <div class="AchieveInfo">
                                            <p>Task</p>
                                            <hr>
                                            <p>{{$achievment->title}}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <!-- Closed achievements -->
                        @foreach($closed_achievments as $achievment)
                            <li class="product-wrapper">
                                <div class="product">
                                    <div class="product-photo">
                                        <img class="product_img" src="/images/achievements/{{$achievment->unactive_img}}" alt="">
                                        <div class="AchieveInfo">
                                            <p>Task</p>
                                            <hr>
                                            <p>{{$achievment->title}}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
    <script src="/js/account.js"></script>
@endsection
