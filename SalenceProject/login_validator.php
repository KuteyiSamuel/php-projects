<?php
session_start();

require_once "connection.php";
require_once "input_tester.php";

$login_email =isset($_POST["email"]) ? $_POST["email"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;
$response = [];

if ($login_email == ""){
    $response['email'] = "Please enter your email address";
}else{
    $email_tested = testInput($login_email);

    if (!filter_var($email_tested, FILTER_VALIDATE_EMAIL)){
        $response["email"] = "You entered an invalid email address";
    } else{
        $mail_sql = "SELECT id, firstname, lastname, work_mail, activated FROM users WHERE work_mail = '$email_tested'";
        $result = $conn->query($mail_sql);

        if ($result->num_rows == 0){
            $response["email"] = "This email address does not exist in our records";
        }else{
            while($row = $result->fetch_assoc()) {
                if ($row["activated"] == false){
                    $_SESSION["user_id"] = $row["id"];
                    $response["items"][] = $row;
                }
            }
        }
    }
}
if ($password == ""){
    $response["password"]  = "Please enter a password";
}else{
    $password_tested =  testInput($password);
    $sql = "SELECT password FROM users WHERE work_mail = '$email_tested'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
       while($row = $result->fetch_assoc()){
           $db_password = $row["password"];
       }
    }

    if (!password_verify($password_tested, $db_password)){
        $response["password"]  = "Incorrect password";
    }
}

if ($response == []){
    $_SESSION["logged_in"] = true;

    $id_sql = "SELECT id FROM users WHERE work_mail = '$email_tested'";
    $result_id = $conn->query($id_sql);

    if ($result_id->num_rows > 0) {
        while($row_id = $result_id->fetch_assoc()){
            $_SESSION["user_id"] = $row_id["id"];
        }
    }
   $response["success"] = "Authenticated";
}

$conn->close();

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
