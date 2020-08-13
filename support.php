<?php
require 'header.php';
?>

<main>
   <div class="wrapper-main">
      <section class="section-default">
         <?php
         if (isset($_SESSION['userId'])) {
         ?>
            <div>
               <form action="includes/change-status.php" method="post">
                  <input type="hidden" value="<?php echo $_SESSION['userId'];?>" name="id">
                  <button type="submit" name="change-submit">
                     <p>Request Company Status</p>
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
            <ul>
               <li>
                  <p>How do we verify the issuers data?</p>
                  <p>We interview with a representative of the company, to allow the emission of certificates, a code of conduct is signed and if all the legal conditions are met the status of company is granted to an specific account.</p>
               </li>
               <li>
                  <p>How to pay for the emission of certificates?</p>
                  <p>We accept all debit cards and payment platforms, so that the payment process is smooth as possible.</p>
               </li>
               <li>
                  <p>How to become a company?</p>
                  <p>Click in the option "request company status" and a member of the support team will contact you.</p>
               </li>
            </ul>
         </div>
      </section>
   </div>
</main>

<?php
require 'footer.php';
?>