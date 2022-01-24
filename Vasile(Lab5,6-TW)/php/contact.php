<?php
$name = $_POST["uname"];
$mobile_number = $_POST["mobile-code"].'-'.$_POST["mobile-number"];
$text = $_POST["text-problem"];

$mysqli = @mysqli_connect('localhost', 'root', '', 'tw_lab');

$mysqli->query("INSERT INTO contacts VALUES(NULL, '$name', '$mobile_number', '$text')");

$mysqli->close();