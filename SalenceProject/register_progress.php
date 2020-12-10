<?php
session_start();
$_SESSION["verification_token"] = null;
$response = [];

$started =  1;
$not_started = 0;

$token = isset($_SESSION["verification_token"]) ? $_SESSION["verification_token"] : null;

if ($token == null){
    $response["status"] = $not_started;
}else{
    $response["status"] = $started;
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
