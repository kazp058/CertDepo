<?php
require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <h1>Login</h1>
      <div class="messages">
        <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "emptyfields") {
            echo '<p class="error">Please fill all the fields!</p>';
          } else if ($_GET["error"] == "sqlerror") {
            echo '<p class="error">There was an error please retry later</p>';
          } else if ($_GET["error"] == "wrongpwd") {
            echo '<p class="error">Password and email does not match</p>';
          } else if ($_GET["error"] == "nouser") {
            echo '<p class="error">No account not found, please register if you are a new user</p>';
          }
        } else if (isset($_GET["login"])) {
          if ($_GET["login"] == "success") {
            echo '<p class="success">Welcome ' . $_SESSION["userUid"] . '! Ready to start?</p>';
          }
        } else if (isset($_GET["newpwd"])) {
          if ($_GET["newpwd"] == "passwordupdated") {
            echo '<p class="success">Your password has been reset!</p>';
          }
        }
        ?>
      </div>
      <?php
      if (isset($_SESSION["userId"])) {
      ?>
        <form action="includes/logout.inc.php" method="post">
          <button class="highlight-link" type="submit" name="logout-submit">Logout</button>
        </form>
      <?php
      } else {
      ?>
        <form action="includes/login.inc.php" method="post">
          <p>Email</p>
          <input type="text" name="mail">
          <p>Password</p>
          <input type="password" name="pwd">
          <p><a class="options-horizontal" href="reset-password.php">Forgot your password?</a></p><br>
          <button class="highlight-button" type="submit" name="login-submit">Login</button>
        </form>
        <div class="options-horizontal">
          <br>
          <ul>
            <li class="option-horizontal">
              <p>No account?</p><a class="highlight-link" href="signup.php">Signup here</a>
            </li>
          </ul>
        </div>
      <?php
      }
      ?>
    </section>
  </div>
</main>

<?php
require "footer.php";
?>