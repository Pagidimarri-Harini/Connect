<?php
$name = "localhost";
$username ="root";
$password ="";
$dbname = "project_db";
$conn = mysqli_connect($name,$username,$password,$dbname);
if (!$conn){
    echo "connection failed";
}
?>
