<?php
  require "header.php";
?>
   <main>
     <div class="wrapper-main">
       <section class="section-default">
          <h1>Reset your password</h1>
          <p>An e-mail will be send to you with instructions on how to reset your password.</p>
          <div class='messages'>
          <?php
             if(isset($_GET["reset"]))
             {
               if($_GET["reset"] == "success")
               {
                 echo '<p class="success">Link have been sended to your email!</p>';
               }
             }else if(isset($_GET["error"])){
               if($_GET["error"] == "invalidemail"){
                 echo '<p class="error">Invalid email</p>';
               }
             }
          ?>
          </div>
          <form action="includes/reset-request.inc.php" method="post">
             <input type="text" name="email" placeholder="Enter your e-mail address...">
             <button class="highlight-button" type="submit" name="reset-request-submit">Recover account</button>
          </form>
       </section>
     </div>
   </main>

<?php
  require "footer.php";
?>
