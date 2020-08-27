<?php
require 'header.php';
?>

<main>
  <div class="wrapper-main">
    <section class="message-container">
      <?php require "messages.php"; ?>
    </section>
    <div class="section-default">
      <section class="section-search">
        <div class="search-form">
          <form action="includes/search.inc.php" method="post" id="">
            <div class="search-field">
              <input type="text" name="key" placeholder="Ingrese el token del certificado...">
              <button type="submit" name="search-submit"><i class="material-icons md-18">search</i></button>
            </div>
          </form>
        </div>
      </section>

      <section class="section-table">
        <?php
        if (isset($_SESSION['userId']) && !$_SESSION['isCompany']) {
        ?>
          <h1>Mis certificados</h1>
          <hr>
          <div class="grid-vertical">
            <?php
            require 'includes/dbh.inc.php';

            $sql = "SELECT * FROM certs WHERE userCerts=?;";
            $stmt = mysqli_stmt_init($conn_certs);
            $stmt2 = mysqli_stmt_init($conn_certs);

            if (!mysqli_stmt_prepare($stmt, $sql) || !mysqli_stmt_prepare($stmt2, $sql)) {
              echo "<p>You dont have any certificates yet!</p>";
            } else {
              mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);

              mysqli_stmt_bind_param($stmt2, "s", $_SESSION['userId']);
              mysqli_stmt_execute($stmt2);
              mysqli_stmt_store_result($stmt2);
              $rows = mysqli_stmt_num_rows($stmt2);
              if ($rows != 0) {
                while ($userrow = $result->fetch_assoc()) {
            ?>
                  <div class="grid-cert">
                    <div class="title">
                      <h3><?php echo $userrow['titleCerts']; ?></h3>
                    </div>
                    <div class="grid-info">
                      <div>
                        <h4>Link para compartir: </h4>
                        <p><?php echo "www.certdepo.com/show-certificate.php?id=" . $userrow['idCerts']; ?></p>
                      </div>
                    </div>
                  </div>
                <?php
                }
              } else {
                ?>
          </div>
          <section class="section-default">
            <p>¡Oh no! Aun no tienes certificados reclamados</p>
        <?php
              }
            }
          } else if (isset($_SESSION['userId']) && $_SESSION['isCompany']) {
        ?>
        <h1>Certificados Emitidos (Disponibles: <?php
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
                                                      if ($userrow = mysqli_fetch_assoc($result)) {
                                                        echo $userrow['certificatesAv'];
                                                      } else {
                                                        header("Location: ../login.php?error=nouser");
                                                        exit();
                                                      }
                                                    }
                                                    ?>)</h1>
        <hr>

        <div class="grid-vertical">
          <?php
            require 'includes/dbh.inc.php';

            $sql = "SELECT * FROM certscompany WHERE issuerCerts=?;";
            $stmt = mysqli_stmt_init($conn_certs);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
            } else {
              mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              while ($row = $result->fetch_assoc()) {
          ?>
              <div class="grid-cert">
                <div>
                  <h3><?php echo $row['titleCerts']; ?></h3>
                </div>
                <div>
                  <div class="info-inline">
                    <h4>URL: </h4>
                    <p><a href='<?php echo "survey.php?id=" . $row['certId']; ?>'><?php echo "www.certdepo.com/survey.php?id=" . $row['certId']; ?></a></p>
                  </div>
                  <div class="info-inline">
                    <h4>Certificados: </h4>
                    <p><?php echo $row['certsCreated'] . " | " . $row['certsAssigned']; ?></p>
                  </div>
                  <div class="info-inline">
                    <h4>Agregar más espacio </h4>
                    <form action="includes/add-space.inc.php" method="post">
                      <input type="hidden" name="id" value=<?php echo $row['certId']; ?>>
                      <input type="number" name="addup" min="1" max="<?php echo $userrow['certificatesAv']; ?>">
                      <button type="submit" name="addup-submit"><i class="material-icons md-12">add</i></button>
                    </form>
                  </div>
                </div>
              </div>


          <?php
              }
            }
          ?>

        </div>
        <div class="info-inline">
          <div>
            <h3><a href="create-certificate.php">Crear certificado</a></h3>
          </div>
          <div>
            <h3><a href="pricing.php">Comprar certificados</a></h3>
          </div>
        </div>
      <?php
          }
      ?>
    </div>
    </section>
  </div>
</main>

<?php
require 'footer.php';
?>