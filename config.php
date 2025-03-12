<?php
// Database configuration
$host = "localhost";
$dbname = "modern_login";
$username = "root"; // Change to your DB username
$password = ""; // Change to your DB password

// Create connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>