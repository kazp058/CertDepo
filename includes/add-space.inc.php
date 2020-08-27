<?php

if (isset($_POST['addup-submit'])) {
    require 'dbh.inc.php';

    $id = $_POST['id'];
    $addup = $_POST['addup'];

    $sql = "SELECT * FROM certscompany WHERE certId=?;";
    $stmt = mysqli_stmt_init($conn_certs);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../certificates.php?error=sql");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $sql = "UPDATE certscompany SET certsAssigned = " . $row['certsAssigned'] . "+ ? WHERE certId=?;";
        $stmt = mysqli_stmt_init($conn_certs);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../certificates.php?error=sql");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ii", $addup, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
} else {
    header("Location: certificates.php");
    exit();
}
