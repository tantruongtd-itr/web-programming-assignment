<header>
    <title>User management</title>
</header>

<?php
include_once('includes/header.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/css/users.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function searchUser(searchQuery) {
    const url = searchQuery ? `search-user.php?search=${searchQuery}` : `search-user.php`
    console.log(url);
    $.ajax({
        url, // URL to send the AJAX request
        type: "GET", // HTTP method used
        success: function(xmlDoc) {
            console.log(xmlDoc);
            let html = '\n';
            const users = xmlDoc.querySelectorAll('user');
            users.forEach(user => {
                const id = user.querySelector('id').textContent;
                const name = user.querySelector('name').textContent;
                const email = user.querySelector('email').textContent;
                const role = user.querySelector('role').textContent;
                
                html += `
                <tr>
                    <th scope="row">${id}</th>
                    <td>${name}</td>
                    <td>${email}</td>
                    <td>${role}</td>
                </tr>
                `;
            });

            console.log(html);
            $("#user-list-content").html(html); // Update search results on success
        }
    });
}

$(document).ready(function() {
    searchUser();

    $("#search-user-form").submit(
        function(event) {
            event.preventDefault(); // Prevent default form submission

            var searchQuery = $("#search_input").val(); // Get the search query

            searchUser(searchQuery);
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
            <h1>Users</h1>
        </div>
        <?php if (in_array($_SESSION['role'], ['Admin'])): ?>
            <button id = "add-user-button" class = "add-button">
                <span>+</span>
                <span>Add User</span>
            </button>
        <?php endif; ?>
    </div>

    <div class="container">
        <form id= "search-user-form" class="search-button">
            <input type="text" placeholder="Search user ..." id="search_input">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div id="user-list" class="container">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                </tr>
            </thead>

            <tbody id="user-list-content">
            </tbody>
        </table>
    </div>
</body>