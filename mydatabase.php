<?php
$servername="localhost";
$username="root";
$password="";
$dbname="admindata";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  
  }
  if (!defined('base_url')) {
    define('base_url', 'http://localhost/komal/PHP/Adminpanel/adminTemplet/');
}
?>


