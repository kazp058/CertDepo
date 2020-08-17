<?php

$servername= "localhost";
$dBUsername="server";
$dBPassword="server";

$dBName= "loginsystem";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
$conn_certs = mysqli_connect($servername, $dBUsername, $dBPassword, "certificatesdb");

if (!$conn){
  die("Connection failed: ".mysqli_connect_error());
}

if(!$conn_certs){
  die("Connection failed: ".mysqli_connect_error());
}

$conn_server = mysqli_connect($servername, $dBUsername, $dBPassword);
