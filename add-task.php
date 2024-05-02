<header>
    <title>Assign task</title>
</header>

<?php
include_once('includes/header.php');
?>

<link rel = "stylesheet" href = "./public/css/add-task.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

function searchAdmin() {
  $.ajax({
    url: "?page=search-user&&role=Admin", // URL to send the AJAX request
    type: "GET", // HTTP method used
    success: function(xmlDoc) {
      console.log(xmlDoc);
      let html = '\n';
      const users = xmlDoc.querySelectorAll('user');
      users.forEach(user => {
        const id = user.querySelector('id').textContent;
        const name = user.querySelector('name').textContent;
        
        html += `<option value="${id}">${name}</option>\n`;
      });
      
      const departmentSelect = document.getElementById('assignedTo');
      departmentSelect.innerHTML = html;
    }
  });
}

function searchHeadByDepartmentId(departmentId) {
  const role = getCookie('role');
  let url = `search-user.php?role=Head&departmentId=${departmentId}`;
  if (role === 'Director') {
    url = `search-user.php?role=Head&departmentId=${departmentId}`;
  } 
  if (role === 'Head') {
    url = `search-user.php?role=Staff&departmentId=${departmentId}`;
  } 
  $.ajax({
    url,
    type: "GET", // HTTP method used
    success: function(xmlDoc) {
      let html = '\n';
      const users = xmlDoc.querySelectorAll('user');
      users.forEach(user => {
        const id = user.querySelector('id').textContent;
        const name = user.querySelector('name').textContent;
        
        html += `<option value="${id}">${name}</option>\n`;
      });
      
      const departmentSelect = document.getElementById('assignedTo');
      departmentSelect.innerHTML = html;
    }
  });
}

async function searchDepartment() {
  const role = getCookie('role');
  const url = "search-department.php";
  await $.ajax({
    url,
    type: "GET", // HTTP method used
    success: function(xmlDoc) {
      let html = role === 'Director' ? `
      <option value="none">none</option>
      ` : ``;
      const departments = xmlDoc.querySelectorAll('department');
      departments.forEach(department => {
        const id = department.querySelector('id').textContent;
        const name = department.querySelector('name').textContent;
        html += `<option value="${id}">${name}</option>\n`;
      });
      
      const departmentSelect = document.getElementById('department');
      departmentSelect.innerHTML = html;
    }
  });
}

$(document).ready(async function() {
  // if (document.getElementById('department').value) {
  //   searchHeadByDepartmentId(document.getElementById('department').value);
  // }
  $("#add-task-form").submit(
    function(event) {
      event.preventDefault(); // Prevent default form submission

      const name = $("#name").val();
      const description = $("#description").val();
      const deadline = $("#deadline").val();
      const department = $("#department").val();
      const assignedTo = $("#assignedTo").val();

      console.log(name);
      if (!name || !description || !deadline || !department || !assignedTo) {
        const element = document.querySelector('.failed-message');
        element.innerHTML = 'Missing information!';
        return;
      }

      // Create a new XMLHttpRequest object
      $.ajax({
        url: 'process-add-task.php', // URL to send the AJAX request
        type: "POST", // HTTP method used
        data: {
          name,
          description,
          deadline,
          department,
          assignedTo,
        },
        success: function(xmlDoc) {
          console.log(xmlDoc);
          const isSuccess = xmlDoc.querySelectorAll('isSuccess');
          if (isSuccess) {
            window.location.href = "tasks.php";
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

  const departmentSelect = document.getElementById('department');
  departmentSelect.addEventListener('change', function(event) {
      // Code to execute when the select value changes
      const selectedValue = event.target.value;
      console.log('Selected value:', selectedValue);
      if (selectedValue === 'none') {
        searchAdmin();
      } else {
        console.log('search head')
        searchHeadByDepartmentId(selectedValue);
      }
  });

  await searchDepartment();
  if (document.getElementById('department').value === 'none') {
    await searchAdmin();
  }
  searchHeadByDepartmentId(document.getElementById('department').value);
});
</script>

<body>

<div class = "container page-title-container">
    <div class = "page-title">
        <h1>Assign Task</h1>
    </div>
</div>

<div class = "container">
  <form id="add-task-form">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Task name..">

    <label for="description">Description</label>
    <input type="text" id="description" name="description" placeholder="Task description..">

    <label for="deadline">Deadline</label>
    <div class="input-wrapper">
      <input type="date" id="deadline" name="deadline" placeholder="Deadline..">
    </div>

    <label for="department">Department</label>
    <select id="department" name="department">
    </select>
  
    <label for="assignedTo">Assign to</label>
    <select id="assignedTo" name="assignedTo">
    </select>
  
    <p class="failed-message"></p>
    <input type="submit" value="Submit">
  </form>
</div>

</body>


