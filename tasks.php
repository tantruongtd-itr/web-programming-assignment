<header>
    <title>Task management</title>
</header>

<?php
include_once('includes/header.php');
?>

<?php
    setcookie("role", $_SESSION['role'], time() + (86400 * 30), "/");
    setcookie("id", $_SESSION['id'], time() + (86400 * 30), "/");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./public/css/tasks.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

function searchTask(searchQuery) {
    const url = searchQuery ? `search-task.php?search=${searchQuery}` : `search-task.php`;

    const role = getCookie('role');
    const userId = getCookie('id');
    console.log(userId);

    $.ajax({
        url, // URL to send the AJAX request
        type: "GET", // HTTP method used
        success: function(xmlDoc) {
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
                const createdById = task.querySelector('createdById').textContent;
                const assignedTo = task.querySelector('assignedTo').textContent;
                const assignedToId = task.querySelector('assignedTo').textContent;
                console.log(createdById);

                html += `
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>${name}</h2>
                    </div>
                    <div class="card-body">
                        <p><strong>Description:</strong> ${description}</p>
                        <p><strong>Assigned to:</strong> ${assignedTo}</p>
                        <p><strong>Progess:</strong> ${status || 'In Progress'}</p>
                        <p><strong>Review:</strong> ${reviewStatus || 'UnReviewed'}</p>
                        <p><strong>Deadline:</strong> ${deadline}</p>
                        <div class="card-end" style="display: flex; justify-content: space-between;">
                            <a href="" class="btn btn-primary">View detail</a>
                `;

                if (role === 'Head') {
                    if (!reviewStatus && userId === createdById) {
                        html += `
                        <div style="display:inline-block">
                        <a href="approve-task.php?task_id=${id}" class="btn btn-success approve-btn">Approve</a>
                        <a href="reject-task.php?task_id=${id}" class="btn btn-danger reject-btn">Reject</a>
                        </div>
                        `;
                    } else {
                        if (!status) {
                            html += `
                                <div style="display:inline-block">
                                <a href="submit-task.php?task_id=${id}" class="btn btn-success submit-btn">Submit</a>
                                </div>
                            `;
                        }
                    }
                }
                if (role === 'Admin' || role === 'Staff') {
                    if (!status) {
                        html += `
                            <div style="display:inline-block">
                            <a href="submit-task.php?task_id=${id}" class="btn btn-success submit-btn">Submit</a>
                            </div>
                        `;
                    }
                }
                html += `
                        </div>
                    </div>
                </div>`;
            });

            $("#task-list-content").html(html); // Update search results on success

            const approveButtons = document.getElementsByClassName('approve-btn');
            for (let approveBtn of approveButtons) {
                approveBtn.addEventListener("click", function(event) {
                    // Navigate to the desired page
                    event.preventDefault();
                    const href = approveBtn.getAttribute('href');
                    $.ajax({
                        url: href, // URL to send the AJAX request
                        type: "GET", // HTTP method used
                        success: function() {
                            window.location.href = "tasks.php";
                        }
                    });
                });
            }

            const rejectButtons = document.getElementsByClassName('reject-btn');
            for (let rejectBtn of rejectButtons) {
                rejectBtn.addEventListener("click", function(event) {
                    // Navigate to the desired page
                    event.preventDefault();
                    const href = rejectBtn.getAttribute('href');
                    $.ajax({
                        url: href, // URL to send the AJAX request
                        type: "GET", // HTTP method used
                        success: function() {
                            window.location.href = "tasks.php";
                        }
                    });
                });
            }

            const submitButtons = document.getElementsByClassName('submit-btn');
            for (let submitBtn of submitButtons) {
                submitBtn.addEventListener("click", function(event) {
                    // Navigate to the desired page
                    event.preventDefault();
                    const href = submitBtn.getAttribute('href');
                    $.ajax({
                        url: href, // URL to send the AJAX request
                        type: "GET", // HTTP method used
                        success: function() {
                            window.location.href = "tasks.php";
                        }
                    });
                });
            }
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
    if (addButton) {
        // Add click event listener
        addButton.addEventListener("click", function() {
            // Navigate to the desired page
            window.location.href = "add-task.php";
        });
    }

    const approveButtons = document.getElementsByClassName('approve-btn');
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
    <div id="task-list-content" class="container">
    </div>
</body>