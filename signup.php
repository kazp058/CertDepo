<?php
require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <h1>Signup</h1>
      <div class="messages">
        <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "emptyfields") {
            echo '<p class="error">Fill in all fields!</p>';
          }
          if ($_GET['error'] == "invalidmailuid") {
            echo '<p class="error">Mail and username not valid!</p>';
          } else if ($_GET['error'] == "invalidmail") {
            echo '<p class="error">Invalid mail! Make sure to be using a valid email: example@address.com </p>';
          } else if ($_GET['error'] == "invaliduid") {
            echo '<p class="error">Invalid username, please use only letters and numbers</p>';
          } else if ($_GET['error'] == "passwordcheck") {
            echo '<p class="error">Make sure to use the same password in both password and password repeat</p>';
          } else if ($_GET['error'] == "sqlerror") {
            echo '<p class="error">There was an error please retry later</p>';
          } else if ($_GET['error'] == "usertaken") {
            echo '<p class="error">That username has been taken, please try other options</p>';
          }
        } else if (isset($_GET['signup'])) {
          if ($_GET['signup'] == "success") {
            echo '<p class="success">Your account has been created successfully</p>';
          }
        }
        ?>
      </div>
      <form class="form-signup" action="includes/signup.inc.php" method="post">
        <p>Name</p>
        <input type="text" name="uid">
        <p>Email</p>
        <input type="text" name="mail">
        <p>Password</p>
        <input type="password" name="pwd">
        <p>Repeat your password</p>
        <input type="password" name="pwd-repeat">
        <br></br>
        <button class="highlight-button" type="submit" name="signup-submit">Signup</button>
      </form>
    </section>
  </div>
</main>

<?php
require "footer.php"
?>