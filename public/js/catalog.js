$('document').ready(function(){
    
    //updating filter ui
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    
    var orderBy = urlParams.get("orderBy");
    var minPrice = urlParams.get("minPrice");
    var maxPrice = urlParams.get("maxPrice");
    var categories = urlParams.getAll("categories[]");
    
    //if sorting order is defined
    if(orderBy != null) 
    {
        $("#sortingSelect").children("[value='"+orderBy+"']").prop("selected", true); //selecting option needed
    }
    
    //if selected some categories
    if(categories.length > 0)
    {
        categories.forEach(function(item){
            $(".category[name='"+item+"']").prop("checked", true);
        });
    }
    
    //if price filter were filled
    if(minPrice != null && !isNaN(minPrice))
    {
        $(".form-control-min").val(minPrice);
    } 
    if(maxPrice != null && !isNaN(maxPrice))
    {
        $(".form-control-max").val(maxPrice);
    }
    
    //pagination
    var maxGamesShown = 0;
    
    function paginate(games)
    {
        //increasing limit of games
        maxGamesShown += games;
        
        //turning of hidden class
        for(var i = 0; i < maxGamesShown; i++)
        {
            $(".product-wrapper").eq(i).removeClass("hidden");
        }
        
        return maxGamesShown >= $(".product-wrapper").length;
    }
    
    //start pagination
    paginate(9);
    
    
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
        
        var minPrice = parseFloat($(".form-control-min").val());
        var maxPrice = parseFloat($(".form-control-max").val());
        
        if(minPrice > maxPrice) //if user typed min greater than max, we swap it
        {
            [minPrice, maxPrice] = [maxPrice, minPrice];
            
            $(".form-control-min").val(minPrice);
            $(".form-control-max").val(maxPrice);
        }
        
        //console.log(minPrice+" "+maxPrice);
        
        var url = ""+$(this).attr("data-route");
        
        $.ajax({
            url: url,
            type: "GET",
            data: {
                orderBy: orderBy,
                categories: categories,
                minPrice: minPrice,
                maxPrice: maxPrice
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
                
                //prices
                if(minPrice != null && !isNaN(minPrice)) 
                {
                    newUrl += "&minPrice="+minPrice;
                }
                if(maxPrice != null && !isNaN(maxPrice)) 
                {
                    newUrl += "&maxPrice="+maxPrice;
                }
                
                history.pushState({}, '', newUrl);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    
    //pagination
    $("#paginationText").on("click", function(){
        //pagination by itself
        var over = paginate(9);
        
        if(over) //does we still need this text
        {
            $(this).addClass("hidden");
        }
    });
});