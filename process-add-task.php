<?php
// search-task.php
session_start();
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

$name = $_POST['name'];
$description = $_POST['description'];
$deadline = $_POST['deadline'];
$department = $_POST['department'];
$assignedTo = $_POST['assignedTo'];
$createdBy = $_SESSION['id'];
$sql = "INSERT INTO tasks (name, description, deadline, createdBy, assignedTo)
        VALUES ('$name', '$description', '$deadline', $createdBy, $assignedTo)";

mysqli_query($conn, $sql);

header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);

echo $xml->asXML();
?>