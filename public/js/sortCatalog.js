$('document').ready(function(){
    
    //sorting games
    $("#sortButton").on("click", function(){
        var select = $("#sortingSelect");
        
        var orderBy = select.val(); //how to sort games
        
        var categories = []; //which categories user selected
        $(".category").each(function(index){
            if($(this).prop("checked")) //if we selected the checkbox
            {
                categories.push($(this).attr('name'));
            }
        });
        
        var url = ""+$(this).attr("data-route");
        
        $.ajax({
            url: url,
            type: "GET",
            data: {
                orderBy: orderBy,
                categories: categories
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                //console.log(data);
                $(".products").html(data); 
                
                //changing url 
                let positionParameters = location.pathname.indexOf('?');
                let url = location.pathname.substring(positionParameters, location.pathname.length);
                let newUrl = url + '?';
                
                //sorting param
                newUrl += 'orderBy='+orderBy;
                
                //categories
                categories.forEach(function(item){
                    newUrl += "&categories[]="+item;
                });
                
                history.pushState({}, '', newUrl);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});