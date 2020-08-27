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
                     <h1>Informacion general</h1>
                     <div class="subsplitter">
                        <hr>
                     </div>
                  </div>
                  <div class="form-section">
                     <div class="field">
                        <p>Tema del certificado</p>
                        <div class="input-field">
                           <input type="text" name="certname">
                        </div>
                     </div>
                     <div class="field">
                        <p>Tipo de certificado</p>
                        <div class="select-field">
                           <select id="certificatetype" name="type" onchange="change(this,1);">
                              <option selected disabled>Elige</option>
                              <option value="assistance" hidden>Assistance</option>
                              <option value="approval">Cursos</option>
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="title-left">
                     <h1>Informacion del emisor</h1>
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
                           <p class="checkmark-label">Llenar con tus datos</p>
                        </div>
                     </div>
                     <div class="field">
                        <p>Nombre legal del emisor</p>
                        <div class="input-field">
                           <input id="username" type="text" name="certissuer">
                        </div>
                     </div>
                     <div class="field">
                        <p>Correo de soporte</p>
                        <div class="input-field">
                           <input id="email" type="text" name="emailissuer">
                        </div>
                     </div>
                  </div>

                  <div class="title-left">
                     <h1>Sube tu informacion</h1>
                     <div class="subsplitter">
                        <hr>
                     </div>
                  </div>
                  <div class="form-section">
                     <div class="field">
                        <p>Elige la configuracion principal que usaras</p>
                        <div class="select-field">
                           <select id="gathertype" name="gather" onchange="change(this,0);">
                              <option selected disabled>Choose here</option>
                              <option value="survey">Encuesta</option>
                              <option value="test" hidden>Test</option>
                              <option value="upload" hidden>Upload data</option>
                              <option value="survey-test" hidden>Survey and Test</option>
                           </select>
                        </div>
                     </div>
                     <div class="optionalfield" id="upload-file" hidden>
                        <label>Elige la configuracion</label><br>
                        <input class="inputfile" id="file" type="file" name="data" accept=".csv, .xlsx">
                        <label for="file">Choose a file</label>
                     </div>
                     <div class="field">
                        <p>Certificados a emitir:</p>
                        <input type='number' name='assignedcert' min="1" max="100" readOnly = true value="50">
                     </div>
                  </div>


                  <div class="form-section" id="date-selector-survey">

                  </div>

                  <div class="buttons">
                     <button type="submit" name="certificate-submit">Crear</button>
                  </div>
                  <br>

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