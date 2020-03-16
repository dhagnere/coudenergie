<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'dbs306111';

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);
mysqli_set_charset($conn,"utf8");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>