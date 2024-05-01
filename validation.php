<?php
// validation.php
session_start();
include_once('includes/connect_database.php');
// Perform your login validation here (e.g., checking credentials from a database).
// For demonstration purposes, let's assume a simple validation where the login fails if the username is not "admin" and the password is not "password".


// Get the raw POST data
$jsonData = file_get_contents('php://input');

// Decode JSON data
$data = json_decode($jsonData);

// Access data
$username = $data->username;
$password = $data->password;

$sql = "SELECT id, name, role FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);


header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');

if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Add the isSuccess and user elements
    $xml->addChild('isSuccess', true);
    $user = $xml->addChild('user');
    
    // Add user details
    $user->addChild('id', $row['id']);
    $user->addChild('name', $row['name']);
    
    $_SESSION['id'] = $row['id'];
    $_SESSION['role'] = $row['role'];
} else {
    // Add the isSuccess and message elements
    $xml->addChild('isSuccess', false);
    $xml->addChild('message', 'Wrong username or password!');
}

// Output the XML
echo $xml->asXML();
?>
