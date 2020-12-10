<?php

$response = [];
$recipients = [];
$i = 0;

$array = isset($_POST["array"]) ? $_POST["array"] :  null;

$recipients["recipient"][$i] = $array;
$i++;
$response['items'] = $recipients;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
