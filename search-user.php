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
    $sql = "SELECT u.id AS id, u.name AS name, email, role, d.id AS departmentId
    FROM users AS u
    JOIN users_join_departments AS ujd ON ujd.userId = u.id
    JOIN departments AS d ON ujd.departmentId = d.id
    WHERE u.name LIKE '%$search%'";
} else {
    $sql = "SELECT u.id AS id, u.name AS name, email, role, d.id AS departmentId
    FROM users AS u
    JOIN users_join_departments AS ujd ON ujd.userId = u.id
    JOIN departments AS d ON ujd.departmentId = d.id";
}

if (isset($_GET['role'])) {
    if ($_GET['role'] == 'Admin') {
        $sql = "SELECT id, name, email, role FROM users WHERE role = 'Admin'";
    } else if ($_GET['role'] == 'Head') {
        $departmentId = $_GET['departmentId'];
        $sql = "SELECT u.id AS id, u.name AS name, u.email AS email, u.role AS role 
        FROM users AS u
        JOIN users_join_departments AS ujd ON ujd.userId = u.id
        JOIN departments AS d ON ujd.departmentId = d.id
        WHERE u.role = 'Head'
            AND d.id = $departmentId";
    } else if ($_GET['role'] == 'Staff') {
        $departmentId = $_GET['departmentId'];
        $sql = "SELECT u.id AS id, u.name AS name, u.email AS email, u.role AS role 
        FROM users AS u
        JOIN users_join_departments AS ujd ON ujd.userId = u.id
        JOIN departments AS d ON ujd.departmentId = d.id
        WHERE u.role = 'Staff'
            AND d.id = $departmentId";
    }
}

// echo $search;

$result = mysqli_query($conn, $sql);


header('Content-type: application/xml');
$xml = new SimpleXMLElement('<response/>');
$xml->addChild('isSuccess', true);


if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    while ($row) {
        $department = $xml->addChild('user');
        $department->addChild('id', $row['id']);
        $department->addChild('name', $row['name']);
        $department->addChild('email', $row['email']);
        $department->addChild('role', $row['role']);
        $department->addChild('departmentId', $row['departmentId']);
        $row = mysqli_fetch_assoc($result);
    }
}

// Output the XML
echo $xml->asXML();
?>