<?php 	

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "book_republic";

// db connection
$connection = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connection->connect_error) {
  die("Connection Failed : " . $connection->connect_error);
} else {
  //echo "Successfully connected";
}

?>