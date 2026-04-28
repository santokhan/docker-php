<?php

$host = "db";        // Docker service name
$user = "root";
$pass = "root";
$db   = "app";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully!";