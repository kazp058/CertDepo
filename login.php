<?php
require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="section-form">
      <div class="form-container">
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
        <div class="title-left">
          <h1>Login</h1>
        </div>

        <div class="subsplitter">
          <hr>
        </div>
        <?php
        if (isset($_SESSION["userId"])) {
        ?>
          <form action="includes/logout.inc.php" method="post">
            <button type="submit" name="logout-submit">Logout</button>
          </form>
        <?php
        } else {
        ?>
          <div class="normal-form">
            <form action="includes/login.inc.php" method="post">
              <div class="field">
                <p>Email Address</p>
                <div class="input-field">
                  <i class="material-icons md-36">email</i>
                  <input type="text" name="mail">
                </div>
              </div>
              <div class="field">
                <p>Password</p>
                <div class="input-field">
                  <i class="material-icons md-36">vpn_key</i>
                  <input type="password" name="pwd">

                </div>
                <p class="suboption"><a href="reset-password.php">Forgot your password?</a></p>
              </div>
              <div class="buttons">
                <button type="submit" name="login-submit">Login</button>
              </div>
            </form>
          </div>
          <div class="option-horizontal">
            <p>No account?</p>
            <p><a href="signup.php">Signup here</a></p>
          </div>
        <?php
        }
        ?>
      </div>
    </section>
  </div>
</main>

<?php
require "footer.php";
?>