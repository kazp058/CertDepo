<?php
if (isset($_POST['login-submit'])) {

   require 'dbh.inc.php';

   $mail = $_POST['mail'];
   $password = $_POST['pwd'];

   if (empty($mail) || empty($password)) {
      header("Location: ../login.php?error=emptyfields&uid=" . $mail);
      exit();
   } else {
      $sql = "SELECT * FROM users WHERE emailUsers=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("Location: ../login.php?error=sql");
         exit();
      } else {
         mysqli_stmt_bind_param($stmt, "s", $mail);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         if ($row = mysqli_fetch_assoc($result)) {
            $pwdCheck = password_verify($password, $row['pwdUsers']);
            if ($pwdCheck == false) {
               header("Location: ../login.php?error=wrongpwd&" . $row['pwdUsers'] . "&" . $password);
               exit();
            } else if ($pwdCheck == true) {
               session_start();
               $_SESSION['userId'] = $row['idUsers'];
               $_SESSION['userUid'] = $row['uidUsers'];
               $_SESSION['userMail'] = $row['emailUsers'];
               $_SESSION['isCompany'] = $row['isCompany'];

               header("Location: ../login.php?success=login&isCompany=" . $_SESSION['isCompany']);
               exit();
            } else {
               header("Location: ../login.php?error=wrongpwd");
               exit();
            }
         } else {
            header("Location: ../login.php?error=nouser&");
            exit();
         }
      }
   }
} else {
   header("Location: ../login.php");
   exit();
}
