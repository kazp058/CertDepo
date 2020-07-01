<?php
  use PHPMailer;

  if(isset($_POST['name']) && isset($_POST['email'])){

    $name = $_POST['name';
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exceptiom.php";

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "myemail@gmail.com";
    $mail->Password = "password";
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("myemail@gmail.com");
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $body;

    if($mail->send()){
      $status = "success";
      $response = "Email is sent!";
    }
    else
    {
      $status = "failed";
      $response = "Somethinge went wrong: <br>".$mail->ErrorInfo;
    }
    exit(json_encode(array("status"=>$status, "response"=>$response)));

  }

?>
