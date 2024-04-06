<?php
// validation.php
session_start();
// Perform your login validation here (e.g., checking credentials from a database).
// For demonstration purposes, let's assume a simple validation where the login fails if the username is not "admin" and the password is not "password".

$username = $_POST['username'];
$password = $_POST['password'];
$_SESSION['username'] = $username; 
$_SESSION['password'] = $password; 

if ($username === 'admin' && $password === 'password') {
    // Successful login
    echo "Login successful!";
    header('Location: index.php');
    exit;
} else {
    // Failed login
    // Redirect back to login.php with username and password
    $_SESSION['login_failed'] = true; 
    $_SESSION['message'] = 'Wrong username or password!'; 
    header('Location: login.php');
    exit;
}
?>
