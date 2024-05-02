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
async function getAllDepartments() {
    const allDepartments = [];
    const url = 'search-department.php'
    await $.ajax({
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
                
                allDepartments.push({
                    id,
                    name,
                    description,
                    head,
                });
            });
        }
    });
    return allDepartments;
}

async function updateUserRole(userId, selectElement) {
    const role = selectElement.value;
    console.log("Selected value:", role);
    await $.ajax({
        url : `update-user.php?userId=${userId}&&role=${role}`, // URL to send the AJAX request
        type: "GET", // HTTP method used
        success: function(xmlDoc) {
            console.log(xmlDoc);
        }
    });
}

function updateUserDepartment(id, selectElement) {
    const selectedValue = selectElement.value;
    console.log("Selected value:", selectedValue);
}

async function searchUser(searchQuery) {
    const departments = await getAllDepartments();
    console.log(departments);
    const url = searchQuery ? `search-user.php?search=${searchQuery}` : `search-user.php`;
    $.ajax({
        url, // URL to send the AJAX request
        type: "GET", // HTTP method used
        success: function(xmlDoc) {
            let html = '\n';
            const users = xmlDoc.querySelectorAll('user');
            users.forEach(user => {
                const id = user.querySelector('id').textContent;
                const name = user.querySelector('name').textContent;
                const email = user.querySelector('email').textContent;
                const role = user.querySelector('role').textContent;
                const departmentId = user.querySelector('departmentId').textContent;
                
                html += `
                <tr>
                    <th scope="row">${id}</th>
                    <td>${name}</td>
                    <td>${email}</td>
                    <td>
                        <select id="role" name="role" onchange="updateUserRole(${id}, this)">
                            <option value="Admin" ${role === 'Admin' ? 'selected': ''}>Administrator</option>
                            <option value="Director" ${role === 'Director' ? 'selected': ''}>Director</option>
                            <option value="Head" ${role === 'Head' ? 'selected' : ''}>Department Head</option>
                            <option value="Staff" ${role === 'Staff' ? 'selected' : ''}>Staff</option>
                        </select>
                    </td>
                    <td>
                        <select id="department" name="department" onchange="updateUserDepartment(${id}, this)">
                `;
                if (role === "Admin" || role === "Director") {
                    html += `
                        <option value="none" selected}>none</option>
                    `
                }
                departments.forEach(department => {
                    html += `
                        <option value="${department.id}" ${(departmentId === department.id && role !== "Admin" && role !== "Director" ) ? 'selected': ''}>${department.name}</option>
                    `
                });
                html += `
                        </select>
                    </td>
                </tr>
                `;
            });

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
        window.location.href = "index.php?page=add-user";
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
                    <th scope="col">Department</th>
                </tr>
            </thead>

            <tbody id="user-list-content">
            </tbody>
        </table>
    </div>
</body>