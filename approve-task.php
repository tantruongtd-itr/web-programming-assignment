<?php
session_start();
include_once('./includes/connect_database.php');

$taskId = $_GET['task_id'];

$sql = "UPDATE tasks
SET reviewStatus = 'Approved'
WHERE id = $taskId";
mysqli_query($conn, $sql);


header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);

// Output the XML
echo $xml->asXML();
?>