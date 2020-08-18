<?php

require 'dbh.inc.php';

$ch = curl_init();
$clientId = "AYEuYnrTMJSbENtLsULbIA-DHk7MYeDgAd_enuN2tYsLRgIi7TvsYZTQHx2vRuZkxjJ7AeLJjzGUQggu";
$secret = "EHCmAKSHHXk7_VLvLqiu6E1lxVCXjGkIefRBT7NNnw9T3PCksjO_VDQJGJ8TAnpaaiNVJUW70YEa4khu";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);

if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
    $token = $json->access_token;
}

curl_close($ch);

require 'Checkout-PHP-SDK/vendor/autoload.php';
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
// Creating an environment

$environment = new SandboxEnvironment($clientId, $secret);
$client = new PayPalHttpClient($environment);

$order = $_GET['orderID'];
$user = $_GET['userID'];

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

$sql = "UPDATE users SET certificatesAv= ? WHERE idUsers=" . $user. ";";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../pricing.php?error=sqlerror");
    exit();
} else {

    mysqli_stmt_bind_param($stmt, "i", $amount);
    mysqli_stmt_execute($stmt);
    header("Location: ../pricing.php?success=payment");
    exit();
}
?>