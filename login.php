<?php
require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="message-container">
      <?php require "messages.php"; ?>
    </section>
    <section class="section-form">
      <div class="form-container">
        <div class="title-left">
          <h1>Login</h1>
        </div>

        <div class="subsplitter">
          <hr>
        </div>
        <?php
        if (isset($_SESSION["userId"])) {
        ?>
          <div class="spacer"></div>
          <div class="normal-form">
            <form action="includes/logout.inc.php" method="post">
              <div class="buttons">
                <button type="submit" name="logout-submit">Logout</button>
              </div>
            </form>
          </div>
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