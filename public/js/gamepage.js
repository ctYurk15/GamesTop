$(document).ready(function(){
    
    //general variables we need for all requests
    var gamename = $("#gamename").text();
    
    //adding comments
    $("#sendCommentForm").submit(function(event){
        event.preventDefault();
        
        var comment = $(".comment-input").val();
        var url = $("#comment-button").attr("data-route");
         
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
            },
            error: function(data){
                console.log(data);
            }
        });
    });
    
    //adding game to cart
    $("#buyButton").on("click", function(){
        
        var url = $(this).attr("data-route");
        
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
                console.log(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    });
    
});