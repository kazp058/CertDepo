<?php

if(isset($_POST['survey-submit'])){
   require 'dbh.inc.php';

   $name = array(1 => $_POST['fname'], 2 => $_POST['sname'], 3 => $_POST['flname'], 4 => $_POST['slname']]);
   $mail = $_POST['email'];

   if (empty($mail) || empty($name[1]) || empty($name[2]) || empty($name[3]) || empty($name[4])){
      header('Location: ../survey.php?error=emptyfields&fname='.$name[1].'&sname='.$name[2].'&flname='.$name[3].'&slname='.$name['slname'].'&email'.$email);
      exit();
   }
   else{

      

   }
}
else{
   header("Location: ../survey.php");
   exit();
}
