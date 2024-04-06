<?php
// search-task.php
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

if(isset($_POST['search_input'])) {
    $search_input = $_POST['search_input'];
    $sql = "SELECT id, name, description, status FROM tasks WHERE name LIKE '%$search_input%' OR description LIKE '%$search_input%'";

    $result = mysqli_query($conn, $sql);

    // echo $result
    
    // // Check if any rows were returned
    if(mysqli_num_rows($result) > 0) {
        // Loop through the results and display them
        while($row = mysqli_fetch_assoc($result)) {
            echo "Id: " . $row['id'] . "<br>";
            echo "Task Name: " . $row['name'] . "<br>";
            echo "Description: " . $row['description'] . "<br>";
            echo "Assignee" . $row['assignee'] . "<br><br>";
            echo "Status" . $row['status'] . "<br><br>";
        }
    } else {
        echo "No tasks found!";
    }
    // Display search results here based on the fetched tasks
} else {
    echo "<p>No search query provided.</p>";
}
?>