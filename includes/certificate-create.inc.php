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

               $url = 'https://www.certdepo.com/show-certificate.php?id=' . $result;

               $to = $mail;
               $subject = 'Acabas de recibir tu certificado sobre ' . $row['titleCerts'];
               $message = "<head><style>
                              .contenido{
                                 background: #1d1d1d;
                                 padding: 20px 10px;
                                 margin: 10px;
                                 border-radius: 5px;
                              }
                              p{
                                 color: #faf9f9;
                                 font-weight: bold;
                                 text-decoration: none;
                              }
                              h1{
                                 font-weight: bolder;
                                 font-size: 30px;
                                 justify-content: center;
                                 color: #faf9f9;
                              }
                              strong{
                                 color: #810000;
                                 font-weight: bold;
                                 background: #dfdfdf;
                                 padding: 5px;
                                 border-radius: 10px;
                                 margin: 5px;
                              }
                              .center{
                                 display: flex;
                                 justify-content: space-around;
                                 align-items: center;
                              }
                              a{
                                 text-decoration: none;
                                 color: #faf9f9;
                                 background: #810000;
                                 padding: 15px 10px;
                                 margin: 5px;
                                 font-weight: bolder;
                                 font-size: 20px;
                              }
                           </style></head><body>";
               $message .= '<div class="contenido"><h1>Felicidades ' . $name . '</h1>';
               $message .= '<p>Acabas de recibir tu certificado, ahora puedes acceder a tu cuenta para reclamar el certificado y asociarlo o puedes dejarlo tal y como esta. En este correo encontraras 2 codigos, uno es el token publico el que podras poner en CV o compartirlo en tus redes sociales para que todos puedan ver tu certificado, y luego esta tu codigo para reclamar el certificado, en caso de que tengas una cuenta en nuestra plataforma podras usar esto para poder asociar el certificado a tu cuenta.</p>';
               $message .= '<p>Este es tu token publico: <strong>' . $token . '</strong></p>';
               $message .= '<p>Este es tu codigo secreto para reclamar el certificado: <strong>' . $claim . '</strong></p>';
               $message .= '<div class="center"><a href="' . $url . '"><p>Ver certificado</p></a></div></div></body>';

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
