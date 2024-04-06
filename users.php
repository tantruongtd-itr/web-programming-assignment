<?php
session_start();
include_once('includes/header.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/css/users.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search-user-form").submit(
            function(event) {
                event.preventDefault(); // Prevent default form submission

                var searchQuery = $("#search_input").val(); // Get the search query

                $.ajax({
                    url: "search-user.php", // URL to send the AJAX request
                    type: "POST", // HTTP method used
                    data: { search_input: searchQuery }, // Data to send (search query)
                    success: function(data) {
                        // console.log(data)
                        $("#user-list").html(data); // Update search results on success
                    }
                });
            }
        );

        // Get the button element
        const addButton = document.getElementById("add-user-button");

        // Add click event listener
        addButton.addEventListener("click", function() {
            // Navigate to the desired page
            window.location.href = "add-user.php";
        });
    });
</script>

<body>
    <!-- The form -->
    <div class = "container page-title-container">
        <div class = "page-title">
            Users
        </div>
        <button id = "add-user-button" class = "add-button">
            <span>+</span>
            <span>Add User</span>
        </button>
    </div>

    <div class="container">
        <form id= "search-user-form" class="search-button">
            <input type="text" placeholder="Search user ..." id="search_input">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div id="user-list" class="container">

    </div>
</body>