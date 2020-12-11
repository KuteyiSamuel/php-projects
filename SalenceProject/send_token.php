<?php

session_start();

require_once "random.php";
require_once "mail_sender.php";

$response = [];

$new_request = isset($_POST["new_request"]) ? $_POST['new_request'] : null;

if ($new_request != null){
    $_SESSION["verification_token"] = generateRandomString(6);
}

$token = isset($_SESSION["verification_token"]) ? $_SESSION["verification_token"] : $_SESSION["reset_code"];

$email = isset($_POST["mail"]) ? $_POST["mail"] : $_SESSION["mail"];

if ($_SESSION["mail"] != null && $token == $_SESSION["reset_code"]){
    if ($email == $_SESSION["mail"]) {
        if(sendMail($email, "Password reset", $token) == "Mail sent"){
            $response["status"] = 200;
        } else{
            $response["status"] = 400;
        }
    }
}else{
    if(sendMail($email, "Mail verification", $token) == "Mail sent"){
        $response["status"] = 200;
    } else{
        $response["status"] = 400;
    }
}

$response["token"] = $token;


header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
