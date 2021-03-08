var cardSide=0; //0 means on card front, 1 on card back
var currentCard=0; //index of current card
var deck = []; //will hold all the cards in the deck

// loads data into the deck variable (HARDCODED CARDS for now),
// then starts the study session
function load_data_and_start(){
  //first card, front is deck[0][0] and back is deck[0][1]
  deck.push(["What's the capital of Virginia?","Richmond"]);
  //second card, front is deck[1][0] and back is deck[1][1]
  deck.push(["What's the capital of North Carolina?","Raleigh"]);
  // ...
  deck.push(["What's the capital of Colorado?","Denver"]);

  study();
}


function study(){
  //load_data();
  //display where we are in the deck
  document.getElementById("index-display").innerHTML = currentCard+1 + " out of " + deck.length;
  //create the current card
  document.getElementById("card-area").innerHTML =
    "<div id='current-card' class='card' onclick='flip();'>" + deck[currentCard][cardSide] + "</div>";
}

//called when the user clicks the card area
function flip(){
  if(cardSide == 0){
    cardSide = 1;
    study();
  }
  else {
    cardSide = 0;
    study();
  }
}

//called when user clicks the next button
function next(){
  cardSide = 0; //always want to start on front
  if(currentCard+1 < deck.length){
    currentCard++;
    study();
  }
}

//called when user clicks the previous button
function previous(){
  cardSide = 0; //always want to start on front
  if(currentCard-1 > -1){
    currentCard--;
    study();
  }
}
