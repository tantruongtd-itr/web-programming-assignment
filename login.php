<?php
session_start();
include_once('includes/header.php');
?>

<html lang="en">
<body>
<link href = "./public/css/login.css" rel="stylesheet">
<div class="login-form container">
    <form id="login-form" action="validation.php" method="post">
      <div class="img-container">
        <img src="./images/dev.png" alt="Avatar" class="avatar">
      </div>
    
      <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required>
    
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" required>
    
        <?php if(isset($_SESSION['login_failed'])): ?>
            <p class="login-failed-message"><?php echo $_SESSION['message']; ?></p>
        <?php endif; ?>

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
</html>


<script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
    // Prevent form submission
    event.preventDefault();

    // Perform form validation
    var username = document.getElementsByName('username')[0].value;
    var password = document.getElementsByName('password')[0].value;
    console.log(username);
    console.log(password);

    if (!RegExp(/^[a-zA-Z0-9_]+$/).test(username)) {
        document.getElementsByClassName('login-failed-message')[0].innerHTML = 'Invalid username!';
        console.log('form submit1')
        return;
    }

    if (!RegExp(/^[a-zA-Z0-9_]+$/).test(password)) {
        document.getElementsByClassName('login-failed-message')[0].innerHTML = 'Invalid password!';
        console.log('form submit2')
        return;
    }
    console.log('form submit')

    // If validation passes, allow form submission
    // Here, you might want to submit the form using AJAX or simply allow the default submission behavior
    document.getElementById('login-form').submit();
    });
</script>