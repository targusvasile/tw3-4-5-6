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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $loginU = true;
        }

        if (preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/i", $email)) {
            $resp .= "Correct email format! ";
            $emailU = true;
        } else {
            $resp .= "Incorrect e-mail format! ";
            $emailU = false;
        }

        if (strlen($password) < 8) {
            $resp .= "Password must be at least 8 characters length! ";
            $passU = false;
        } else if (preg_match("/^(?=.*\d)(?=.*[a-z]).{8,50}$/i", $password)) {
            $resp .= "Correct password format! ";
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
        if ($loginU and $emailU and $passU and $pass2U) {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $mysqli = @mysqli_connect("localhost", "root", "", "tw_lab");

            if(!$mysqli){
                echo "Database error!";
                return;
            }

            $res = $mysqli->query("SELECT username FROM accounts WHERE username='".$username."'");

            if(mysqli_num_rows($res) != 0)
                $resp = "false";
            else
            {
                $query = "INSERT INTO accounts VALUES(NULL, '$username', '$password', '$email')";
                $mysqli->query($query);
                $resp = "true";
            }
            $mysqli->close();
            echo $resp;
        }
    } else{
        echo $resp;
    }
} else{
    echo "Incorrect request!";
}