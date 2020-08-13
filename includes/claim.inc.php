<?php

if (isset($_POST['claim-submit'])) {
  require 'dbh.inc.php';

  $token = $_POST['token'];
  $claim = $_POST['ccode'];
  $id = $_POST['userId'];

  if (empty($token) || empty($claim)) {

    header('Location: ../certificates.php?error=emptyfield&token=' . $token . '&claim=' . $claim);
    exit();
  } else {

    $sql = "SELECT * FROM certs WHERE token=?;";
    $stmt = mysqli_stmt_init($conn_certs);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../certificates.php?error=sql");
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $token);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result)) {
        if ($row['claimcode'] == $claim) {
          $sql = "UPDATE certs SET userId=? WHERE token=?;";
          $stmt = mysqli_stmt_init($conn_certs);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../certificates.php?error=sql");
            exit();
          } else {
            mysqli_stmt_bind_param($stmt, "ss", $id, $token);
            mysqli_stmt_execute($stmt);

            header("Location: ../certificates.php?claimed=success");
            exit();
          }
        } else {
          header("Location: ../certificates.php?error=codeerror");
          exit();
        }
      } else {
        header("Location: ../certificates.php?error=certnotfound");
        exit();
      }
    }
  }
} else {
  header('Location: ../certificates.php');
  exit();
}
