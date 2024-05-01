<header>
    <title>Add department</title>
</header>

<?php
include_once('includes/header.php');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $("#add-department-form").submit(
    function(event) {
      event.preventDefault(); // Prevent default form submission

      const name = $("#name").val();
      const description = $("#description").val();

      if (!name || !description) {
        const element = document.querySelector('.failed-message');
        element.innerHTML = 'Missing information!';
        return;
      }

      // Create a new XMLHttpRequest object
      $.ajax({
        url: 'process-add-department.php', // URL to send the AJAX request
        type: "POST", // HTTP method used
        data: {
          name,
          description,
        },
        success: function(xmlDoc) {
          console.log(xmlDoc);
          const isSuccess = xmlDoc.querySelectorAll('isSuccess');
          if (isSuccess) {
            window.location.href = "departments.php";
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
</script>

<link rel = "stylesheet" href = "./public/css/add-department.css">

<body>

<div class = "container page-title-container">
    <div class = "page-title">
        <h1>Add department</h1>
    </div>
</div>

<div class = "container">
  <form id="add-department-form">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="Department name..">

    <label for="description">Description</label>
    <input type="text" id="description" name="description" placeholder="Department description..">
  
    <p class="failed-message"></p>
    <input type="submit" value="Submit">
  </form>
</div>

</body>


