<div class="message">
   <?php
   if (isset($_GET["error"])) {
      echo '<div class="error"> <h3>Error!</h3>';
      $errormsg = $_GET["error"];
      if ($errormsg == "sql") {
         echo '<p>There was an error, please retry it later!</p>';
      } else if ($errormsg == "nouser") {
         echo '<p>We couldnt find your account, please log in or create an account</p>';
      } else if ($errormsg == "usertaken") {
         echo '<p>That email has already been taken please use other email</p>';
      } else if ($errormsg == "emptyfields") {
         echo '<p>Please fill in all the fields</p>';
      } else if ($errormsg == "invalidmailuid") {
         echo '<p>The name and the email inserted are not valid!</p>';
      } else if ($errormsg == "invalidmail") {
         echo '<p>The email inserted is not valid!</p>';
      } else if ($errormsg == "invaliduid") {
         echo '<p>The name inserted is not valid, please only use letters and spaces</p>';
      } else if ($errormsg == "passwordcheck") {
         echo '<p>The password and the confirmation password do not are the same</p>';
      } else if ($errormsg == "nocert") {
         echo '<p>We could not find the certificate, please check the token</p>';
      } else if ($errormsg == "nospace") {
         echo '<p>There is no more space available, please buy more certificatess</p>';
      } else if ($errormsg == "code") {
         echo '<p>The claiming code is not the correct one, please check the claiming code</p>';
      } else if ($errormsg == "wrongpwd") {
         echo '<p>The password and the email does not coincide, please check it and retry it</p>';
      } else if ($errormsg == "nouser") {
         echo '<p>There is no account linked to that email, please create and account or try to use other email</p>';
      } else if ($errormsg == "noitem") {
         echo '<p>There was an error and no certificates where processed, please retry it later or contact support</p>';
      } else if ($errormsg == "notransaction") {
         echo '<p>There was an error and the transaction was cancelled, please retry it later or contact support</p>';
      } else if ($errormsg == "serviceinvalid") {
         echo '<p>Currently our services are not working, please contact support via Twitter or Direct Email, or retry it later</p>';
      }
      echo '</div>';
   } else if (isset($_GET["success"])) {
      echo '<div class="success"> <h3>Success!</h3>';
      $msg = $_GET['success'];
      if ($msg == "addup") {
         echo '<p>More certificates were assigned!</p>';
      } else if ($msg == "cert") {
         echo '<p>Your data has been sent to the issuer, expect an email with the link to your certificate an a claiming code</p>';
      } else if ($msg == "created") {
         echo '<p>Your certificate project has been created</p>';
      } else if ($msg == "change") {
         echo '<p>Your account has a company status and now you can issue certificates</p>';
      } else if ($msg == "payment") {
         echo '<p>You have successfully buyed more certificates!</p>';
      }else if ($msg == "login") {
         echo '<p>Welcome back! :D</p>';
      }
      echo '</div>';
   }
   ?>
</div>