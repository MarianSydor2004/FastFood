$(function() {
    var cards = $(".card-container .card");
    var cardWidth = cards.first().outerWidth(true);
    var containerWidth = $(".card-container").outerWidth();
    var numCards = Math.floor(containerWidth / cardWidth);
    var numVisibleCards = numCards;
    var totalCards = cards.length;
  
    function scrollCards() {
      cards.slice(0, numVisibleCards).appendTo(".card-container");
      $(".card-container").animate(
        {
          scrollLeft: "+=" + cardWidth,
        },
        400,
        function() {
          setTimeout(scrollCards, 2000);
        }
      );
    }
  
    if (totalCards > numVisibleCards) {
      for (var i = 0; i < numCards; i++) {
        cards.eq(i).clone().appendTo(".card-container");
      }
  
      setTimeout(scrollCards, 2000);
    }
  });

  


 