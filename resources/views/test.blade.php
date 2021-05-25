<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<style>
    
    img
    {
        width: 50%;
    }
    
</style>
<body>
    <h1>All games</h1>
    <table border='1px'>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>price</td>
            <td>img</td>
            <td>description</td>
        </tr>
    @foreach($games as $game)
        <tr>
            <td>{{$game->id}}</td>
            <td>{{$game->name}}</td>
            <td>${{$game->price}}</td>
            <td><img src="/images/{{$game->img}}"></td>
            <td>{{$game->description}}</td>
        </tr>
    @endforeach
    </table> 
</body>
</html>