<?php
//Elena Lensink
// hostname

// [Spring 2021] connecting to DB on CS server
 $hostname = 'usersrv01.cs.virginia.edu';
 $dbname = 'eal8hs';
 $username = 'eal8hs';
 $password = 'Fl@shy2021';


// DSN (Data Source Name) specifies the host computer for the MySQL database
// and the name of the database. If the MySQL database is running on the same server
// as PHP, use the localhost keyword to specify the host computer

$dsn = "mysql:host=$hostname;dbname=$dbname";

// To connect to a MySQL database named web4640, need three arguments:
// - specify a DSN, username, and password

// Create an instance of PDO (PHP Data Objects) which connects to a MySQL database
// (PDO defines an interface for accessing databases)
// Syntax:
//    new PDO(dsn, username, password);


/** connect to the database **/
try
{
    //$db = new PDO("mysql:host=$hostname;dbname=$dbname, $username, $password);
    $db = new PDO($dsn, $username, $password);

    // display a message to let us know that we are connected to the database
    //echo "Connected";
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
    // Call a method from any object, use the object's name followed by -> and then method's name
    // All exception objects provide a getMessage() method that returns the error message
    $error_message = $e->getMessage();
    echo "Error";
}
catch (Exception $e)       // handle any type of exception
{
    $error_message = $e->getMessage();
    echo "error2";
}

?>
