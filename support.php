<?php
require 'header.php';
?>

<main>
   <div class="wrapper-main">
      <section class="section-default">
         <?php
         if (isset($_GET['success'])) {
            $_SESSION['isCompany'] = 1;
         }
         if (isset($_SESSION['userId'])) {
         ?>
            <div class="company-form">
               <form action="includes/change-status.php" method="post">
                  <input type="hidden" value="<?php echo $_SESSION['userId']; ?>" name="id">
                  <button type="submit" name="change-submit">
                     <i class="material-icons md-18">verified</i> Company Status
                  </button>
                  <p>When you request the company status you will not be able to recept certificates, and you will only be able to emit.</p>
               </form>
            </div>
         <?php
         } else {
         ?>
            <div>
               <a href="login.php">
                  <p>Request Company Status</p>
               </a>
               <p>When you request the company status you will not be able to recept certificates, and you will only be able to emit.</p>
               <p>Log in to request your company status.</p>
            </div>
         <?php
         }
         ?>
         <div>
            <h2>FAQ</h2>
            <hr>
            <div class="grid-vertical">
               <div class="grid-e">
                  <div class="content">
                     <h3>How do we verify the issuers data?</h3>
                     <p>Everyone can issue certificates, just press the button and start your experience, remember that once you get the company status you will not be able to see or claim certficates.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>How to pay for the emission of certificates?</h3>
                     <p>We accept all debit cards and payment options in <strong>PayPal</strong>, so that the payment process is smooth as possible.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>How to become a company?</h3>
                     <p>Click in the option "request company status" and a member of the support team will contact you.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>Who can see my data?</h3>
                     <p>No one can see your data, we have a strong encryption and data protection, obviously the certificates that you share are for easy access. But we dont keep track of payment information nierther contact information.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>I can see the payment made in my account status but the page shows me an error</h3>
                     <p>We have integrated Paypal's API and we verify transcations in every request, but we will be glad to help you please go to <a>Contact Us</a> and specify your situation.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>I want to change my information</h3>
                     <p>We currently dont have that feature but soon we will.</p>
                  </div>
               </div>
            </div>
      </section>
   </div>
</main>

<?php
require 'footer.php';
?>