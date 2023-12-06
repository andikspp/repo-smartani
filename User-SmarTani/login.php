<?php
session_start();

// Check if the success message is set
if (isset($_SESSION['success_message'])) {
    // Display the success message
    echo '<div class="notification success">Login successful! Welcome back!</div>';

    // Clear the success message from the session
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
      body {
        margin: 0;
        padding: 0;
      }

      .container {
        display: flex;
        height: 100vh;
      }

      .container-left {
        flex: 1;
        background-color: #004a15;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      .welcome {
        text-align: center;
        color: white;
        margin-bottom: 20px;
      }

      .container-right {
        flex: 1;
        background-color: #ffffff;
        padding: 20px;
        text-align: center;
        margin: auto;
      }

      .container-login {
        width: 80%;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
        background-color: #ffffff;
        padding: 20px;
        border: 1px solid #004a15;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
      }

      .container-login h1 {
        font-size: 24px;
        margin-bottom: 20px;
      }

      .form-group {
        margin-bottom: 15px;
        text-align: left;
      }

      .form-group label {
        display: block;
        margin-bottom: 5px;
      }

      .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #d9d9d9;
        border-radius: 5px;
        font-size: 16px;
      }

      button[type="submit"] {
        background-color: #004a15;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
      }

      button[type="submit"]:hover {
        background-color: #00390e;
      }

      .content {
        text-align: center;
        padding: 20px;
      }

      .logo img {
        width: 200px;
        height: auto;
      }

      .notification {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
      }

    .success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
      }

    </style>
  </head>
  <body>
    <div class="container">
      <div class="container-left">
        <div class="welcome">
          <h1>Welcome to SmarTani</h1>
          <h2><i>Plant Smartly, Harvest Proudly</i></h2>
        </div>
        <div class="logo">
          <img src="Logo transparan.png" alt="Logo SmarTani" />
        </div>
      </div>
      <div class="container-right">
        <div class="container-login">
          <div class="content">
            <h1>Login</h1>
            <form id="login-form" action="proses_login.php" method="POST">
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required />
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required />
              </div>
              <p>
                Belum punya akun? <a href="register.php">Create Account</a>
              </p>
              <button type="submit">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
        // Add JavaScript to close the success message after a few seconds (optional)
        setTimeout(function(){
            var successMessage = document.querySelector('.notification.success');
            if(successMessage) {
                successMessage.style.display = 'none';
            }
        }, 5000); // Adjust the time (in milliseconds) as needed
    </script>
  </body>
</html>
