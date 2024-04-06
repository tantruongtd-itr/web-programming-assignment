<?php
session_start();
include_once('includes/header.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/css/tasks.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search-task-form").submit(
            function(event) {
                event.preventDefault(); // Prevent default form submission

                var searchQuery = $("#search_input").val(); // Get the search query

                $.ajax({
                    url: "search-task.php", // URL to send the AJAX request
                    type: "POST", // HTTP method used
                    data: { search_input: searchQuery }, // Data to send (search query)
                    success: function(data) {
                        // console.log(data)
                        $("#task-list").html(data); // Update search results on success
                    }
                });
            }
        );

        // Get the button element
        const addButton = document.getElementById("add-task-button");

        // Add click event listener
        addButton.addEventListener("click", function() {
            // Navigate to the desired page
            window.location.href = "add-task.php";
        });
    });

</script>

<body>
    <!-- The form -->
    <div class = "container page-title-container">
        <div class = "page-title">
            Tasks
        </div>
        <button id = "add-task-button" class = "add-button" action = "add-task.php">
            <span>+</span>
            <span>Add Task</span>
        </button>
    </div>

    <div class="container">
        <form id= "search-task-form" class="search-button">
            <input type="text" placeholder="Search task ..." id="search_input">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div id="task-list" class="container">

    </div>
</body>