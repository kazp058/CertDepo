<?php
require 'header.php';
?>

<main>
   <div class="wrapper-main">
      <section class="message-container">
         <?php require "messages.php"; ?>
      </section>
      <section class="section-default">
         <?php
         if (isset($_GET['success'])) {
            $_SESSION['isCompany'] = 1;
         }
         if (isset($_SESSION['userId'])) {
         ?>
            <div class="company-form">
               <form action="includes/change-status.php" method="post">
                  <input type="hidden" value="<?php echo $_SESSION['userId']; ?>" name="id">
                  <button type="submit" name="change-submit">
                     <i class="material-icons md-18">verified</i> Estado de Empresa
                  </button>
                  <p>Cuando solicites el estado de compañía seras capaz de emitir certificados.</p>
               </form>
            </div>
         <?php
         } else {
         ?>
            <div class="company-form">
               <form action="login.php" method="post">
                  <button type="submit" name="change-submit">
                     <i class="material-icons md-18">verified</i> Estado de Empresa
                  </button>
                  <p>Cuando solicites el estado de compañía seras capaz de emitir certificados.</p>
                  <p>Ingresa a tu cuenta para solicitar el estado de compañía.</p>
               </form>
            </div>
         <?php
         }
         ?>
         <div>
            <h2>Preguntas Frecuentes</h2>
            <hr>
            <div class="grid-vertical">
               <div class="grid-e">
                  <div class="content">
                     <h3>¿Cómo verificamos los datos de los emisores?</h3>
                     <p>Nosotros no solicitamos documentacion legal a los emisores de certificados debido a nuestras políticas de privacidad y no nos hacemos responsables del uso que se haga con la plataforma.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>¿Qué métodos de pago aceptan?</h3>
                     <p>Nosotros manejamos los pagos a través de <strong>PayPal</strong>, de esta forma hacemos el proceso de pago simple y eficiente.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>¿Cómo puedo obtener el estado de empresa?</h3>
                     <p>Puedes hacer click en la opción <strong>Estado de Empresa</strong> y listo, puedes emitir certificados.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>¿Quién puede ver mi información?</h3>
                     <p>Nosotros no solicitamos información legal sobre ti, tampoco compartimos tu información. Obviamente los certificados pueden ser compartidos y si envias el link o el código qr y estos pueden ser vistos por cualquiera.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>Puedo ver el pago realizado en mi estado de cuenta pero no veo que los certificados se hallan actualizado</h3>
                     <p>Si ocurre un error entonces contáctanos al correo <strong>certdepo@gmail.com</strong> y especifica tu situación.</p>
                  </div>
               </div>
               <div class="grid-e">
                  <div class="content">
                     <h3>Quiero cambiar mi información</h3>
                     <p>Por el momento no contamos con esas opciones, pero pronto implementaremos esas funciones.</p>
                  </div>
               </div>
            </div>
      </section>
   </div>
</main>

<?php
require 'footer.php';
?>