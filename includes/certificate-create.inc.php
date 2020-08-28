<?php

if (isset($_POST['survey-submit'])) {
   require 'dbh.inc.php';
   require 'sendEmail.inc.php';

   $name = $_POST['fname'] . " " . $_POST['sname'] . " " . $_POST['flname'] . " " . $_POST['slname'];
   $mail = $_POST['email'];
   $id = $_POST['id'];
   $claim = random_int(100000, 999999);
   $date = date("U");
   $image = "001";

   if (empty($mail) || empty($name) || empty($id)) {
      header('Location: ../survey.php?id=' . $id . '&error=emptyfields&fname=' . $name[1] . '&sname=' . $name[2] . '&flname=' . $name[3] . '&slname=' . $name['slname'] . '&email' . $email);
      exit();
   } else {

      $repeated = true;
      $i = 0;
      $token = bin2hex(random_bytes(11));
      while ($repeated) {
         $sql = "SELECT * FROM certs WHERE tokenCerts=?;";
         $stmt = mysqli_stmt_init($conn_certs);

         if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../survey.php?error=sql");
            exit();
         } else {
            mysqli_stmt_bind_param($stmt, "s", $token);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
               $token = bin2hex(random_bytes(11));
               $i = $i + 1;
            } else {
               $repeated = false;
            }
            if ($i > 30) {
               header("Location: ../survey.php?id=" . $id . "&error=nospace");
               exit();
            }
         }
      }

      $sql = "SELECT * FROM certscompany WHERE certId=?;";
      $stmt = mysqli_stmt_init($conn_certs);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("Location: ../survey.php?id=" . $id . "&error=sql");
         exit();
      } else {
         mysqli_stmt_bind_param($stmt, "s", $id);
         mysqli_stmt_execute($stmt);
         $result = mysqli_stmt_get_result($stmt);

         if ($row = mysqli_fetch_assoc($result)) {

            $sql = "UPDATE certscompany SET certsCreated=" . $row['certsCreated'] . " +1 WHERE certId=?;";
            $stmt = mysqli_stmt_init($conn_certs);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
               header("Location: ../survey.php?id=" . $id . "&error=sql");
               exit();
            } else {
               mysqli_stmt_bind_param($stmt, "s", $id);
               mysqli_stmt_execute($stmt);
               $result = mysqli_stmt_get_result($stmt);
            }

            $sql = "INSERT INTO certs (titleCerts, userName, certMail, issuerCerts, tokenCerts, claimCerts, imageCert, dateCert) VALUES (?,?,?,?,?,?,?,?);";
            $stmt = mysqli_stmt_init($conn_certs);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
               header("Location: ../survey.php?id=" . $id . "&error=sql");
               exit();
            } else {
               mysqli_stmt_bind_param($stmt, "sssisiss", $row['titleCerts'], $name, $mail, $id, $token, $claim, $image, $date);
               mysqli_stmt_execute($stmt);
               $result = mysqli_stmt_insert_id($stmt);

               $url = 'http://www.certdepo.com/show-certificate.php?id=' . $result;

               $to = $mail;
               $subject = 'Acabas de recibir tu certificado sobre ' . $row['titleCerts'];
               $message = '<p>Felicidades ' . $name . '</p>';
               $message .= '<p>Acabas de recibir tu certificado, ahora puedes acceder a tu cuenta para reclamar el certificado y asociarlo o puedes dejarlo tal y como esta.</p>';
               $message .= '<p>Este es tu token publico: ' . $token . '</p>';
               $message .= '<p>Este es tu codigo secreto para reclamar el certificado: ' . $claim . '</p>';
               $message .= '<p>Ve a este link para reclamar el certificado:</br>';
               $message .= '<a href="' . $url . '">' . $url . '</a></p>';

               $headers = "From: Certme <email@gmail.com>\r\n";
               $headers .= "Reply-To: support@certme.com\r\n";
               $headers .= "Content-type: text/html\r\n";

               sendmail($to, $subject, $message);

               header("Location: ../survey.php?id=" . $id . "&success=cert");
               exit();
            }
         } else {
            header("Location: ../survey.php?id=" . $id . "&error=nocert");
            exit();
         }
      }
   }
} else {
   header("Location: ../survey.php?id=" . $id);
   exit();
}
