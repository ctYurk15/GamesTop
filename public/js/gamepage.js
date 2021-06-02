$(document).ready(function(){
    
    //general variables we need for all requests
    var gamename = $("#gamename").text();
    
    //adding comments
    $("#sendCommentForm").submit(function(event){
        event.preventDefault();
        
        var comment = $(".comment-input").val();
        var url = $("#comment-button").attr("data-route");
         
        if(comment != "")
        {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    commentText: comment,
                    gamename: gamename,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    //console.log(data);
                    $("#comments-div").html(data);
                    $("#sendCommentForm")[0].reset();
                    $("#errorText").text("");
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
        else
        {
            $("#errorText").text("You can`t leave empty comment");
        }
    });
    
    //adding game to cart
    $("#buyButton").on("click", function(){
        
        var url = $(this).attr("data-route");
        var next_url = $(this).attr("data-cart-route");
        
        $.ajax({
            url: url,
            type: "POST",
            data: {
                gamename: gamename
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                //console.log(data);
                
                if(data.Result)
                {
                    location.replace(next_url);
                }
                else 
                {
                    alert("Sorry, there`s no more keys for the game");
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    });
    
});