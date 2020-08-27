<?php
require "header.php";
?>
<main>
  <div class="wrapper-main">
    <section class="message-container">
      <?php require "messages.php"; ?>
    </section>
    <section class="section-form">
      <div class='messages'>
        <?php
        if (isset($_GET["reset"])) {
          if ($_GET["reset"] == "success") {
            echo '<p class="success">Link have been sended to your email!</p>';
          }
        } else if (isset($_GET["error"])) {
          if ($_GET["error"] == "invalidemail") {
            echo '<p class="error">Invalid email</p>';
          } else if ($_GET["error"] == "noaccount") {
            echo '<p class="error">No account related to this email was found!</p>';
          } else if ($_GET["error"] == "sqlerror") {
            echo '<p class="error">There was a problem, try this later or contact support</p>';
          }
        }
        ?>
      </div>
      <div class="form-container">

        <div class="title-left">
          <h1>Reestablece tu contraseña</h1>
          <p>Un correo para reestablecer tu contraseña sera enviado a la dirección que pongas abajo.</p>

        </div>

        <div class="normal-form">
          <form action="includes/reset-request.inc.php" method="post">
            <div class="field">
              <p>Correo electrónico</p>
              <div class="input-field">
                <i class="material-icons md-36">email</i>
                <input type="text" name="email">
              </div>
            </div>
            <div class="buttons">
              <button class="highlight-button" type="submit" name="reset-request-submit">Recuperar cuenta</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
</main>

<?php
require "footer.php";
?>