<?php

if(isset($_POST["reset-request-submit"])){

  $selecter = bin2hex(random_byte(8));
  $token = random_bytes(32);

  $url = "www.domain.com/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

  $expires = date("U") + 1800;


}
else
{
  header("Location: ../index.php");
}
