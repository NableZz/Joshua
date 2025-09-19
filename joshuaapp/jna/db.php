<?php
// db.php

$host = 'localhost'; // Database host

$user = 'root'; // Database username (leave empty)
$pass = ''; // Database password (leave empty)
$db   = 'jna'; // Database name

// Create connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Uncomment the line below to test the connection
// echo "Connected successfully!";
?>
