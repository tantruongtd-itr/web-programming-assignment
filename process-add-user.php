<?php
// search-task.php
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$userId = mysqli_insert_id($conn);

$hashed_password = hash('sha256', 'password');

$sql = "INSERT INTO users (name, email, username, password, role)
        VALUES ('$name', '$email', '$username', '$hashed_password', '$role')";
mysqli_query($conn, $sql);

if (isset($_POST['department'])) {
    $department = $_POST['department'];
    $sql = "INSERT INTO users_join_departments (userId, departmentId)
            VALUES ('$userId', '$department')";
    mysqli_query($conn, $sql);
}

header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);

echo $xml->asXML();
?>