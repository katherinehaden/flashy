<?php

session_start();
require('connect-db.php');

// did we get here by clicking on a deck on the study mainpage??
// if so, the study-deck cookie will be set
if(isset($_COOKIE['study-deck']))
{
    global $db;

    //might want to check that all of these are set...
    $username = $_SESSION['user'];
    $deck_title = $_COOKIE['study-deck'];

    $query = "SELECT front, back, review FROM card WHERE username = :u AND deck_title = :dt";

    $statement = $db->prepare($query);
    $statement->bindValue(':u', $username);
    $statement->bindValue(':dt', $deck_title);
    $statement->execute();

    $result = $statement->fetchAll();

    $statement->closeCursor();

    $deck = array();
    foreach($result as $i => $card)
    {
        $deck[$i][0] = $card[0]; //front of card
        $deck[$i][1] = $card[1]; //back of card
        $deck[$i][2] = $card[2]; //is the card marked for review?? (0 or 1)
    }
    echo json_encode($deck);
}
else { //we didn't get here by clicking on a deck from study main page...

    $deck = array();
    $deck[0][0] = "Oh no, no deck has been loaded!!";
    $deck[0][1] = "Oh no, no deck has been loaded!!";
    $deck[0][2] = 0;

    echo json_encode($deck);
}
?>