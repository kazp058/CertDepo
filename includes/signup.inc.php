<?php
if(isset($_POST['signup-submit'])){
    require "dbh.inc.php";

    $username = $_POST["uid"];
    $email = $_POST["mail"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];

    if(empty($username)||empty($email)||empty($password)|| empty($passwordRepeat)){
       header("Location: ../signup.php?error=emptyfield&uid=".$username."&mail=".$email);

    }
}
