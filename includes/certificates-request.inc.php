<?php
include 'dbh.inc.php';

if (isset($_POST['certificate-submit'])) {
   $userId = $_POST['uid'];
   $type = $_POST['gather'];
   $title = $_POST['certname'];
   $issuername = $_POST['certissuer'];
   $issuermail = $_POST['emailissuer'];
   $assigned = $_POST['assignedcert'];
   $date = date("U");
   $url = "192.168.100.100/survey.php?id=";

   if (empty($userId) || empty($type) || empty($title) || empty($issuername) || empty($issuermail) || empty($assigned)) {
      header("Location: ../create-certificate.php?error=emptyfelds");
      exit();
   }

   $sql = "INSERT INTO certscompany (titleCerts, dateCert ,certsCreated, certsAssigned, issuerCerts, issuerName, emailCert , gatherType) VALUES (?,?,0,?,?,?,?,?);";
   $stmt = mysqli_stmt_init($conn_certs);
   if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../create-certificate.php?error=sqlerror");
      exit();
   } else {
      mysqli_stmt_bind_param($stmt, "sssisss", $title, $date, $assigned, $userId, $issuername, $issuermail, $type);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      $sql = "SELECT * FROM users WHERE idUsers=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("Location: ../create-certificate.php?error=sqlerror");
         exit();
      } else {
         mysqli_stmt_bind_param($stmt, "s", $userId);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);
         if ($row = mysqli_fetch_assoc($result)) {
            $amount = $row['certificatesAv'] - $assigned;
         } else {
            header("Location: ../create-certificate.php?error=sqlerror");
            exit();
         }
      }

      $sql = "UPDATE users SET certificatesAv= ? WHERE idUsers=" . $userId . ";";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
         echo "There was an error!";
         exit();
      } else {

         mysqli_stmt_bind_param($stmt, "i", $amount);
         mysqli_stmt_execute($stmt);
      }

      header("Location: ../create-certificate.php?success=created");
      exit();
   }
} else {
   header("Location: ../create-certificate.php");
   exit();
}
