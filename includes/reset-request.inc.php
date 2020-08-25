<?php

require 'sendEmail.inc.php';

if (isset($_POST["reset-request-submit"])) {
  $userEmail = $_POST["email"];

  if (empty($userEmail)) {
    header("Location: ../reset-password.php?error=emptyfields");
    exit();
  } else if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../reset-password.php?error=invalidmail");
    exit();
  } else {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "192.168.100.100/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expires = date("U") + 1800;

    require 'dbh.inc.php';

    $sql = "SELECT * FROM users WHERE emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../reset-password.php?error=sql");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $userEmail);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
      } else {
        header("Location: ../reset-password.php?error=nouser");
        exit();
      }
    }

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail =?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../reset-password.php?error=sql");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $userEmail);
      mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../reset-password.php?error=sql");
      exit();
    } else {
      $hashedToken = password_hash($token, PASSWORD_DEFAULT);
      mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
      mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $to = $userEmail;
    $subject = 'Reset your password for Certme';
    $message = '<p>We received a password reset request. The link to reset your password. If you didnt make this request please ignore this email</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: Certme <email@gmail.com>\r\n";
    $headers .= "Reply-To: support@certme.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    sendmail($to, $subject, $message);
    header("Location: ../reset-password.php?reset=success");
    exit();
  }
} else {
  header("Location: ../index.php");
}
