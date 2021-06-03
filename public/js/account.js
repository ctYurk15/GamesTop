$(document).ready(function(){
    
    $(".input8").on("click", function(){
        
        var newlogin = $(".input7").val();
        var newpass = $(".input6").val();
        var url = $(this).attr("data-url");
        
        $.ajax({
            url: url,
            type: "POST",
            data: {
                newlogin: newlogin,
                newpass: newpass,
                url: url
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data)
            {
                console.log(data);
                
                //login
                if(data.result_login == true)
                {
                    //updating info
                    if(newlogin != "")
                    {
                        $("#username").text(newlogin);
                    }
                }
                else if(data.result_login != "")
                {
                    alert(data.result_login);
                }
                
                //password
                if(data.result_password == true)
                {
                    alert("Success!");
                }
                else if(data.result_password != "")
                {
                    alert(data.result_password);
                }
                
                $(".input7").val("");
                $(".input6").val("");
            }
        });
        
    });
    
});