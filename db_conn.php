<?php

$sname= "localhost";
$unmae= "root";
$password = "root";

$db_name = "methagile";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}