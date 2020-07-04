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
           <?php
               if(isset($_SESSION['userId'])){
           ?>
                 <a href = "login.php">Login</a>
                 <a href = "signup.php">Signup</a>
              <form action="includes/logout.inc.php" method="post">
                 <button class="highloght-link-onblack" type="submit" name="logout-submit">Logout</button>
              </form>

           <?php
               }
               else{
           ?>
                 <a href = "login.php">Login</a>
                 <a href = "signup.php">Signup</a>
           <?php
               }
           ?>
           </li>
         </ul>
         <div class = "header-login">
           <?php
               if(isset($_SESSION['userId'])){
                  ?>
                  <form action="includes/logout.inc.php" method="post">
                     <button class="highlight-link-onblack" type="submit" name="logout-submit">Logout</button>
                  </form>
                  <?php
               }
               else{
                  ?>
                  <div class="non-essential-mobile">
                     <a href="login.php">Login</a>
                     <a class="highlight-link-onblack" href="signup.php">Signup</a>
                  </div>
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
