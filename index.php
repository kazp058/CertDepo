<?php
require "header.php";
?>

<main>
   <div class="wrapper-main">
      <section class="message-container">
         <?php require "messages.php"; ?>
      </section>
      <section class="section-index">
         <?php
         if (isset($_SESSION["userId"])) {
         ?>
            <div class="info">
               <h3>Bienvenido! ya nos hacías falta</h3>
               <p>Comienza a emitir o a reclamar certificados ahora, recuerda que es gratis y es facil de hacer. ¿Qué esperas?</p>
            </div>
         <?php
         } else {
         ?>
            <div class="info">
               <h3>Disfruta de todas las funciones creando una cuenta</h3>
               <p>Puedes recibir certificados aun cuando no tienes una cuenta, pero solo puedes emitir certificados y vincularlos a ti permanentemente con una cuenta</p>
               <p>Puedes <a href="signup.php">crear una cuenta ahora</a> o <a href="login.php">ingresar a tu cuenta</a> para disfrutar de todas las funciones y herramientas. Si deseas tener el estado de compañía <a href="support.php">da click aquí</a>.</p>
            </div>
         <?php
         }
         ?>
         <div class="subsplitter">
            <hr>
         </div>
         <div class="certview-center">
            <div class="certinfo">
               <h2>Certificaods</h2>
               <h2>Seguros</h2>
               <h2>Protegidos</h2>
               <h2>Respaldados</h2>
            </div>
            <div class="certimage-center">
               <img src="includes/scripts/certificates/temp/Cert6.png">
            </div>
         </div>
         <div class="subsplitter">
            <hr>
         </div>
         <div class="grid-vertical">
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">grading</i></div>
               <div class="content">
                  <h3>¿Qué hacemos? </h3>
                  <p>Nosotros almacenamos certificados digitales que contienen un token único y un código qr, con esto puedes verificar tu certificado en cualquier parte del mundo. No necesitas descargar ningun software.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">qr_code_scanner</i></div>
               <div class="content">
                  <h3>Códigos qr en nuestros certificados</h3>
                  <p>Los tokens que vienen en cada certificado son unicos en el mundo y los códigos qr también, gracias a este último puedes acceder fácilmente a tu certificado en línea.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">cloud</i></div>
               <div class="content">
                  <h3>Respaldo en la nube</h3>
                  <p>No te preocupes por respaldar los certificados que emites, nosotros nos encargamos de respaldarlo a traves de multiples servidores.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">enhanced_encryption</i></div>
               <div class="content">
                  <h3>Encriptacion</h3>
                  <p>¿Preocupado por tu información? Nosotros encriptamos tus datos personales y los mantenemos seguro en nuestros servidores bien protegidos. Tampoco vendemos tu información, ya que nosotros recaudamos ingresos mediante anuncios, permitiendo que nuestra plataforma sea gratuita. Puedes leer más sobre nuestras <a href="#">políticas de privacidad</a>.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">architecture</i></div>
               <div class="content">
                  <h3>Mejoras constantes en nuestros servicios</h3>
                  <p>Recien comenzamos a brindar servicios, pero llegamos para quedarnos, si tienes alguna recomendacion estaremos mas que encantados de leerlas <a href="#">read them</a>.</p>
               </div>
            </div>
            <div class="grid-e">
               <div class="icon"><i class="material-icons md-48">share</i></div>
               <div class="content">
                  <h3>Fácil de compartir </h3>
                  <p>Códigos qr y links, te permiten compartir tu información de forma rápida y segura, protegiendo tu información de terceros y respaldando tus certificados en el internet.</p>
               </div>
            </div>
         </div>
      </section>
   </div>
</main>

<?php
require "footer.php";
?>