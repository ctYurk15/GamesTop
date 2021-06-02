$(document).ready(function(){
    
    function reload_js(src) {
        $('script[src="' + src + '"]').remove();
        $('<script>').attr('src', src).appendTo('head');
    }
    
    var readyToSendRequest = true;
    
    //update cart
    $(".goods-item-button").on("click", function(){
        var gamename = $(this).parent().prev().text();
        var changeCount = parseInt($(this).text()+"1");
        var url = $(this).attr("data-route");

        if(readyToSendRequest) //waiting till previous request gets done
        {
            readyToSendRequest = false;
            
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    gamename: gamename,
                    changeCount: changeCount
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data)
                {
                    //console.log(data);
                    
                    //gamkeys is enough 
                    if(data != false)
                    {
                        $(".goods-div").html(data);
                        reload_js('/js/cart.js'); //reloading js
                        
                    }
                    else 
                    {
                        alert("Sorry, there`s no more keys for the game");
                    }
                    
                    readyToSendRequest = true;
                },
                error: function(data)
                {
                    console.log(data);
                    readyToSendRequest = true;
                }
            });
        }
    });
    
    //purchase cart
    $(".goods-buybutton").on("click", function(){
        var url = $(this).attr("data-route");
        
        if(readyToSendRequest) //waiting till previous request gets done
        {
            readyToSendRequest = false;
            
            $.ajax({
                url: url,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data)
                {
                    console.log(data);
                    $(".goods-div").html(data);
                    readyToSendRequest = true;
                },
                error: function(data)
                {
                    console.log(data);
                    readyToSendRequest = true;
                }
            });
        }
    });
});