<?php
// search-task.php
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

$role = "";
if (isset($_GET['role'])) {
    $role = $_GET['role'];
}
$userId = "";
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
}
$sql = "UPDATE users
SET role = '$role'
WHERE id = $userId";

// echo $search;

$result = mysqli_query($conn, $sql);


header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);

// Output the XML
echo $xml->asXML();
?>