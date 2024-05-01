<header>
    <title>Login</title>
</header>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#login-form").submit(
            function(event) {
                event.preventDefault(); // Prevent default form submission

                const username = $("#username").val();
                const password = $("#password").val();

                if (!RegExp(/^[a-zA-Z0-9_]+$/).test(username)) {
                  $("#login-failed-message").text('Invalid username!');
                  return;
                }

                if (!RegExp(/^[a-zA-Z0-9_]+$/).test(password)) {
                  $("#login-failed-message").text('Invalid password!');
                    return;
                }

                // Create a new XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Configure the request
                xhr.open('POST', 'validation.php', true);
                xhr.setRequestHeader('Content-Type', 'application/xml');

                // Set up a function to handle the response
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Parse the XML response
                            const xmlDoc = xhr.responseXML;

                            // // Extracting data from the XML response
                            console.log(xmlDoc);
  
                            const isSuccess = xmlDoc.getElementsByTagName("isSuccess")[0].textContent;
                            if (isSuccess) {
                              window.location.href = "index.php";
                            } else {
                              const message = xmlDoc.getElementsByTagName("message")[0].textContent;
                              $("#login-failed-message").text(message);
                            }
                        } else {
                            console.error('Request failed: ' + xhr.status);
                        }
                    }
                };

                // Send the request
                var data = JSON.stringify({ 
                    username: username,
                    password: password
                });
                xhr.send(data);
        });


      
    });

</script>

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
        <div class="container login-navbar">
        </div>
    </div>
</header>
</html>

<body>
<link href = "./public/css/login.css" rel="stylesheet">
<div class="login-form container">
    <form id="login-form"  method="post">
      <div class="img-container">
        <img src="./images/dev.png" alt="Avatar" class="avatar">
      </div>
    
      <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" id = "username" placeholder="Enter Username" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
    
        <label for="psw"><b>Password</b></label>
        <input type="password" id = "password" placeholder="Enter Password" name="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" required>
    
        <p id = "login-failed-message" class="login-failed-message"></p>
      
        <button type="submit">Login</button>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
      </div>
    
      <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancel-btn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
</div>
</body>
