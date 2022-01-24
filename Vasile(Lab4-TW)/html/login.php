<?php
  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $username = $password = $resp = "";
  $passU = $loginU = false;

  if ($_POST != NULL) {

    if (!empty($_POST["uname"]) and !empty($_POST["psw"])) {
      $username = test_input($_POST["uname"]);
      $password = test_input($_POST["psw"]);

      if (strlen($username) < 5) {
        $resp .= "Username needs to be at least 5 characters long! ";
        $loginU = false;
      } else if (preg_match("/^[\w0-9]+$/i", $username)) {
        $resp .= "<span id='correct'>Correct username format!</span> ";
        $loginU = true;
      } else {
        $loginU = false;
        $resp .= "Incorrect username format, only numbers, underscore and english letters! ";
      }

      if (strlen($password) < 8) {
        $resp .= "Password needs to be at least 8 characters long! ";
        $passU = false;
      } else if (preg_match("/^(?=.*\d)(?=.*[a-z]).{8,50}$/i", $password)) {
        $resp .= "<span id='correct'>Correct password format!</span> ";
        $passU = true;
      } else {
        $resp .= "Password must contain letters and numbers! ";
        $passU = false;
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Log in</title>
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../js/log_reg.js"></script>
    <script type="text/javascript">
      function addToStorage(){
        sessionStorage.setItem("id", "0");
        login_msg();
      }
    </script>
</head>
<body>

    <nav>
        <div class="scrollmenu">
            <a href="../index.html">Home</a>
            <a href="register.php">Register</a>
          </div>
        </nav>
        <div class="modal__window">
          <div class="modal__content">
            <p id="mod_msg"></p>
            <button type="button" onclick="ok_auth();">Ok</button>
          </div>
        </div>
      <div class="container">
        <form id="login" action="login.php" method="POST">
        <label for="uname"><b>Username</b></label><br>
        <input type="text" placeholder="Enter Username" name="uname" required><br><br>
        
        <label for="psw"><b>Password</b></label><br>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <p id="userErr"><?php if(!$passU || !$loginU){ echo $resp; } else echo '<script type="text/javascript">addToStorage();</script>';?></p><br>
        <p id="passErr"></p>

        <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
        </label><br>

        <button type="button" class="cancelbtn" onclick="clearBtnLog();">Clear</button>
        <button type="submit" id="log-btn">Login</button><br><br>

        <span class="psw">Forgot <a href="#">password?</a></span>
        </form>

      </div>
    
  
  <script src="../js/app.js"></script>
</body>
</html>