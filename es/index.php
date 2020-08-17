<?php
    require "header.php";
?>

   <main>
     <div class="wrapper-main">
        <section class="section-default">
          <?php
              if(isset($_SESSION["userId"])){
                 ?>
                 <p class="login-status">Bienvenido</p>
                 <?php
              }
              else{
                 ?>
                 <p class="login-status">Ingresa a tu cuenta para acceder a todas las funciones!</p>
                 <?php
              }
          ?>
        </section>
     </div>
   </main>

<?php
    require "footer.php";
?>

