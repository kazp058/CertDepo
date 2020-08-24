<?php

require 'dbh.inc.php';

$ch = curl_init();
$clientId = "id";
$secret = "token";

curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $clientId . ":" . $secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);

if (empty($result)) die("Error: No response.");
else {
    $json = json_decode($result);
    $token = $json->access_token;
}

$ch = curl_init();

$order = $_GET['orderID'];
$user = $_GET['userID'];

curl_setopt($ch, CURLOPT_URL, 'https://api.paypal.com/v2/checkout/orders/'.$order);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$headers = array();
$headers[] = 'status: application/json';
$headers[] = 'Authorization: Bearer ' . $token;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$json = json_decode(curl_exec($ch));
$st = $json->status;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

if ($st == "COMPLETED" || $st == "APPROVED" || $st == "SAVED" || $st == "CREATED") {

    $sql = "SELECT * FROM users WHERE idUsers=?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../pricing.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $amount = $row['certificatesAv'] + 100;
        } else {
            header("Location: ../pricing.php?error=sqlerror");
            exit();
        }
    }

    $sql = "UPDATE users SET certificatesAv= ? WHERE idUsers=" . $user . ";";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../pricing.php?error=sqlerror");
        exit();
    } else {

        mysqli_stmt_bind_param($stmt, "i", $amount);
        mysqli_stmt_execute($stmt);
        header("Location: ../thanks.php?success=payment");
        exit();
    }
}
else if($st == "VOIDED"){
    header("Location: ../pricing.php?error=noitem");
    exit();
}else{
    header("Location: ../pricing.php?error=notransaction");
    exit();
}
