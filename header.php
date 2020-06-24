<?php
   session_start();
?>
<!DOCTYPE html>
<html Lang="en">
   <head>
      <meta charset="utf-8">
      <meta name= "description" content="Test">
      <meta name=viewport content="width=device-width, initial-scale=1">
      <title>Certificates</title>
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
   </head>

   <body>
     <header>
      <nav>
         <div class="logo">
             <h2>Untitled Certificate</h2>
         </div>
         <ul class="nav-links">
           <li><a href = "index.php">Home</a></li>
           <li><a href = "#">Certificates</a></li>
           <li><a href = "#">About us</a></li>
           <li><a href = "#">Support</a></li>
         </ul>
        <div>
           <form action="includes/login.inc.php" method="post">
               <input type="text" name="uid" placeholder="Username..">
               <input type="password" name="pwd" placeholder="Password...">
               <button type="submit" name="login-submit">Login</button>
           </form>
           <a href="signup.php">Signup</a>
           <form class="includes/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
           </form>
        </div>
      </nav>
     </header>
   </body>


</html>
