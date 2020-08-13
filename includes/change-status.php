<?php

if(isset($_POST['change-submit'])){
require 'dbh.inc.php';

$sql = "UPDATE users SET isCompany=1  WHERE idUsers=?;";
$stmt = mysqli_stmt_init($conn);

$id = $_POST['id'];

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../support.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    $sql = "SELECT * FROM users WHERE idUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
       header("Location: ../login.php?error=sqlerror");
       exit();
    } else {
       mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
       mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       if ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['isCompany'] = $row['isCompany'];
       }
    }

    header("Location: ../support.php?success=change");
    exit();
}
}else{
    header("Location: ../support.php");
    exit();
}