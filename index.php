<?php
require "header.php";
?>

<main>
   <div class="wrapper-main">
      <section class="section-index">
         <?php
         if (isset($_SESSION["userId"])) {
         ?>
            <div class="info">
               <h3>Welcome back!</h3>
               <p>Start claiming or issuing certificates. Remember that claiming certificates its free, and issuing them is easy. Start Now!</p>
            </div>
         <?php
         } else {
         ?>
            <div class="info">
               <h3>Enjoy more features by creating an account</h3>
               <p>Yes, you will receive the certificates either way, but if you want to keep easy track of them and been able to claim them so that they are linked to your account, and all of this is free!</p><p> So make an <a href="signup.php">account now</a> or <a href="login.php">log in</a> to enjoy all features. If you want to make a company account <a href="support.php">click here</a>.</p>
            </div>
         <?php
         }
         ?>
         <div class="subsplitter">
            <hr>
         </div>
         <div class="grid-vertical">
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">grading</i></div>
               <div class="content">
                  <h3>What do we do?</h3>
                  <p>We store your certificates, so that companies and academies can issue them and everyone can verify them with the special unique tokens for every certificate. There is no need to download and install any software.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">qr_code_scanner</i></div>
               <div class="content">
                  <h3>QR Code in our Certificates</h3>
                  <p>Every certificate contains a unique special token, and it comes with a special qr code, that helps you share and verify your certificate anywhere and anytime. Also it makes it easy to put in your documents.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">cloud</i></div>
               <div class="content">
                  <h3>Cloud Backup</h3>
                  <p>All the certificates that we generate are backup in the cloud, so that no matter what your information is safe and secure, so you can access it.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">enhanced_encryption</i></div>
               <div class="content">
                  <h3>Data Encryption</h3>
                  <p>Worried about your vital information? We encrypt your data, and keep it secure in well protected servers that can be taht no one can access. We earn money by selling access to the Certificates generation platform, not by selling your data. Read more about that in our <a href="#">privacy policy</a>.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">architecture</i></div>
               <div class="content">
                  <h3>Constant Imporvements</h3>
                  <p>We just started and we are keeping this platform, expect important improvements and upgrades to our services, if you have recommendations we are glad to <a href="#">read them</a>.</p>
               </div>
            </div>            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">share</i></div>
               <div class="content">
                  <h3>Easy Sharing</h3>
                  <p>QR Codes and generated urls makes it easy to share your achievements with the world. All the data is verified and kept secure in our servers.</p>
               </div>
            </div>
         </div>
      </section>
   </div>
</main>

<?php
require "footer.php";
?>