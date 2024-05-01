<header>
    <title>Department management</title>
</header>

<?php
// Hardcoded department
include_once('./includes/header.php');
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/css/departments.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function searchDepartment(searchQuery) {
    const url = searchQuery ? `search-department.php?search=${searchQuery}` : `search-department.php`
    console.log(url);
    $.ajax({
        url, // URL to send the AJAX request
        type: "GET", // HTTP method used
        success: function(xmlDoc) {
            console.log(xmlDoc);
            let html = '\n';
            const departments = xmlDoc.querySelectorAll('department');
            departments.forEach(department => {
                const id = department.querySelector('id').textContent;
                const name = department.querySelector('name').textContent;
                const description = department.querySelector('description').textContent;
                const head = department.querySelector('head').textContent;
                
                html += `
                <tr>
                    <th scope="row">${id}</th>
                    <td>${name}</td>
                    <td>${description}</td>
                    <td>${head}</td>
                </tr>
                `;
            });

            console.log(html);
            $("#department-list-content").html(html); // Update search results on success
        }
    });
}

$(document).ready(function() {
    searchDepartment();

    $("#search-department-form").submit(
        function(event) {
            event.preventDefault(); // Prevent default form submission

            var searchQuery = $("#search_input").val(); // Get the search query

            searchDepartment(searchQuery);
        }
    );

    // Get the button element
    const addButton = document.getElementById("add-department-button");

    // Add click event listener
    addButton.addEventListener("click", function() {
        // Navigate to the desired page
        window.location.href = "add-department.php";
    });
});
</script>

<body>
    <!-- The form -->
    <div class = "container page-title-container">
        <div class = "page-title">
            <h1>Departments</h1>
        </div>
        <?php if (in_array($_SESSION['role'], ['Admin'])): ?>
            <button id = "add-department-button" class = "add-button">
                <span>+</span>
                <span>Add department</span>
            </button>
        <?php endif; ?>
    </div>

    <div class="container">
        <form id= "search-department-form" class="search-button">
            <input type="text" placeholder="Search department ..." id="search_input">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div id="department-list" class="container">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Head</th>
                </tr>
            </thead>

            <tbody id="department-list-content">
            </tbody>
        </table>
    </div>
</body>