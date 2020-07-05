<?php
   include 'dbh.inc.php';

   if(isset($_POST['certificate-submit'])){
      $userId = $_POST['uid'];

      if(empty($userId)){
         header("Location: ../login.php");
         exit();
      }

      $sql = "USE certs?;"
      $stmt = mysqli_stmt_init($conn_server);
      if(!mysqli_stmt_prepare($stmt, $sql)){
         header("Location: ../certificates.php?error=sqlerror");
         exit();
      }
      else
      {
         mysqli_stmt_bind_param($stmt, "s", $userId);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
      }

   }
   else{

   }
