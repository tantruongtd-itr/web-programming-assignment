<?php
    session_start();
    $current_url = $_SERVER['REQUEST_URI'];
    $page = explode('/', $current_url)[1];

    if (!isset($_SESSION['id'])) {
        if ($page != 'login.php') {
            header("Location: login.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Web assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/css/styles.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<header>
    <div class = "bg-dark">
        <div class="container navbar">
            <ul class="main-menu">
                <?php if (in_array($_SESSION['role'], ['Director', 'Admin'])): ?>
                    <li class="menu-item">
                        <a class="" href="users.php">
                            Users
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (in_array($_SESSION['role'], ['Director', 'Admin'])): ?>
                    <li class="menu-item">
                        <a class="" href="departments.php">
                            Department
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (in_array($_SESSION['role'], ['Head', 'Staff', 'Director', 'Admin'])): ?>
                    <li class="menu-item">
                        <a class="" href="tasks.php">
                            Tasks
                        </a>
                    </li>   
                <?php endif; ?>
            </ul>
            <div class="avatar float-right flex-row">
                <div class=text-wrapper>
                    <a class="navbar-brand" href="log-out.php">
                        Log out
                    </a>
                </div>
                <a class="navbar-brand" href="#">
                  <img src="../images/guest.jpg" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
                </a>
            </div>
        </div>
    </div>
</header>
</html>