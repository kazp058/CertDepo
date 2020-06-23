<?php

$servername="localhost:3036";
$dBUsername="root";
$dBPassword="admin";
$dBName="loginsystem";

$conn = mysql_connect($servername, $dBUsername, $dBPassword);

if (!$conn){
  die("Connection failed: ".mysql_connect_error());
}
