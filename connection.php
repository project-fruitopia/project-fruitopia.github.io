<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "demo";

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if (!$con) {
		
	die("Connection Failed!".mysqli_connect_error());
}

?>