<?php
// Hardcoded department
include_once('./includes/header.php');

$department = [
    'id' => 1,
    'name' => 'Marketing',
];

// Hardcoded tasks
$tasks = [
    [
        'id' => 1,
        'name' => 'Task 1',
        'description' => 'This is task 1',
        'department_id' => 1,
        'staff' => 'John Doe',
        'progress' => 'In Progress',
        'deadline' => '2024-12-31',
        'requirement' => 'Complete the marketing campaign',
    ],
    [
        'id' => 2,
        'name' => 'Task 2',
        'description' => 'This is task 2',
        'department_id' => 1,
        'staff' => 'Tom Smith',
        'progress' => 'Submitted',
        'deadline' => '2024-04-20',
        'requirement' => 'Write a contrast for the marketing campaign',
    ],
    [
        'id' => 3,
        'name' => 'Task 3',
        'description' => 'This is task 3',
        'department_id' => 1,
        'staff' => 'July Rose',
        'progress' => 'Approved',
        'deadline' => '2024-04-01',
        'requirement' => 'Write decorating plan for the meeting hall',
    ],
];

// Hardcoded Members
$members = [
    [
        'id' =>  2020001,
        'name' => 'John Doe',
        'avatar' => 'https://www.shareicon.net/data/512x512/2016/09/15/829459_man_512x512.png',
        'status' => 'Working',
    ],
    [
        'id' => 2020002,
        'name' => 'Tom Holland',
        'avatar' => 'https://www.shareicon.net/data/512x512/2016/09/15/829459_man_512x512.png',
        'status' => 'Absent',
    ],
    [
        'id' => 2020003,
        'name' => 'John Cenna',
        'avatar' => 'https://www.shareicon.net/data/512x512/2016/09/15/829459_man_512x512.png',
        'status' => 'WFH',
    ],

];
?>


<!DOCTYPE html>
<html>
<head>
    <title>Department Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="pages/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-lg">
        <div class="row">
            <!-- Main content -->
            <div class="col-md-10">
                <h1 class="mt-4 mb-4 text-center"><?php echo $department['name'] . ' Department'; ?></h1>
                <!-- Assign Task button -->
                <a href="assign_task.php?department_id=<?php echo $department['id']; ?>" class="btn btn-primary mb-3">Assign Task</a>
                <!-- Loop through each task -->
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['department_id'] == $department['id']): ?>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h2><?php echo $task['name']; ?></h2>
                            </div>
                            <div class="card-body">
                                <p><strong>Description:</strong> <?php echo $task['description']; ?></p>
                                <p><strong>Assigned to:</strong> <?php echo $task['staff']; ?></p>
                                <p><strong>Progess:</strong> <?php echo $task['progress']; ?></p>
                                <p><strong>Deadline:</strong> <?php echo $task['deadline']; ?></p>
                                <p><strong>Requirement:</strong> <?php echo $task['requirement']; ?></p>
                                <!-- Add buttons for task management -->
                                <?php if ($task['progress'] == 'In Progress'): ?>
                                    <a href="add_review.php?task_id=<?php echo $task['id']; ?>" class="btn btn-secondary">Add Review</a>
                                    <a href="extend_deadline.php?task_id=<?php echo $task['id']; ?>" class="btn btn-warning">Extend Deadline</a>
                                <?php elseif ($task['progress'] == 'Submitted'): ?>
                                    <a href="approve.php?task_id=<?php echo $task['id']; ?>" class="btn btn-success">Approve</a>
                                    <a href="reject.php?task_id=<?php echo $task['id']; ?>" class="btn btn-danger">Reject</a>
                                <?php elseif ($task['progress'] == 'Approved'): ?>
                                    <a href="evaluate_task.php?task_id=<?php echo $task['id']; ?>" class="btn btn-info">Evaluate Task</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Sidebar -->
            <div class="col-md-2">
                <h4 class="mt-4 mb-4">Department Members</h4>
                <?php foreach ($members as $member): ?>
                    <div class="card mb-3">
                        <img class="card-img-top custom-ava" src="<?php echo $member['avatar']; ?>" alt="Member Avatar">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $member['name']; ?></h5>
                            <p class="card-text"><?php echo $member['status']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>