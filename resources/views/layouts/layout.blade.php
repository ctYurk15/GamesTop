
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale = 0.86, maximum-scale=3.0, minimum-scale=0.86'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel='preconnect' href='https://fonts.gstatic.com'>
    <title>GamesTop - @yield('title')</title>
    <link rel='icon' href='images/siteIcon.png' type='image/x-icon'>
    <link rel='stylesheet' href='/css/trystyle.css'>
    <link rel='stylesheet' href='/css/footer.css'>
    <link href='https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,400;0,700;1,300&display=swap' rel='stylesheet'>
</head>
<body>
    
    <div class='page'>
    <header>
        <div>
            <nav>
                <ul class="nav-links">
                    <li>
                        <a href="{{route('main')}}"> Головна </a>
                    </li>
                    <li>
                       <a href="{{route('catalog')}}"> Каталог </a>
                    </li>
                    <li>
                        <a href="{{route('account')}}"> Аккаунт </a>
                       </li>
                    <li>
                        <a href="{{route('goods')}}"> Корзина </a>
                    </li>
                </ul>
                    <div class="burger">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
                <script src="app.js"></script><br>
                <div class = "divform">
                        <img src="/images/Mylogo.png"  width="150px" height="40px" alt="Games Top" class="left-img" />
                        <form class = "searchform">
                            <p><input class="input1" type="search" name="q" placeholder="Пошук по назві"> 
                            <input class="input2" type="submit" value="Знайти"></p>
                        </form>

                </div>

            </nav>

        </div>
    </header>
    
    @yield('content')
        
    <footer>
            <div class="footer-div">
                <hr class="footer-hr">
                
                <table width="100%">
                    <tr>
                        <footer id="myFooter">
                            <div class="container">
                                <ul>
                                    <li><a href="#">Company Information</a></li>
                                    <li><a href="#">Contact us</a></li>
                                    <li><a href="#">Reviews</a></li>
                                    <li><a href="#">Terms of service</a></li>
                                    <div>

                                    </div>
                                </ul>
                            </div>
                            <div class="footer-social">
                                <a href="#" class="social-icons"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="social-icons"><i class="fa fa-google-plus"></i></a>
                                <a href="#" class="social-icons"><i class="fa fa-twitter"></i></a>
                            </div>
                        </footer>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                </table>
            
                <p class="footer-text">Copyright © <time datetime="2020">2020</time> Games Top</p>
                
                
            </div>
        </footer>
    </div>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src='/js/main.js'></script>
</body>
</html>  