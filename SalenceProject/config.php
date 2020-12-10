<?php
session_start();
ini_set("display_errors","off");
$host = 'radepetrovic20005475.domaincommysql.com';
$username = 'rade1210';
$password = '875254Broj#';
$database = 'blogpbb';
$conn = new MySQLi($host, $username, $password, $database);
if($conn->connect_error)
{
	die("Error: " . $conn->connect_error);
}
?>