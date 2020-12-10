<?php

session_start();

require_once "random.php";

$new_request = isset($_POST["new_request"]) ? $_POST['new_request'] : null;

if ($new_request != null){
    $_SESSION["verification_token"] = generateRandomString(6);
}

$token = isset($_SESSION["verification_token"]) ? $_SESSION["verification_token"] : null;

use PHPMailer\PHPMailer\PHPMailer;

$email = isset($_POST["mail"]) ? $_POST["mail"] : $_SESSION["mail"];
$response = [];

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/Exception.php";
require_once "PHPMailer/SMTP.php";

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "immaculate88888@gmail.com";
$mail->Password = "sam987412admin10";
$mail->Port = 465;
$mail->SMTPSecure = "ssl";

$mail->isHTML(true);
$mail->setFrom("immaculate88888@gmail.com", "Salence");
$mail->addAddress($email);
$mail->Subject = "Email verification";
$message = "Hello. Please use this code for your email verification: " .$token;
$mail->Body = $message;

if ($mail->send()){
    $response["mail_response"] = "Mail sent";
}else{
    $response["mail_response"] =  $mail->ErrorInfo;
}

$response["token"] = $token;


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
