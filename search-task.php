<?php
// search-task.php
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$sql = "";
if ($search !== "") {
    $sql = "SELECT id, name, description, status FROM tasks 
    WHERE name LIKE '%$search%'
        OR description LIKE '%$search%'
    ";
} else {
    $sql = "SELECT id, name, description, status FROM tasks";
}

// echo $search;

$result = mysqli_query($conn, $sql);


header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);


if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    while ($row) {
        $department = $xml->addChild('task');
        $department->addChild('id', $row['id']);
        $department->addChild('name', $row['name']);
        $department->addChild('description', $row['description']);
        $department->addChild('status', $row['status']);
        $row = mysqli_fetch_assoc($result);
    }
}

// Output the XML
echo $xml->asXML();
?>