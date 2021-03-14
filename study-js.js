var cardSide=0; //0 means on card front, 1 on card back
var currentCard=0; //index of current card
var deck = []; //will hold all the cards in the deck
var color; //color of the mark for review star

// loads data into the deck variable (HARDCODED CARDS for now),
// then starts the study session
function load_data_and_start(){
  //first card, front is deck[0][0] and back is deck[0][1], cardSide 2 is wether or not
  //card has been marled for review
  deck.push(["What's the capital of Virginia?","Richmond", false]);
  //second card, front is deck[1][0] and back is deck[1][1]
  deck.push(["What's the capital of North Carolina?","Raleigh", false]);
  // ...
  deck.push(["What's the capital of Colorado?","Denver", false]);

  study();
}


function study(){
  if(deck[currentCard][2] == false){ //not marked for review
    color = '#d9d8d7';
  }
  else { //marked for review
    color = '#f2d774';
  }
  //display where we are in the deck
  document.getElementById("index-display").innerHTML = currentCard+1 + " out of " + deck.length;
  //create the current card
  document.getElementById("card-area").innerHTML =
    "<div id='current-card' class='card' onclick='flip();'>" + deck[currentCard][cardSide] + "</i></div>" +
    "<button id='review-star' class='star' onclick='mark_for_review();' style='color:" + color + "'><i class='fas fa-star fa-1x'></i></button>";
  //document.getElementById("current-card").innerHTML =
  //"<div id='review-star' class='star'><i class='fas fa-star'></i></div>";
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

//called when star is clicked
function mark_for_review(){
  if(deck[currentCard][2] == false){
    deck[currentCard][2] = true;
  }
  else{
    deck[currentCard][2] = false;
  }
  study();
}

