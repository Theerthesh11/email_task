<?php
//error reporting
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$db="inboxflow_db";
// Create connection
$conn =new mysqli($servername, $username, $password,$db);
// Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . mysqli_connect_error());
// }else{
// echo "Connected successfully";
// }
?>
