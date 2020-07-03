<?php
   session_start();
?>

<!DOCTYPE html>
<html Lang="en">
   <head>
      <meta charset="utf-8">
      <meta name= "viewport" content="width=device-width, height=device-height">
      <title>Certificates</title>
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
   </head>
   <body>
     <header>
      <nav>
         <div class="logo">
             <h2>Certificate</h2>
         </div>
         <ul class="nav-links">
           <li><a href = "index.php">Home</a></li>
           <li><a href = "#">Certificates</a></li>
           <li><a href = "#">About us</a></li>
           <li><a href = "#">Support</a></li>
           <li class="nav-links-mobile">
              <a href = "login.php">Login</a>
              <a href = "signup.php">Signup</a>
           </li>
         </ul>
         <div class = "header-login">
           <?php
               if(isset($_SESSION['userId'])){
                  ?>
                  <form action="includes/logout.inc.php" method="post">
                     <button type="submit" name="logout-submit">Logout</button>
                  </form>
                  <?php
               }
               else{
                  ?>
                  <form class = "non-essential-mobile" action="includes/login.inc.php" method="post">
                     <input class="optional-input" type="text" name="mail" placeholder="e-mail..">
                     <input class="optional-input" type="password" name="pwd" placeholder="Password...">
                     <button type="submit" name="login-submit">Login</button>
                  </form>
                  <a class="non-essential-mobile" href="signup.php">Signup</a>
                  <?php
               }
           ?>
         </div>
         <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
         </div>
      </nav>
     </header>
     <script src = "app.js"></script>
   </body>
</html>
