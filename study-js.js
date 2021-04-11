// Katherine Johnson
//referenced the following tutorial for logic concepts,
// implemented them using my own javascript
// http://www.flashbynight.com/tutes/flashcards/


var cardSide=0; //0 means on card front, 1 on card back
var currentCard=0; //index of current card
var deck = []; //will hold all the cards in the deck
var color; //color of the mark for review star

//loads deck info from the json file
function loadDeck(){
  $.getJSON("study-deck.json", function(data) {
    for(i=0;i<data.study-deck.length;i++){
      deck[i]=[];
      deck[i][0]=data.study-deck[i].front;
      deck[i][1]=data.study-deck[i].back;
      deck[i][2]=data.study-deck[i].review;
    }
  })
}
// loads data into the deck variable,
// then starts the study session
function load_data_and_start(){
  loadDeck();
  study();
}


function study(){
  if(deck[currentCard][2] == 0){ //not marked for review
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

//helper ARROW FUNCTION to increment/decrement varibles
update = (a, b) => a+b;

//called when user clicks the next button
function next(){
  cardSide = 0; //always want to start on front
  if(currentCard+1 < deck.length){
    currentCard = update(currentCard, 1);
    study();
  }
}

//called when user clicks the previous button
function previous(){
  cardSide = 0; //always want to start on front
  if(currentCard-1 > -1){
    currentCard = update(currentCard, -1);
    study();
  }
}

//called when star is clicked
function mark_for_review(){
  if(deck[currentCard][2] == 0){
    deck[currentCard][2] = 1;
  }
  else{
    deck[currentCard][2] = 0;
  }
  study();
}

