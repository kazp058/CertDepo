<?php
    require "header.php";
?>
    <main>
       <div class="wrapper-main">
          <section class="section-default">
            <?php
               $name = $_GET["name"];
               $issuer = $_GET["issuer"];
               $token = $_GET["token"];

               if(empty($name) || empty($issuer) || empty($token)){
                  echo "<p>Could not validate your request!</p>";
               }
               else{
                ?>
                  <h1><?php echo str_replace("_"," ",$name); ?></h1>
                  <h3>By <?php echo str_replace("_"," ",$issuer); ?></h3>
                  <hr>
                  <form action="includes/survey.inc.php" method="post">
                     <label>First Name
                        <input type="text" name="fname">
                     </label>
                     <label>Second Name
                        <input type="text" name="sname">
                     </label>
                     <label>First Last Name
                        <input type="text" name="flname">
                     </label>
                     <label>Second Last Name
                        <input type="text" name="slname">
                     </label>
                     <label>Email
                        <input type="text" name="email">
                     </label>
                     <button class="highlight-button" type="submit" name="survey-submit">Send information</button>
                  </form>
                <?php
               }
            ?>
          </section>
       </div>
    </main>
<?php
    require "footer.php";
?>
