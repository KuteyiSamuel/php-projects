<?php
require_once 'input_tester.php';

$response = [];
$first_name =isset($_POST["firstname"]) ? $_POST["firstname"] : null;
$last_name = isset($_POST["lastname"]) ? $_POST["lastname"] : null;
$mail =isset($_POST["email"]) ? $_POST["email"] : null;
$company = isset($_POST["company"]) ? $_POST["company"] : null;
$profile_link = isset($_POST["profile_link"]) ? $_POST["profile_link"] : null;



if ($first_name == ""){
    $response['firstname'] = "Please enter your firstname";
}else{
    $firstname_tested = testInput($first_name);
    if (!preg_match("/^[a-zA-Z-']*$/", $firstname_tested)) {
        $response['firstname'] = "Invalid name pattern";
    }
}

if ($last_name == ""){
    $response['lastname'] = "Please enter your lastname";
}else{
    $lastname_tested = testInput($last_name);
    if (!preg_match("/^[a-zA-Z-']*$/", $lastname_tested)) {
        $response['lastname'] = "Invalid name pattern";
    }
}



if ($mail == ""){
    $response['email'] = "Please enter your email address";
}else{
    $email_tested = testInput($mail);

    if (!filter_var($email_tested, FILTER_VALIDATE_EMAIL)){
        $response["email"] = "You entered an invalid email address";
    }
}

if ($company == ""){
    $response["company"] = "Please enter your company name";
}else{
    $company_tested = testInput($company);
}

if ($profile_link != null) {
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]
        *[-a-z0-9+&@#\/%=~_|]/i",$profile_link)){
        $response["profile_link"] = "Invalid URL entered";
    }
}

if ($response == []){
    $response["success"] = "Successfully authenticated";
}

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
