<?php
   require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <h1>Login</h1>
      <?php
        if(isset($_SESSION["userId"])){
          echo '<form action="includes/logout.inc.php" method="post"><button type="submit" name="logout-submit">Logout</button></form>';
        }else{
          echo '<form action="includes/login.inc.php" method="post"><input type="text" name="uid" placeholder="Username.."><input type="password" name="pwd" placeholder="Password..."><button type="submit" name="login-submit">Login</button></form><div class="register-message"><p>No account?</p><a href="signup.php">Signup</a></div>';
        }
      ?>
    </section>
  </div>
</main>

<?php
  require "footer.php";
?>
