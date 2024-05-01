<header>
    <title>Add user</title>
</header>

<?php
include_once('includes/header.php');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $("#add-user-form").submit(
    function(event) {
      event.preventDefault(); // Prevent default form submission

      const name = $("#name").val();
      const email = $("#email").val();
      const username = $("#username").val();
      const password = $("#password").val();
      const role = $("#role").val();
      const department = $("#department").val();

      console.log(name);
      if (!name || !email || !username || !password || !role) {
        const element = document.querySelector('.failed-message');
        element.innerHTML = 'Missing information!';
        return;
      }

      // Create a new XMLHttpRequest object
      $.ajax({
        url: 'process-add-user.php', // URL to send the AJAX request
        type: "POST", // HTTP method used
        data: {
          name,
          email,
          username,
          password,
          role,
          department: role === 'Admin' ? undefined : department,
        },
        success: function(xmlDoc) {
          console.log(xmlDoc);
          const isSuccess = xmlDoc.querySelectorAll('isSuccess');
          if (isSuccess) {
            window.location.href = "users.php";
          } else {
            const message = xmlDoc.querySelectorAll('message');
            const element = document.querySelector('.failed-message');
              element.innerHTML = message;
            return;
          }
        }
      })
    }
  );
});

function addValueForDepartment() {
  $.ajax({
    url: "search-department.php", // URL to send the AJAX request
    type: "GET", // HTTP method used
    success: function(xmlDoc) {
      let html = '\n';
      const departments = xmlDoc.querySelectorAll('department');
      departments.forEach(department => {
        const id = department.querySelector('id').textContent;
        const name = department.querySelector('name').textContent;
        
        html += `<option value="${id}">${name}</option>\n`;
      });
      
      const departmentSelect = document.getElementById('department');
      departmentSelect.innerHTML = html;

      const departmentSelectWrapper = document.getElementById('department-wrapper');
      departmentSelectWrapper.classList.remove('hidden');
    }
  });
}

async function hideDepartmentOption() {
  const departmentSelectWrapper = document.getElementById('department-wrapper');
  departmentSelectWrapper.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
  const roleSelect = document.getElementById('role');
  
  // Add an event listener for the change event
  roleSelect.addEventListener('change', function(event) {
      // Code to execute when the select value changes
      const selectedValue = event.target.value;
      console.log('Selected value:', selectedValue);
      if (selectedValue !== 'Admin') {
        addValueForDepartment();
      } else {
        hideDepartmentOption();
      }
  });
});
</script>

<link rel = "stylesheet" href = "./public/css/add-user.css">

<body>

<div class = "container page-title-container">
    <div class = "page-title">
      <h1>Add User</h1>
    </div>
</div>

<div class = "container">
  <form id="add-user-form">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Your name..">

    <label for="email">Email</label>
    <input type="text" id="email" name="email" placeholder="Your email..">

    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Username..">

    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Password..">
  
    <label for="role">Role</label>
    <select id="role" name="role">
      <option value="Admin">Administrator</option>
      <option value="Director">Director</option>
      <option value="Head">Department head</option>
      <option value="Staff">Staff</option>
    </select>

    <div id = "department-wrapper" class="hidden">
      <label for="department">Department</label>
      <select id="department" name="department">
      </select>
    </div>
  
    <p class="failed-message"></p>
    <input type="submit" value="Submit">
  </form>
</div>

</body>


