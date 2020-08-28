<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require_once('/usr/share/php/libphp-phpmailer/autoload.php');
require "/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php";
function sendmail($email,$subject,$body){
  if(!empty($email)){
//    require_once "../usr/share/php/libphp-phpmailer/src/PHPMailer.php";
//    require_once "../usr/share/php/libphp-phpmailer/src/SMTP.php";
//    require_once "../usr/share/php/libphp-phpmailer/src/Exceptiom.php";
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->SMTPAuth = true;
    include 'credentials.php';
    $mail->Username = $account;
    $mail->Password = $accountpwd;
    //$mail->Port = 465;
    //$mail->SMTPSecure = "ssl";
    $mail->isHTML(true);
    $mail->setFrom('certdepo@gmail.com');
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if($mail->send()){
       $status = "success";
       $response = "Email is sent!";
    }
    else
    {
       header("Location: ../reset-password.php?error=serviceinvalid");
       exit();
    }      //return json_encode(array("status"=>$status, "response"=>$response));
  }
}
