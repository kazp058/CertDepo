<?php

$servername="localhost";
$dBUsername="root";
$dBPassword="Ero14a$S";
$dBName="loginsystem";

$conn = mysql_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn){
   die("Connection failed: ".mysql_connect_error());
}
