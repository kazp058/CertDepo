<?php
require 'header.php';
?>
<main>
   <div class="wrapper-main">
      <section class="message-container">
         <?php require "messages.php"; ?>
      </section>
      <section class="section-form">

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

                  document.getElementById("username").readOnly = true;
                  document.getElementById("email").readOnly = true;

               } else {
                  document.getElementById("username").value = " ";
                  document.getElementById("email").value = " ";

                  document.getElementById("username").readOnly = false;
                  document.getElementById("email").readOnly = false;

               }
            }
         </script>
         <div class="form-container">

            <div class="normal-form">

               <form class="form-certificate" action="includes/certificates-request.inc.php" method="post">
                  <div class="title-left">
                     <h1>Certificate Information</h1>
                     <div class="subsplitter">
                        <hr>
                     </div>
                  </div>
                  <div class="form-section">
                     <div class="field">
                        <p>Subject of the certificate</p>
                        <div class="input-field">
                           <input type="text" name="certname">
                        </div>
                     </div>
                     <div class="field">
                        <p>Type of certificate</p>
                        <div class="select-field">
                           <select id="certificatetype" name="type" onchange="change(this,1);">
                              <option selected disabled>Choose here</option>
                              <option value="assistance" hidden>Assistance</option>
                              <option value="approval">Approval</option>
                           </select>
                        </div>
                     </div>
                     <div class="message">
                        <p class="information" id="assistance">Assistance certificates can't have online verification</p>
                        <p class="information" id="approval">Approval certificates will have online verification (special token will be generated for each certificate)</p>
                     </div>
                  </div>

                  <div class="title-left">
                     <h1>Issuer Information</h1>
                     <div class="subsplitter">
                        <hr>
                     </div>
                  </div>

                  <div class="form-section">
                     <div class="field">
                        <div class="check-field">
                           <label class="container">
                              <input class="checkmark" type="checkbox" id="useUser" onclick="addData(this);">
                              <span class="checkmark"></span>
                           </label>
                           <p class="checkmark-label">Fill with account information</p>
                        </div>
                     </div>
                     <div class="field">
                        <p>Certificate issuer</p>
                        <div class="input-field">
                           <input id="username" type="text" name="certissuer">
                        </div>
                     </div>
                     <div class="field">
                        <p>Issuer email</p>
                        <div class="input-field">
                           <input id="email" type="text" name="emailissuer">
                        </div>
                     </div>
                  </div>

                  <div class="title-left">
                     <h1>Upload the data</h1>
                     <div class="subsplitter">
                        <hr>
                     </div>
                  </div>
                  <div class="form-section">
                     <div class="field">
                        <p>Select the type of data gathering you want to use</p>
                        <div class="select-field">
                           <select id="gathertype" name="gather" onchange="change(this,0);">
                              <option selected disabled>Choose here</option>
                              <option value="survey">Survey</option>
                              <option value="test" hidden>Test</option>
                              <option value="upload" hidden>Upload data</option>
                              <option value="survey-test" hidden>Survey and Test</option>
                           </select>
                        </div>
                     </div>
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
                     <div class="field">
                        <p>Number of certificates to be emitted:</p>

                        <?php
                        require 'includes/dbh.inc.php';

                        $sql = "SELECT * FROM users WHERE idUsers=?;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                           header("Location: ../certificates.php?error=sql");
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


                  <div class="form-section" id="date-selector-survey">

                  </div>

                  <div class="buttons">
                     <button type="submit" name="certificate-submit">Create certificate</button>
                  </div>
                  <br>
                  <div class="buttons">
                     <a href="pricing.php"><button>Buy Certificates</button></a>
                  </div>

                  <input type="hidden" name="uid" value="<?php echo $_SESSION['userId']; ?>">
               </form>
            </div>
         </div>
      </section>
   </div>
</main>
<?php
require 'footer.php';
?>