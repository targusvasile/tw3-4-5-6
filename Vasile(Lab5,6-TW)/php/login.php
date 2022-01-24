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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST["uname"]) and !empty($_POST["psw"])) {
        $username = test_input($_POST["uname"]);
        $password = test_input($_POST["psw"]);

        if (strlen($username) < 5) {
            $resp .= "Username needs to be at least 5 characters long! ";
            $loginU = false;
        } else if (preg_match("/^[\w0-9]+$/i", $username)) {
            $resp .= "Correct username format! ";
            $loginU = true;
        } else {
            $loginU = false;
            $resp .= "Incorrect username format, only numbers, underscore and english letters! ";
        }

        if (strlen($password) < 8) {
            $resp .= "Password needs to be at least 8 characters long! ";
            $passU = false;
        } else if (preg_match("/^(?=.*\d)(?=.*[a-z]).{8,50}$/i", $password)) {
            $resp .= "Correct password format! ";
            $passU = true;
        } else {
            $resp .= "Password must contain letters and numbers! ";
            $passU = false;
        }
        if ($passU and $loginU) {
    
            $mysqli = @mysqli_connect('localhost', 'root', '', 'tw_lab');
            
            if(!$mysqli){
                echo "Database error!";
                return;
            }

            $res_user = $mysqli->query("SELECT id_user, username FROM accounts WHERE username='".$username."'");

            if(mysqli_num_rows($res_user) != 0)
            {
                $res_user_id = mysqli_fetch_array($res_user);
                $res_pass = $mysqli->query("SELECT password FROM accounts WHERE username='".$username."'");
            
                $res = mysqli_fetch_array($res_pass);
            
                if (password_verify($password, $res["password"])) {
                    // Success!
                    $resp = $res_user_id['id_user'];
                }
                else {
                    // Invalid credentials
                    $resp = "false";
                }
            }
            else
            {
                $resp = "false";
            }
            $mysqli->close();
            print($resp);
        }
    }
} else{
    print("Incorrect request!");
}
?>