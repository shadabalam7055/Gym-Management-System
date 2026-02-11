<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "allan_fitness_club";

// Create connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// Set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($conn) {
    // Connection successful
} else {
    die("Connection failed: " . $conn->errorInfo());
} 