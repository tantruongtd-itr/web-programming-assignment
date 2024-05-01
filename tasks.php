<header>
    <title>Task management</title>
</header>

<?php
include_once('includes/header.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/css/tasks.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

function searchTask(searchQuery) {
    const url = searchQuery ? `search-task.php?search=${searchQuery}` : `search-task.php`
    console.log(url);
    $.ajax({
        url, // URL to send the AJAX request
        type: "GET", // HTTP method used
        success: function(xmlDoc) {
            console.log(xmlDoc);
            let html = '\n';
            const tasks = xmlDoc.querySelectorAll('task');
            tasks.forEach(task => {
                const id = task.querySelector('id').textContent;
                const name = task.querySelector('name').textContent;
                const description = task.querySelector('description').textContent;
                const status = task.querySelector('status').textContent;
                const reviewStatus = task.querySelector('reviewStatus').textContent;
                const deadline = task.querySelector('deadline')?.textContent;
                const createdBy = task.querySelector('createdBy').textContent;
                const assignedTo = task.querySelector('assignedTo').textContent;
                
                html += `
                <tr>
                    <td>${name}</td>
                    <td>${description}</td>
                    <td>${status || 'In progress'}</td>
                    <td>${reviewStatus || 'Unreviewed'}</td>
                    <td>${deadline}</td>
                    <td>${createdBy}</td>
                    <td>${assignedTo}</td>
                </tr>
                `;
            });

            console.log(html);
            $("#task-list-content").html(html); // Update search results on success
        }
    });
}

$(document).ready(function() {
    searchTask();
    $("#search-task-form").submit(
        function(event) {
            event.preventDefault(); // Prevent default form submission

            var searchQuery = $("#search_input").val(); // Get the search query

            searchTask(searchQuery);
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
            <h1>Tasks</h1>
        </div>
        <?php if (in_array($_SESSION['role'], ['Head', 'Director'])): ?>
            <button id = "add-task-button" class = "add-button" action = "add-task.php">
                <span>+</span>
                <span>Assign Task</span>
            </button>
        <?php endif; ?>
    </div>

    <div class="container">
        <form id= "search-task-form" class="search-button">
            <input type="text" placeholder="Search task ..." id="search_input">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div id="task-list" class="container">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Progress</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Created by</th>
                    <th scope="col">Assigned to</th>
                </tr>
            </thead>

            <tbody id="task-list-content">
            </tbody>
        </table>
    </div>
</body>