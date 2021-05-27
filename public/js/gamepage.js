$(document).ready(function(){
    
    $("#sendCommentForm").submit(function(event){
        event.preventDefault();
        
        var comment = $(".comment-input").val();
        var gamename = $("#comment-button").attr("data-game");
        var url = $("#comment-button").attr("data-route");
        var user = $("#comment-button").attr("data-user");
        
        //console.log(comment+" "+gamename+" "+url+" "+user);
        
        $.ajax({
            url: url,
            type: "POST",
            data: {
                commentText: comment,
                gamename: gamename,
                user: user
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
    
});