<?php
    $id = $_POST["id"];
    
    $mysqli = @mysqli_connect('localhost', 'root', '', 'tw_lab');
    if(!$mysqli){
        echo "Database error!";
        return;
    }
    $mysqli->query("DELETE FROM contacts WHERE id_contact='$id'");
    $mysqli->close();

?>