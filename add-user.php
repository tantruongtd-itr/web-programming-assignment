<?php
session_start();
include_once('includes/header.php');
?>

<link rel = "stylesheet" href = "./public/css/add-user.css">

<body>

<div class = "container page-title-container">
    <div class = "page-title">
        Add User
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
  
    <label for="role">role</label>
    <select id="role" name="role">
      <option value="ADMIN">Administrator</option>
      <option value="Director">Director</option>
      <option value="Heads">Department heads</option>
      <option value="Staffs">Staffs</option>
    </select>
  
    <input type="submit" value="Submit">
  </form>
</div>

</body>


