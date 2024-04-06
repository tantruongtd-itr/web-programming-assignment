<?php
// search-user.php
include_once('./includes/connect_database.php');
// Database connection and other necessary includes

if(isset($_POST['search_input'])) {
    $search_input = $_POST['search_input'];
    $sql = "SELECT id, name, email, avatar FROM users WHERE name LIKE '%$search_input%'";

    $result = mysqli_query($conn, $sql);

    // echo $result
    
    // // Check if any rows were returned
    if(mysqli_num_rows($result) > 0) {
        // Loop through the results and display them
        while($row = mysqli_fetch_assoc($result)) {
            echo "Id: " . $row['id'] . "<br>";
            echo "Name: " . $row['name'] . "<br>";
            echo "Email" . $row['email'] . "<br><br>";
            echo "Avatar" . $row['avatar'] . "<br><br>";
        }
    } else {
        echo "No users found!";
    }
    // Display search results here based on the fetched users
} else {
    echo "<p>No search query provided.</p>";
}
?>