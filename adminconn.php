<?php
$servername="localhost";
$username="root";
$password="";
$dbname="admindata";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
echo "connection fail...." .$conn->$connect_error;
}

?>