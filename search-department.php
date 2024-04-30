<?php
// search-task.php
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

$sql = "SELECT id, name, description FROM departments";

$result = mysqli_query($conn, $sql);

// echo $result

header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);


if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    while ($row) {
        $department = $xml->addChild('department');
        $department->addChild('id', $row['id']);
        $department->addChild('name', $row['name']);
        $department->addChild('description', $row['description']);
        $row = mysqli_fetch_assoc($result);
    }
}

// Output the XML
echo $xml->asXML();
?>