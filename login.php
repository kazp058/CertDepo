<?php
   require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <h1>Login</h1>
      <?php
        if(isset($_GET["error"])){
          if($_GET["error"] == "emptyfields"){
            echo '<p class="loginerror">Please fill all the fields!</p>';
          }
          else if($_GET["error"] == "sqlerror"){
            echo '<p class="loginerror">There was an error please retry later</p>';
          }
          else if($_GET["error"] == "wrongpwd"){
            echo '<p class="loginerror">Password and username does not match</p>';
          }
          else if($_GET["error"] == "nouser"){
            echo '<p class="loginerror">No username not found, please register if you are a new user</p>';
          }
        }
        else if(isset($_GET["login"])){
          if($_GET["login"] == "success"){
            echo '<p class="loginsuccess">Welcome</p>';
          }
        }
      ?>
      <?php
        if(isset($_SESSION["userId"])){
          echo '<form action="includes/logout.inc.php" method="post"><button type="submit" name="logout-submit">Logout</button></form>';
        }else{
          echo '<form action="includes/login.inc.php" method="post"><input type="text" name="uid" placeholder="Username.."><input type="password" name="pwd" placeholder="Password..."><button type="submit" name="login-submit">Login</button></form><div class="register-message"><p>No account?</p><ul><li><a href="signup.php">Signup</a></li><li><a href="reset-password.php">Forgot your password?</a></li></div>';
        }
      ?>
    </section>
  </div>
</main>

<?php
  require "footer.php";
?>
