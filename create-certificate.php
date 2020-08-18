<?php
require 'header.php';
?>
<main>
   <div class="wrapper-main">
      <section class="section-default">

         <script>
            function change(selection, num) {
               if (selection && num == "0") {

                  document.getElementById("survey").style.display = "none";
                  document.getElementById("test").style.display = "none";
                  document.getElementById("upload").style.display = "none";
                  document.getElementById("survey-test").style.display = "none";
                  document.getElementById("upload-file").style.display = "none";
                  document.getElementById("date-selector").style.display = "none";

                  if (selection.value == "survey") {
                     document.getElementById("survey").style.display = "inline-block";
                     document.getElementById("date-selector").style.display = "inline-block";
                  } else if (selection.value == "test") {
                     document.getElementById("test").style.display = "inline-block";
                     document.getElementById("date-selector").style.display = "inline-block";
                  } else if (selection.value == "upload") {
                     document.getElementById("upload").style.display = "inline-block";
                     document.getElementById("upload-file").style.display = "inline-block";
                  } else if (selection.value == "survey-test") {
                     document.getElementById("survey-test").style.display = "inline-block";
                     document.getElementById("date-selector").style.display = "inline-block";
                  }
               } else if (selection && num == "1") {
                  document.getElementById("assistance").style.display = "none";
                  document.getElementById("approval").style.display = "none";

                  if (selection.value == "assistance") {
                     document.getElementById("assistance").style.display = "inline-block";
                  } else if (selection.value == "approval") {
                     document.getElementById("approval").style.display = "inline-block";
                  }
               }
            }
         </script>
         <script>
            function addData(checkbox) {
               if (checkbox.checked) {
                  document.getElementById("username").value = "<?php echo $_SESSION['userUid'] ?>";
                  document.getElementById("email").value = "<?php echo $_SESSION['userMail'] ?>";

                  document.getElementById("username").readOnly=true;
                  document.getElementById("email").readOnly=true;

               } else {
                  document.getElementById("username").value = " ";
                  document.getElementById("email").value = " ";

                  document.getElementById("username").readOnly=false;
                  document.getElementById("email").readOnly=false;

               }
            }
         </script>

         <form class="form-certificate" action="includes/certificates-request.inc.php" method="post">

            <h3>Certificate Information</h3>
            <hr>

            <div class="form-section">
               <label>Subject of the certificate
                  <input type="text" name="certname">
               </label>
               <label>Type of certificate
                  <select id="certificatetype" name="type" onchange="change(this,1);">
                     <option selected disabled>Choose here</option>
                     <option value="assistance" hidden>Assistance</option>
                     <option value="approval">Approval</option>
                  </select>
               </label>
               <div class="message">
                  <p class="information" id="assistance">Assistance certificates can't have online verification</p>
                  <p class="information" id="approval">Approval certificates will have online verification (special token will be generated for each certificate)</p>
               </div>
            </div>

            <h3>Issuer Information</h3>
            <hr>

            <div class="form-section">
               <label class="checkmark-label">Fill with account information
                  <input class="checkmark" type="checkbox" id="useUser" onclick="addData(this);">
               </label><br>
               <label>Certificate issuer
                  <input id="username" type="text" name="certissuer">
               </label><br class="optional-space">
               <label>Issuer email
                  <input id="email" type="text" name="emailissuer">
               </label>
            </div>

            <h3>Upload the data</h3>
            <hr>
            <p>Now we need to now where are we sending the certificates</p>

            <div class="form-section">
               <label>Select the type of data gathering you want to use
                  <select id="gathertype" name="gather" onchange="change(this,0);">
                     <option selected disabled>Choose here</option>
                     <option value="survey">Survey</option>
                     <option value="test" hidden>Test</option>
                     <option value="upload" hidden>Upload data</option>
                     <option value="survey-test" hidden>Survey and Test</option>
                  </select>
               </label>
               <div class="message">
                  <p class="information" id="survey" hidden>A survey link will be granted, when you send the link, people will be asked to fill vital information to fill the certificates and then send them</p>
                  <p class="information" id="test" hidden>A test link will be sent granted, when you send the link, people will be asked optional answers questions and based of the grade a certificate will be granted</p>
                  <p class="information" id="upload" hidden>A upload field will be enabled for you, use a csv or excel file where the two first columns are, the name and the mail, in that order</p>
                  <p class="information" id="survey-test" hidden>A survey link will be granted, when you send the link people will be asked to fill their name and mail, later when you enable the test and email with a test will be sent for them to complete</p>
               </div>
               <div class="optionalfield" id="upload-file" hidden>
                  <label>Upload file with the data for the certificates</label><br>
                  <input class="inputfile" id="file" type="file" name="data" accept=".csv, .xlsx">
                  <label for="file">Choose a file</label>
               </div>
            </div>


            <div class="form-section" id="date-selector-survey">
               <div class="optionalfield" id="date-selector">
                  <h3>Survey</h3>
                  <label>Number of certificates to be emitted:</label>
                  <?php
                  require 'includes/dbh.inc.php';

                  $sql = "SELECT * FROM users WHERE idUsers=?;";
                  $stmt = mysqli_stmt_init($conn);

                  if (!mysqli_stmt_prepare($stmt, $sql)) {
                     header("Location: ../certificates.php?error=sqlerror");
                     exit();
                  } else {
                     mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
                     mysqli_stmt_execute($stmt);
                     $result = mysqli_stmt_get_result($stmt);
                     if ($row = mysqli_fetch_assoc($result)) {

                        if ($row['certificatesAv'] == 0) {
                           echo "<p>You dont have space available, buy space</p>";
                           echo '<a href="pricing.php">Buy Certificates</a>';
                        } else {
                  ?>
                           <input type='number' name='assignedcert' min="1" max="<?php echo $row['certificatesAv']; ?>">
                           <label>|<?php echo $row['certificatesAv']; ?>
                     <?php
                        }
                     } else {
                        header("Location: ../login.php?error=nouser");
                        exit();
                     }
                  }
                     ?>
               </div>
            </div>
            <button class="highlight-button" type="submit" name="certificate-submit">Create certificate</button>
            <a href="pricing.php">Buy Certificates</a>
            <input type="hidden" name="uid" value="<?php echo $_SESSION['userId']; ?>">
         </form>
      </section>
   </div>
</main>
<?php
require 'footer.php';
?>