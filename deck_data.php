<?php session_start();
require('connect-db.php');
if(isset($_COOKIE['study-deck']))
{
    global $db;

    // WILL BE DELETED ONCE MAIN PAGE AND LOGIN IN ARE DONE!!
    if(!isset($_SESSION['username']))
    {
        $_SESSION['username'] = "test_user";
    }
    // !!!

    //should probably be checking that all of these are set... ?
    $username = $_SESSION['username'];
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
        $deck[$i][0] = $card[0];
        $deck[$i][1] = $card[1];
        $deck[$i][2] = $card[2];
    }

    echo json_encode($deck);

}
?>