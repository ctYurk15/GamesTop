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
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <h1 class="Username">Account Username</h1>
                    <hr class="liniya">
                    <div id="wrapper">
                        <div id="c1">
                           <a class="Change"> Change Password: </a>
                           <input class="input6" type="Password" name="changepassword" placeholder="12345">
                           <br>
                            <a class="Change"> Change Email: </a>
                            <input class="input7" type="TEXT" name="changeemail" placeholder="dsatd@gmail.com">
                            <br>
                            <input class="input8" type="submit" value="Apply">
                        </div>
                        <div class="buyedkeys" id="c2">
                            <p>5
                           <p>Buyed Keys
                       </div>    
                    </div>
                    <div>
                        <hr class="liniya">
                        <h1 class="Username">Achiements</h1>
                        <hr class="liniya">
                    </div>
                    <ul class="products">
                        <li class="product-wrapper">
                            <div class="product">
                                <div class="product-photo">
                                    <img class = "product_img" src="/images/achievements/achievement1.png" alt="">
                                    <div class="AchieveInfo">
                                        <p>Завдання</p>
                                        <hr>
                                        <p>Потрать більше 100$</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
