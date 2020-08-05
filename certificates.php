<?php
   require 'header.php';
?>

  <main>
     <div class="wrapper-main">
	<section class = "section-default">
	   <h1>Search certificates</h1>
	   <hr>

	   <form action="includes/search.inc.php" method="post">
	       <p>Key</p>
	       <input type = "text" name="key">
               <button class="highlight-button" type="submit" name="search-submit">Search</button>
	   </form>

	</section>

        <section class="section-default">
        <?php
        if(isset($_GET['token'])){
          $command = escapeshellcmd('includes/scripts/generateCert.py');
          shell_exec($command);
          ?>

          <img src="includes/Test_.jpg" alt="Test">
          <?php

          if(isset($_GET['claimed'])){
            if(isset($_SESSION['userId'])){
          ?>
              <form class="code-form" action="includes/claim.inc.php" method="post">
                <div class="text">
                   <input type="text" maxlength="6">
                </div>
                <div class="button-wrapper">
                   <button class="highlight-button">Claim Certificate</button>
                </div>
              </form>
          <?php
            }else{
          ?>
            <form action="login.php" method="put">
                <button class="highlight-button">Claim Certificate</button>
            </form>
          <?php
            }
          }
        }
        ?>
        </section>

        <section class="section-table">
            <?php
                if(isset($_SESSION['userId'])){
                    ?>
                       <h1>My certificates</h1>
                       <hr style="height:2px;border-width:0;color:#153b6e;background-color:#153b6e;">
                       <?php
                       if(true){
                          ?>
                           <section class="section-default">
                             <p>You dont have any certificates yet!</p>
                             <br>
			     <?php
                                 if($_SESSION['isCompany']){
                             ?>
                             <a class="highlight-link" href="create-certificate.php">Create new certificate</a>
                           </section>
                           <?php
			  }
                       }
		    }
                       ?>
         </section>
     </div>
  </main>

<?php
   require 'footer.php';
?>
