<?php
session_start();

require_once "connection.php";
require_once "random.php";
require_once 'input_tester.php';

$response = array();
$firstname =isset($_POST["firstname"]) ? $_POST["firstname"] : null;
$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : null;
$email =isset($_POST["email"]) ? $_POST["email"] : null;
$career_field = isset($_POST["career_field"]) ? $_POST["career_field"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;


if ($firstname == ""){
    $response['firstname'] = "Please enter your firstname";
}else{
    $firstname_tested = testInput($firstname);
    if (!preg_match("/^[a-zA-Z-']*$/", $firstname_tested)) {
        $response['firstname'] = "Invalid name pattern";
    }
}

if ($lastname == ""){
    $response['lastname'] = "Please enter your lastname";
}else{
    $lastname_tested = testInput($lastname);
    if (!preg_match("/^[a-zA-Z-']*$/", $lastname_tested)) {
        $response['lastname'] = "Invalid name pattern";
    }
}



if ($email == ""){
    $response['email'] = "Please enter your email address";
}else{
    $email_tested = testInput($email);

    if (!filter_var($email_tested, FILTER_VALIDATE_EMAIL)){
        $response["email"] = "You entered an invalid email address";
    } else{
        $mail_sql = "SELECT work_mail FROM users WHERE work_mail = '$email_tested'";
        $result = $conn->query($mail_sql);

        if ($result->num_rows > 0){
            $response["email"] = "This email address is already registered";
        }
    }
}

if ($career_field == ""){
    $response["career_field"] = "Please select your field";
}

if ($password == ""){
    $response["password"]  = "Please enter a password";
}else{
    $password_tested =  testInput($password);
    if (strlen($password_tested) < 8){
        $response["password"] = "Your password needs to be at least 8 characters long";
    }
}

if ($response == []){
    $password_hash = password_hash($password_tested, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (`firstname`, `lastname`, `work_mail`, `career_field`, `password`, `email_verified`) VALUES
            ('$firstname_tested', '$lastname_tested', '$email_tested', '$career_field', '$password_hash', false)";
    $conn->query($sql);

    if ($_SESSION["verification_token"] == null) {
        $_SESSION["verification_token"] = generateRandomString(6);
        $_SESSION["time_created"] = date("Y-m-d h:i:s");
        $_SESSION["email"] = $email_tested;
    }
    $response["success"] = "Successfully authenticated and registered";

}


$conn->close();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
