<?php
if(isset($_POST['search-submit'])){
  require 'dbh.inc.php';

  $key = $_POST['key'];

  if(empty($key)){
    header("Location: ../certificates.php?error=emptyfields");
    exit();
  }
  else{
    $sql = "SELECT * FROM certs WHERE certToken=?;";
    $stmt = mysqli_stmt_init($conn_certs);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../certificates.php?error=sqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($stmt, "s", $key);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if($row = mysqli_fetch_assoc($stmt)){

        if($row['isClaimed']){
          $sql = "SELECT * FROM users WHERE idUsers=?;";
          $stmt = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../certificates.php?error=sqlerror");
            exit();
          }else{
            header("Location: ../certificates.php?token=".$row['certToken']."&claimed=no");
            $_SESSION['certName'] = $row['name'];
            $_SESSION['certTitle'] = $row['title'];
            $_SESSION['certToken'] = $row['certToken'];
            $_SESSION['certDate'] = $row['cert'];
            $_SESSION['certIssuer'] = $row['certIssuer'];

            exit();
          }
        }else{
          header("Location: ../certificates.php?token=".$row['certToken']);

          $_SESSION['certName'] = 'none';
          $_SESSION['certTitle'] = 'none';
          $_SESSION['certToken'] = 'none';
          $_SESSION['certDate'] = 'none';
          $_SESSION['certIssuer'] = 'none';

          exit();
        }
      }else{
        header("Location: ../certificates.php?error=nocert");
        exit();
      }
    }
  }
}else{
  header("Location: ../certificates.php");
  exit();
}
