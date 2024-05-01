<?php
session_start();
include_once('./includes/connect_database.php');

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$userId = $_SESSION['id'];
$sql = "";
if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Staff') {
    $sql = "SELECT 
    t.*, 
    ua.name AS assignedTo,
    ua.id AS assignedToId,
    uc.name AS createdBy,
    uc.id AS createdById
    FROM 
        tasks AS t
    LEFT JOIN 
        users AS ua ON t.assignedTo = ua.id
    LEFT JOIN 
        users AS uc ON t.createdBy = uc.id
    WHERE (t.assignedTo = $userId)";

    if ($search !== "") {
        $sql = "$sql 
        AND (t.description LIKE '%$search%' OR t.name LIKE '%$search%')";
    }
}

if ($_SESSION['role'] == 'Director') {
    $sql = "SELECT 
    t.*, 
    ua.name AS assignedTo,
    ua.id AS assignedToId,
    uc.name AS createdBy,
    uc.id AS createdById
    FROM 
        tasks AS t
    LEFT JOIN 
        users AS ua ON t.assignedTo = ua.id
    LEFT JOIN 
        users AS uc ON t.createdBy = uc.id
    WHERE (t.createdBy = $userId)";

    if ($search !== "") {
        $sql = "$sql 
        AND (t.description LIKE '%$search%' OR t.name LIKE '%$search%')";
    }
}

if ($_SESSION['role'] == 'Head') {
    $sql = "SELECT 
    t.*, 
    ua.name AS assignedTo,
    ua.id AS assignedToId,
    uc.name AS createdBy,
    uc.id AS createdById
    FROM 
        tasks AS t
    LEFT JOIN 
        users AS ua ON t.assignedTo = ua.id
    LEFT JOIN 
        users AS uc ON t.createdBy = uc.id
    WHERE (t.assignedTo = $userId OR t.createdBy = $userId)";

    if ($search !== "") {
        $sql = "$sql 
        AND (t.description LIKE '%$search%' OR t.name LIKE '%$search%')";
    }
}

// echo $sql;


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
        $department->addChild('reviewStatus', $row['reviewStatus']);
        $department->addChild('deadline', $row['deadline']);
        $department->addChild('createdBy', $row['createdBy']);
        $department->addChild('createdById', $row['createdById']);
        $department->addChild('assignedTo', $row['assignedTo']);
        $department->addChild('assignedToId', $row['assignedToId']);
        $row = mysqli_fetch_assoc($result);
    }
}

// Output the XML
echo $xml->asXML();
?>