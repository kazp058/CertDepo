<?php
   require "header.php";
?>

   <main>
      <div class="wrapper-main">
          <section class="section-default">
             <h1>Signup</h1>
             <?php
               if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfields"){
                  echo '<p class="signuperror">Fill in all fields!</p>';
                }
                if($_GET['error'] == "invalidmailuid"){
                  echo '<p class="signuperror">Mail and username not valid!</p>';
                }
                else if($_GET['error'] == "invalidmail"){
                  echo '<p class="signuperror">Invalid mail! Make sure to be using a valid email: example@address.com </p>'; 
                }
                else if($_GET['error'] == "invaliduid"){
                  echo '<p class="signuperror">Invalid username, please use only letters and numbers</p>';
                }
                else if($_GET['error'] == "passwordcheck"){
                  echo '<p class="signuperror">Make sure to use the same password in both password and password repeat</p>';
                }
                else if($_GET['error'] == "sqlerror"){
                  echo '<p class="signuperror">There was an error please retry later</p>';
                }
                else if($_GET['error'] == "usertaken"){
                  echo '<p class="signuperror">That username has been taken, please try other options</p>';
                }
               }
               else if(isset($_GET['signup'])){
                  if($_GET['signup'] == "success"){
                    echo '<p class="signupsuccess">Your account has been created successfully</p>';
                  }
               }
             ?>
             <form class="form-signup" action="includes/signup.inc.php" method="post">
                <input type="text" name="uid" placeholder="Name">
                <input type="text" name="mail" placeholder="Email">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat password">
                <button type="submit" name="signup-submit">Signup</button>
             </form>
          </section>
      </div>
   </main>

<?php
    require "footer.php"
?>
