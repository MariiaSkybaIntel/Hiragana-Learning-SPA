<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "hiragana";

$conn = mysqli_connect($servername, $username, $password, $db_name) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_error()) 
{
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
?>
