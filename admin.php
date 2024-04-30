<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        line-height: 1.6;
        padding: 20px;
    }

    /* Heading styles */
    h1, h2, h3 {
        margin-bottom: 20px;
    }

    /* Form styles */
    form {
        max-width: 500px;
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"],
    button {
        background: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }

    input[type="submit"]:hover {
        background: #0056b3;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    table th {
        background-color: #f2f2f2;
        font-weight: bold;
        text-align: left;
    }

    /* Links */
    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        appearance: none; /* Remove default appearance */
        -webkit-appearance: none; /* Remove default appearance for Safari */
        background-color: #fff; /* Change background color */
        color: #333; /* Change text color */
        font-size: 16px; /* Change font size */
    }

    /* Styles for option elements */
    select option {
        background-color: #fff; /* Change background color */
        color: #333; /* Change text color */
        padding: 10px; /* Add padding */
    }

    /* Styles for option elements when hovered */
    select option:hover {
        background-color: #f2f2f2; /* Change background color on hover */
    }

    </style>
</head>
<body>
    <h1>Hello Admin</h1>
    <button type="button" onclick="form()">Create Director</button>
    <div>
        <h1>Account Registration</h1>
        <form>
            <div class = "input">
                <div class = "input-field">
                    <input type = "text" placeholder = "Full Name" required>
                </div>

                <div class = "input-field">
                    <input type = "email" placeholder = "Email" required>
                </div>

                <div class = "input-field">
                    <input type = "number" placeholder = "Phone Number" required>
                </div>
                
                <div class = "input-field">
                    <input type = "password" placeholder = "Password" required>
                </div>
                
                <div class = "input-field">
                    <input type = "password" placeholder = "Confirm Password" required>
                </div>
            </div>
            
            <input type="submit" value= "Register"></input>
        </form>
    </div>

    <div class="container">
        <h1>Assign Role to Employee</h1>
        <form action="assign_role.php" method="post">
            <label for="employee_id">Employee:</label>
            <select id="employee_id" name="employee_id" required>
                <option value="">Select Employee</option>
                <option value="1">Employee 1</option>
                <option value="2">Employee 2</option>
            </select><br><br>
            
            <label for="role_id">Role:</label>
            <select id="role_id" name="role_id" required>
                <option value="">Select Role</option>
                <option value="1">Department Head</option>
                <option value="2">Staff</option>
            </select><br><br>

            <label for="department_id">Department:</label>
            <select id="department_id" name="department_id" required>
                <option value="">Select Department</option>
                <option value="1">Department 1</option>
                <option value="2">Department 2</option>
            </select><br><br>
            
            <input type="submit" value="Assign">
        </form>
    </div>
</body>

</html>
