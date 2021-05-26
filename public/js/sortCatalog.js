$('document').ready(function(){
    
    //sorting games
    $("#sortButton").on("click", function(){
        var select = $("#sortingSelect");
        
        var orderBy = select.val();
        var url = ""+$(this).attr("data-route");
        
        $.ajax({
            url: url,
            type: "GET",
            data: {
                orderBy: orderBy
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                //console.log(data);
                $(".products").html(data);
                
                let positionParameters = location.pathname.indexOf('?');
                let url = location.pathname.substring(positionParameters, location.pathname.length);
                let newUrl = url + '?';
                newUrl += 'orderBy='+orderBy;
                history.pushState({}, '', newUrl);
            }
        });
    });
});