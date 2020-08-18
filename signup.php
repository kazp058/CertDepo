<?php
require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="section-form">

      <div class="form-container">

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

        <div class="title-left">
          <h1>Signup</h1>
        </div>
        <div class="subsplitter">
          <hr>
        </div>
        <div class="normal-form">
          <form class="form-signup" action="includes/signup.inc.php" method="post">
            <div class="field">
              <p>Legal Name or Company Name</p>
              <div class="input-field">
                <i class="material-icons md-36">account_circle</i>
                <input type="text" name="uid">
              </div>
            </div>
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
            </div>
            <div class="field">
              <p>Repeat your password</p>
              <div class="input-field">
                <i class="material-icons md-36">vpn_key</i>
                <input type="password" name="pwd-repeat">
              </div>
            </div>
            <div class="field">
              <div class="check-field">
                <label class="container">
                  <input type="checkbox" name="accept" value="accept">
                  <span class="checkmark"></span> 
                </label>
                <p>I accept the <a>Terms Of Service</a> and the <a>Privacy Policy</a>.</p>
              </div>
            </div>
            <div class="buttons">
              <button type="submit" name="signup-submit">Sign Up</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>

<?php
require "footer.php"
?>