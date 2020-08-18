<?php
require "header.php";
?>
<main>
   <div class="wrapper-main">
      <section class="section-form">
         <div class="form-container">
            <?php
            $id = $_GET["id"];
            require 'includes/dbh.inc.php';
            $sql = "SELECT * FROM certscompany WHERE certId=?;";
            $stmt = mysqli_stmt_init($conn_certs);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
               header("Location: survey.php?id=" . $id . "&error=sql");
               exit();
            } else {
               mysqli_stmt_bind_param($stmt, "s", $id);
               mysqli_stmt_execute($stmt);
               $result = mysqli_stmt_get_result($stmt);

               if ($row = mysqli_fetch_assoc($result)) {
                  $title = $row['titleCerts'];
                  $name = $row['issuerName'];
                  $supportmail = $row['emailCert'];
               } else {
                  header("Location: survey.php?id=" . $id . "&error=nocertificate");
                  exit();
               }
            }

            if (empty($id)) {
               echo "<p>Could not validate your request!</p>";
            } else {
            ?><div class="normal-form">
                  <form action="includes/certificate-create.inc.php" method="post">
                     <div class="title-left">
                        <h1><?php echo $title; ?></h1>
                        <div class="subsplitter">
                           <hr>
                        </div>
                        <h3>By <?php echo $name; ?></h3>
                        <h3>For support or information, contact: <?php echo $supportmail; ?></h3>
                     </div>

                     <div>
                        <div class="field">
                           <p>First Name</p>
                           <div class="input-field">
                              <input type="text" name="fname">
                           </div>
                        </div>
                        <div class="field">
                           <p>Second Name</p>
                           <div class="input-field">
                              <input type="text" name="sname">
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="field">
                           <p>First Last Name</p>
                           <div class="input-field">
                              <input type="text" name="flname">
                           </div>
                        </div>
                        <div class="field">
                           <p>Second Last Name</p>
                           <div class="input-field">
                              <input type="text" name="slname">
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="field">
                           <p>Email</p>
                           <div class="input-field">
                              <input type="text" name="email">
                           </div>
                        </div>
                     </div>
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <div class="buttons">
                        <button class="highlight-button" type="submit" name="survey-submit">Send information</button>
                     </div>
                  </form>
               </div>
            <?php
            }
            ?>
         </div>
      </section>
   </div>
</main>
<?php
require "footer.php";
?>