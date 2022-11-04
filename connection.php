<?php 
$servername= "localhost";
$username="root";
$password = "";
$db="smart";

$conn = mysqli_connect($servername,$username,$password,$db);

if(!$conn){
    die("connection Failed: ".mysqli_connect_error());
}
?>