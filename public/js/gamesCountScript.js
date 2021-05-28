function updateGoodsSumText(gamesCountTextClass, goodsSumTextId)
{
    var priceEls = document.getElementsByClassName(gamesCountTextClass); //getting games price texts
    var totalPrice = 0;
        
    for (var i = 0; i < priceEls.length; i++) //calculating total price
    {
        var price = parseFloat(priceEls[i].innerText);
        totalPrice += price;
    }
        
    document.getElementById(goodsSumTextId).textContent = "Разом: " + totalPrice + "$"; //showing it
}

function changeGamesCount(gamePrice, changeIndex, gamesCountTextId, gameSumTextId, goodsSumTextId, gamesCountTextClass)
{
    var currentGamesCount = parseInt(document.getElementById(gamesCountTextId).textContent, 10); //getting current games count
    var newGamesCount = currentGamesCount+changeIndex; //calculating new games count
    if(newGamesCount > 0) //if count is correct
    {
        //current game price
        document.getElementById(gamesCountTextId).textContent = newGamesCount; //count of game       
        document.getElementById(gameSumTextId).textContent = (newGamesCount * gamePrice) + "$"; //price of games   
        
        //all games price
        updateGoodsSumText(gamesCountTextClass, goodsSumTextId);
    }
}