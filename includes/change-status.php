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
    header("Location: ../support.php?success=change&id=".$id);
    exit();
}
}else{
    header("Location: ../support.php");
    exit();
}