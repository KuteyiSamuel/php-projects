<?php
session_start();

$sent_code = isset($_SESSION["reset_code"]) ? $_SESSION["reset_code"] : null;

$code =  "";

if (isset($_POST["submit"])) {

    if (empty($_POST["code"])) {
        $_SESSION["code_error"] = "Please enter the code sent to your mail";
    } else {
        $_SESSION["code"] = $_POST["code"];
        $code = $_SESSION["code"];

        if ($code != $sent_code){
            $_SESSION["code_error"] = "Invalid password reset token";
        }else{
            $_SESSION["code_error"] = "";
        }
    }

};

$next = "";
if ($_SESSION["code_error"] == "") {
    header("Location: set_password.php");
} else {
    header("Location: reset_password.php");
};

