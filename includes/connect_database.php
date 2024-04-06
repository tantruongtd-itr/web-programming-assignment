<?php
// Database credentials
$server_name = "localhost";
$username = "root";
$password = "password";
$database = "web_programming_assignment";

// Create connection
$conn = new mysqli($server_name, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>