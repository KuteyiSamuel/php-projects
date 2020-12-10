<?php
session_start();
require_once "connection.php";

$response = [];
$token =isset($_SESSION["verification_token"]) ? $_SESSION["verification_token"] : null;
$input = isset($_POST["token"]) ? $_POST["token"] : null;
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : null;

if ($input == "") {
    $response["error"] = "Please enter the code sent to your mail";;
}else{
    if ($token != $input){
        $response["error"] = "You entered a wrong code";
    }
}

if ($response == []){
    $sql = "UPDATE users SET email_verified = true WHERE work_mail = '$email'";
    $conn->query($sql);

    $response["success"] = "Verified";
}


$time_created = $_SESSION["time_created"];
$date =  date("Y-m-d h:i:s");
$datetime = new DateTime($date);
$created = new DateTime($time_created);
$interval = $datetime->diff($created);
$response["interval"] = $interval->i;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);


