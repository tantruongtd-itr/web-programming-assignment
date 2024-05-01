<?php
// search-task.php
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

$name = $_POST['name'];
$description = $_POST['description'];
$sql = "INSERT INTO departments (name, description)
        VALUES ('$name', '$description')";
mysqli_query($conn, $sql);

header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);

echo $xml->asXML();
?>