
<?php
//header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');

$postdata = file_get_contents("php://input");


$request = json_decode($postdata);

$data =[];
$sqlentry = [];
$count = 0;
foreach($request as $k => $v)
{
    $temp = "$k => $v";
    $data[0]['post_'.$k] = $v;
    $sqlentry[$count] = $v;
    $count++;
}

$current_date = date("Y-m-d");

echo json_encode(['content'=>$data, 'response_on'=>$current_date]);
require('connect-db.php');
    $query = "INSERT INTO feedback (rating, feedback) VALUES (:rating, :feedback)";

    $statement = $db->prepare($query);
    $statement->bindValue(':rating', $sqlentry[0]);
    $statement->bindValue(':feedback', $sqlentry[1]);
    $statement->execute();

    $statement->closeCursor();

?>
