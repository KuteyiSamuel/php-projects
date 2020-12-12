<?php

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($address, $type, $token = null, $link = null)  {

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
    $mail->addAddress($address);

    if($type == "Mail verification"){
        $mail->Subject = "Email verification";
        $message = "<p style='font-size: 15px'>Hello. Please use this code for your email verification: 
<span style='font-weight: bold; color: rgb(51, 124, 106);'>" .$token. "</span></p>";
    }

    if ($type == "Password reset"){
        $mail->Subject = "Password reset";
        $message = "<p style='font-size: 15px'>Hello. Please use this token for your password reset:  
<span style='font-weight: bold; color: rgb(51, 124, 106);'>" .$token. "</span></p>";
    }

    if ($type == "Letter delivery"){
        $mail->Subject = "You have a new letter delivery order";
        $message = "<p style='font-size: 15px'>Hello, you have a new letter delivery order. See more details  
<a href='" .$link. "' style='font-weight: bold; color: rgb(51, 124, 106);  text-decoration: underline;'>here</a></p>";
    }

    $mail->Body = $message;

    if ($mail->send()){
        return "Mail sent";
    }else{
        return "Error sending mail";
    }

}
