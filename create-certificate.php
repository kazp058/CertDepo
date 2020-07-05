<?php
  require 'header.php';
?>
<main>
 <div class="wrapper-main">
  <section class="section-default">

    <script>
       function change(selection){
          if(selection){

             document.getElementById("survey").style.display = "none";
             document.getElementById("test").style.display = "none";
             document.getElementById("upload").style.display = "none";
             document.getElementById("survey-test").style.display = "none";
             document.getElementById("upload-file").style.display = "none";

             if(selection.value == "survey"){
                document.getElementById("survey").style.display = "inline-block";
             }else if(selection.value == "test"){
                document.getElementById("test").style.display = "inline-block";
             }else if(selection.value == "upload"){
                document.getElementById("upload").style.display = "inline-block";
                document.getElementById("upload-file").style.display = "inline-block";
             }else if(selection.value == "survey-test"){
                document.getElementById("survey-test").style.display = "inline-block";
             }
          }
       }
    </script>


    <form class="form-certificate" action="includes/logout.inc.php" method="post">
       <div class="form-section">
         <label>Subject for the certificate</label>
            <input type="text" name="certname">
       </div>

       <h3>Issuer Information</h3><hr>

       <div class="form-section">
         <label class="checkmark-label">Fill with account information
            <input class="checkmark" type="checkbox" id="useUser" onclick="">
         </label><br>
         <label>Certificate issuer
            <input type="text" name="certissuer">
         </label>
         <label>Issuer email
            <input type="text" name="emailissuer">
         </label>
       </div>

       <h3>Upload the data</h3><hr>
       <p>Now we need to now where are we sending the certificates</p>

       <div class="form-section">
          <label>Select the type of data gathering you want to use</label>
          <select id="gathertype" name="gather" onchange="change(this);">
            <option selected disabled>Choose here</option>
            <option value="survey">Survey</option>
            <option value="test">Test</option>
            <option value="upload">Upload data</option>
            <option value="survey-test">Survey and Test</option>
          </select>
          <div class="message">
            <p class="information" id="survey">A survey link will be granted, when you send the link, people will be asked to fill vital information to fill the certificates and then send them</label>
            <p class="information" id="test">A test link will be sent granted, when you send the link, people will be asked optional answers questions and based of the grade a certificate will be granted</label>
            <p class= "information" id="upload">A upload field will be enabled for you, use a csv or excel file where the two first columns are, the name and the mail, in that order</label>
            <p class="information" id="survey-test">A survey link will be granted, when you send the link people will be asked to fill their name and mail, later when you enable the test and email with a test will be sent for them to complete</label>
          </div>
          <div class="optionalfield" id="upload-file">
            <label>Upload file
               <input type="file" name="data" accept=".csv, .xlsx">
            </label>
          </div>
       </div>
       <button class="main-button" type="submit" name="certificate-submit">Create certificate</button>
    </form>
  </section>
 </div>
</main>
<?php
  require 'footer.php';
?>
