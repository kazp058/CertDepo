<?php
require "header.php";
?>

<main>
  <div class="wrapper-main">
    <section class="message-container">
      <?php require "messages.php"; ?>
    </section>
    <section class="section-form">

      <div class="form-container">
        <div class="title-left">
          <h1>Signup</h1>
        </div>
        <div class="subsplitter">
          <hr>
        </div>
        <div class="normal-form">
          <form class="form-signup" action="includes/signup.inc.php" method="post">
            <div class="field">
              <p>Nombre legal o nombre de la compañía</p>
              <div class="input-field">
                <i class="material-icons md-36">account_circle</i>
                <input type="text" name="uid">
              </div>
            </div>
            <div class="field">
              <p>Correo electrónico</p>
              <div class="input-field">
                <i class="material-icons md-36">email</i>
                <input type="text" name="mail">
              </div>
            </div>
            <div class="field">
              <p>Contraseña</p>
              <div class="input-field">
                <i class="material-icons md-36">vpn_key</i>
                <input type="password" name="pwd">
              </div>
            </div>
            <div class="field">
              <p>Repita su contraseña</p>
              <div class="input-field">
                <i class="material-icons md-36">vpn_key</i>
                <input type="password" name="pwd-repeat">
              </div>
            </div>
            <div class="field">
              <div class="check-field">
                <label class="container">
                  <input type="checkbox" name="accept" value="accept">
                  <span class="checkmark"></span>
                </label>
                <p>Yo acepto los <a>Términos  de Servicio</a> y las <a>Políticas de Privacidad</a>.</p>
              </div>
            </div>
            <div class="buttons">
              <button type="submit" name="signup-submit">Registrar</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>

<?php
require "footer.php"
?>