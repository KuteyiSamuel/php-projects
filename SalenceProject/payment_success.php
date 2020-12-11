<?php
session_start();
require_once "connection.php";

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

$sql = "UPDATE users SET activated = true WHERE id = '$user_id'";
$conn->query($sql);

$_SESSION["logged_in"] = true;

header("Location: index.php");
