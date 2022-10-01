<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "alutransco_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>