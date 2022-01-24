<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = $password = $password_conf = $email = $resp = "";
$loginU = $emailU = $passU = $pass2U = false;

if ($_POST != NULL) {
    if (!empty($_POST["uname"]) and
    !empty($_POST["psw"]) and
    !empty($_POST["psw-conf"]) and !empty($_POST["email"])) {

        $username = test_input($_POST["uname"]);
        $password = test_input($_POST["psw"]);
        $password_conf = test_input($_POST["psw-conf"]);
        $email = test_input($_POST["email"]);

        if (strlen($username) < 5) {
            $resp .= "Username needs to be at least 5 characters long! ";;
            $loginU = false;
        } else {
          $resp .= "<span id='correct'>Correct username format!</span> ";
            $loginU = true;
        }

        if (preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/i", $email)) {
            $resp .= "<span id='correct'>Correct email format!</span> ";
            $emailU = true;
        } else {
            $resp .= "Incorrect e-mail format! ";
            $emailU = false;
        }

        if (strlen($password) < 8) {
            $resp .= "Password must be at least 8 characters length! ";
            $passU = false;
        } else if (preg_match("/^(?=.*\d)(?=.*[a-z]).{8,50}$/i", $password)) {
            $resp .= "<span id='correct'>Correct password format!</span> ";
            $passU = true;
        } else {
            $resp .= "Password must contain letters and numbers! ";
            $passU = false;
        }

        if (strlen($password_conf) == 0) {
            $resp .= "Password confirmation can't be empty! ";
            $pass2U = false;
        } else if ($password_conf != $password) {
            $resp .= "Passwords do not match! ";
            $pass2U = false;
        } else {
            $pass2U = true;
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
  <title>Register</title>
  <link rel="stylesheet" href="../css/nav.css">
  <link rel="stylesheet" href="../css/login.css">
  <script src="../js/app.js"></script>
  <script src="../js/log_reg.js"></script>
  <script>
    function okReg() { 
      reg_msg();
    }
  </script>
</head>

<body>
  <nav>
    <div class="scrollmenu">
      <a href="../index.html">Home</a>
      <a href="login.php">Log in</a>
    </div>
  </nav>
  <div class="modal__window">
    <div class="modal__content">
      <p id="mod_msg"></p>
      <button type="button" onclick="ok_reg();">Ok</button>
    </div>
  </div>
  <div class="container">
    <form id="register" action="register.php" method="POST">
      <label for="uname"><b>Username</b></label><br>
      <input class="input1" type="text" placeholder="Enter Username" name="uname" required><br><br>
      
      <label for="psw"><b>Password</b></label><br>
      <input width="200px" type="password" placeholder="Enter Password" name="psw" required>
      <p id="passErr"></p><br>
      
      <label for="psw-conf"><b>Confirm password</b></label><br>
      <input width="200px" type="password" placeholder="Enter Password again" name="psw-conf" required>
      <p id="pass2Err"></p><br>

      <label for="email"><b>Email</b></label><br>
      <input type="text" placeholder="Enter e-mail" name="email" required>
      <p id="emailErr"></p><br>
      <p id="userErr"><?php if(!$passU || !$loginU || !$pass2U || !$emailU) {echo $resp;} else echo '<script type="text/javascript">reg_msg();</script>'?></p><br>

      <button type="button" class="cancelbtn" onclick="clearBtnReg();">Clear</button>
      <button type="submit" id="reg-btn">Register</button><br><br>

    </form>
  </div>
  <script src="../js/app.js"></script>
</body>

</html>