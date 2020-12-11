<?php
/* Template Name: Set Password Submit */
session_start();

require_once "connection.php";

$new_password = "";

$email =isset($_SESSION["mail"]) ? $_SESSION["mail"] : null;

if (isset($_POST["submit"])) {
    if (empty($_POST["password"])) {
        $_SESSION["password_error"] = "Please enter a password";
    } else {
        $_SESSION["password"] = $_POST["password"];
        $new_password = $_SESSION["password"];

        if (strlen($new_password) < 8){
            $_SESSION["password_error"] = "Your password must be at least 8 characters long.";
        }else{
            $_SESSION["password_error"] = "";
        }

    }

};

$next = "";
if ($_SESSION["password_error"] == "") {
    $hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$hashed' WHERE work_mail = '$email'";
    $conn->query($sql);
    $_SESSION["updated"] = true;

    header("Location: login.php");
} else {
    header("Location: set_password.php");
};
