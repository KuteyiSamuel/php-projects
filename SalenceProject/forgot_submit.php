<?php
session_start();

require_once 'connection.php';
require_once 'random.php';
require_once 'mail_sender.php';
require_once 'input_tester.php';

$email = "";

if (isset($_POST["submit"])) {
    if (empty($_POST["email"])) {
        $_SESSION["mail_error"] = "Email address is required";
    } else {
        $_SESSION["mail"] = testInput($_POST["email"]);
        $email = $_SESSION["mail"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["mail_error"] = "Invalid email format";
        }else{
            $check = "SELECT work_mail FROM users WHERE work_mail = '$email'";
            $confirm = $conn->query($check);

            if ($confirm->num_rows == 0) {
                $_SESSION["mail_error"] = "Email does not exist in our records";
            }else{
                $_SESSION["mail_error"] = "";
            }
        }
    }

};

if ($_SESSION["mail_error"] == "") {
    $reset_code = generateRandomString(6);
    $_SESSION["reset_code"] = $reset_code;

    sendMail($email, "Password reset", $reset_code);

    header("Location: reset_password.php");
} else {
    header("Location: forgot_password.php");
};

