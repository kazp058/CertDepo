<?php
require 'header.php';
?>

<main>
  <div class="wrapper-main">
    <section class="section-default">
      <div class="title">
        <h1>Search certificates</h1>
        <hr>
      </div>
      <div class="formulary">
        <form action="includes/search.inc.php" method="post">
          <p>Token</p>
          <input type="text" name="key">
          <button class="highlight-button" type="submit" name="search-submit">Search</button>
        </form>
      </div>
    </section>

    <section class="section-table">
      <?php
      if (isset($_SESSION['userId']) && !$_SESSION['isCompany']) {
      ?>
        <h1>My certificates</h1>
        <hr>
        <?php
        if (true) {
        ?>
          <section class="section-default">
            <p>You dont have any certificates yet!</p>
            <br>
            <?php
            if ($_SESSION['isCompany']) {
            ?>
              <a class="highlight-link" href="create-certificate.php">Create new certificate</a>
          </section>
      <?php
            }
          }
        } else if (isset($_SESSION['userId']) && $_SESSION['isCompany']) {
      ?>

      <h1>Certificates Emitted(<?php
                                require 'includes/dbh.inc.php';

                                $sql = "SELECT * FROM certs WHERE issuerCerts=?;";
                                $stmt = mysqli_stmt_init($conn_certs);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                  header("Location: ../certificates.php?error=sqlerrorBBB");
                                  exit();
                                } else {
                                  mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
                                  mysqli_stmt_execute($stmt);
                                  $result = mysqli_stmt_get_result($stmt);
                                  $num_rows = mysqli_num_rows($result);
                                  echo $num_rows;
                                }
                                ?>/<?php
                                    require 'includes/dbh.inc.php';

                                    $sql = "SELECT * FROM users WHERE idUsers=?;";
                                    $stmt = mysqli_stmt_init($conn);

                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                      header("Location: ../certificates.php?error=sqlerrorAAA");
                                      exit();
                                    } else {
                                      mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
                                      mysqli_stmt_execute($stmt);
                                      $result = mysqli_stmt_get_result($stmt);
                                      if ($row = mysqli_fetch_assoc($result)) {
                                        echo $row['certificatesAv'];
                                      } else {
                                        header("Location: ../login.php?error=nouser");
                                        exit();
                                      }
                                    }
                                    ?>)</h1>
      <hr>

      <div>
        <?php
          require 'includes/dbh.inc.php';

          $sql = "SELECT * FROM certsCompany WHERE issuerCerts=?;";
          $stmt = mysqli_stmt_init($conn_certs);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../certificates.php?error=sqlerrorCCCC");
            exit();
          } else {
            mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = $result->fetch_assoc()) {
        ?>

            <div>
              <div>
                <h3><?php echo $row['titleCerts']; ?></h3>
              </div>
              <div>
                <div>
                  <h4>URL:</h4>
                  <p><?php echo "192.168.100.100/survey.php?id=" . $row['certId']; ?></p>
                </div>
                <div>
                  <h4>Certificates:</h4>
                  <p><?php echo $row['certsCreated'] . "|" . $row['certsAssigned']; ?></p>
                </div>
              </div>
            </div>

        <?php
            }
          }
        ?>
        <div>
          <h3><a href="create-certificate.php">Create Certificate</a></h3>
        </div>
        <div>
          <h3><a href="buy-certificates.php">Buy Certificates</a></h3>
        </div>
      </div>
    <?php
        }
    ?>
    </section>
  </div>
</main>

<?php
require 'footer.php';
?>