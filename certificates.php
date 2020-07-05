<?php
   require 'header.php';
?>

  <main>
     <div class="wrapper-main">
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
                             <a class="highlight-link" href="create-certificate.php">Create new certificate</a>
                           </section>
                           <?php
                       }
                       ?>

                    <?php
                }else{
                    ?>
                       <p>You need to be logged in to use this functions!</p>
                    <?php
                }
            ?>
         </section>
     </div>
  </main>

<?php
   require 'footer.php';
?>
