<?php if (isset($_GET['page'])) :?>
    <?php if ($_GET['page'] == 'users') :?>
        <?php include_once('./users.php'); ?>
    <?php elseif ($_GET['page'] == 'departments') :?>
        <?php include_once('./departments.php'); ?>
    <?php elseif ($_GET['page'] == 'tasks') :?>
        <?php include_once('./tasks.php'); ?>
    <?php elseif ($_GET['page'] == 'add-user') :?>
        <?php include_once('./add-user.php'); ?>
    <?php elseif ($_GET['page'] == 'search-users') :?>
        <?php include_once('./search-users.php'); ?>
    <?php elseif ($_GET['page'] == 'add-department') :?>
        <?php include_once('./add-department.php'); ?>
    <?php elseif ($_GET['page'] == 'add-task') :?>
        <?php include_once('./add-task.php'); ?>
    <?php elseif ($_GET['page'] == 'log-out') :?>
        <?php include_once('./log-out.php'); ?>
    <?php endif; ?>
<?php elseif (!isset($_GET['page'])) :?>
    <?php
    include_once('includes/header.php');
    ?>

    <body>
        <div class="header container-fluid">
            <div class="container-fluid text-white text-center p-5">
                <h1>Web assignment</h1>
            </div>
        </div>
    </body>
<?php endif; ?>