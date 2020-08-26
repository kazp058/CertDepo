<?php
session_start();
?>
<html Lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
   <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Optimal Internet Explorer compatibility -->
   <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
   <title>Certificates</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700;900&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <link rel="stylesheet" href="styles.css">
</head>
<div class="page-container">

   <body>
      <header>
         <nav>
            <div class="logo">
               <p>cert<strong>depo</strong></p>
            </div>
            <ul class="nav-links">
               <li><a href="index.php">Home</a></li>
               <li><a href="certificates.php">Certificates</a></li>
               <li><a href="pricing.php">Pricing</a></li>
               <li><a href="support.php">Support</a></li>
               <li class="nav-links-mobile">
                  <?php
                  if (isset($_SESSION['userId'])) {
                  ?>
                     <div class="logout-form">
                        <form action="includes/logout.inc.php" method="post">
                           <button type="submit" name="logout-submit">
                              <i class="material-icons md-18">input</i>
                              Logout
                           </button>
                        </form>
                     </div>
                  <?php
                  } else {
                  ?>
                     <a href="login.php">Login</a>
                     <a href="signup.php">Sign Up</a>
                  <?php
                  }
                  ?>
               </li>
            </ul>
            <div class="header-login">
               <?php
               if (isset($_SESSION['userId'])) {
               ?>
                  <div class="logout-form">
                     <form action="includes/logout.inc.php" method="post">
                        <button type="submit" name="logout-submit"><i class="material-icons md-18">input</i>
                           Logout
                        </button>
                     </form>
                  </div>
               <?php
               } else {
               ?>
                  <div class="non-essential-mobile">
                     <a href="login.php">Login</a>
                     <a class="highlight-link-onblack" href="signup.php">Sign Up</a>
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
      <script src="app.js"></script>

</html>