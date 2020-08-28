<div class="message">
   <?php
   if (isset($_GET["error"])) {
      echo '<div class="error"> <h3>Error!</h3>';
      $errormsg = $_GET["error"];
      if ($errormsg == "sql") {
         echo '<p>Ups! Hubo un error, porfavor intentalo de nuevo.</p>';
      } else if ($errormsg == "nouser") {
         echo '<p>No pudimos encontrar tu cuenta, porfavor crea una o ingresa con una que si exista.</p>';
      } else if ($errormsg == "usertaken") {
         echo '<p>Ese correo electronico ya esta asociado con otro </p>';
      } else if ($errormsg == "emptyfields") {
         echo '<p>Porfavor llena todos los campos.</p>';
      } else if ($errormsg == "invalidmailuid") {
         echo '<p>El nombre y correo ingresado no son validos!</p>';
      } else if ($errormsg == "invalidmail") {
         echo '<p>El correo no es valido!</p>';
      } else if ($errormsg == "invaliduid") {
         echo '<p>El nombre insertado no es valido</p>';
      } else if ($errormsg == "passwordcheck") {
         echo '<p>La contraseña y la contraseña de verificacion no coinciden</p>';
      } else if ($errormsg == "nocert") {
         echo '<p>No pudimos hallar el certificado</p>';
      } else if ($errormsg == "nospace") {
         echo '<p>There is no more space available, please buy more certificatess</p>';
      } else if ($errormsg == "code") {
         echo '<p>El codigo para reclamar no coincide.</p>';
      } else if ($errormsg == "wrongpwd") {
         echo '<p>El correo y la contraseñan no coinciden, porfavor revisa estos datos e intentalo de nuevo.</p>';
      } else if ($errormsg == "nouser") {
         echo '<p>No hay cuenta registrada con este correo, porfavor crea una cuenta o usa otro correo.</p>';
      } else if ($errormsg == "noitem") {
         echo '<p>There was an error and no certificates where processed, please retry it later or contact support</p>';
      } else if ($errormsg == "notransaction") {
         echo '<p>There was an error and the transaction was cancelled, please retry it later or contact support</p>';
      } else if ($errormsg == "serviceinvalid") {
         echo '<p>Currently our services are not working, please contact support via Twitter or Direct Email, or retry it later</p>';
      }
      echo '</div>';
   } else if (isset($_GET["success"])) {
      echo '<div class="success"> <h3>Success!</h3>';
      $msg = $_GET['success'];
      if ($msg == "addup") {
         echo '<p>Se añadieron mas certificados a tu proyecto!</p>';
      } else if ($msg == "cert") {
         echo '<pTus datos fueron enviados, vas a recibir un correo pronto con los datos de tu certificado!</p>';
      } else if ($msg == "created") {
         echo '<p>Tu certificado ha sido creado!</p>';
      } else if ($msg == "change") {
         echo '<p>Se le ha asignado a tu cuenta el estado de compañia.</p>';
      } else if ($msg == "payment") {
         echo '<p>You have successfully buyed more certificates!</p>';
      }else if ($msg == "login") {
         echo '<p>Bienvenido! :D</p>';
      }else if ($msg == "signup") {
         echo '<p>Tu cuenta ha sido creada! Bienvenido :D</p>';
      }
      echo '</div>';
   }
   ?>
</div>