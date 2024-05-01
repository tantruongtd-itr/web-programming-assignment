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
    $sql = "SELECT d.*, t.head
    FROM departments AS d
    LEFT JOIN (
        SELECT ujd.departmentId AS departmentId, u.name AS head
        FROM users AS u
        JOIN users_join_departments AS ujd ON u.id = ujd.userId 
        WHERE u.role = 'Head'
    ) AS t ON d.id = t.departmentId
    WHERE d.name LIKE '%$search%'";
} else {
    $sql = "SELECT d.id, d.name, d.description, t.head
    FROM departments AS d
    LEFT JOIN (
        SELECT ujd.departmentId AS departmentId, u.name AS head
        FROM users AS u
        JOIN users_join_departments AS ujd ON u.id = ujd.userId 
        WHERE u.role = 'Head'
    ) AS t ON d.id = t.departmentId";
    // LEFT JOIN users AS u ON u.id = ujd.userId
    // WHERE u.role = 'Head'";
}

$result = mysqli_query($conn, $sql);

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
        $department->addChild('head', $row['head']);
        // $department->addChild('head', $row['head']);
        $row = mysqli_fetch_assoc($result);
    }
}

// Output the XML
echo $xml->asXML();
?>