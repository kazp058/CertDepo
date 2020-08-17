<?php
require 'header.php';
?>
<html>
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
        require 'includes/dbh.inc.php';

        $sql = "SELECT * FROM certs WHERE userCerts=?;";
        $stmt = mysqli_stmt_init($conn_certs);
        $stmt2 = mysqli_stmt_init($conn_certs);

        if (!mysqli_stmt_prepare($stmt, $sql) || !mysqli_stmt_prepare($stmt2, $sql)) {

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
              <div>
                <div>
                  <h3><?php echo $userrow['titleCerts']; ?></h3>
                </div>
                <div>
                  <div>
                    <h4>Share URL: </h4>
                    <p><?php echo "192.168.100.100/show-certificate.php?id=" . $userrow['idCerts']; ?></p>
                  </div>
                </div>
              </div>
            <?php
            }
          } else {
            ?>
            <section class="section-default">
              <p>You dont have any certificates yet!</p>
          <?php
          }
        }
      } else if (isset($_SESSION['userId']) && $_SESSION['isCompany']) {
          ?>
          <h1>Certificates Emitted( Space available: <?php
                                                      require 'includes/dbh.inc.php';

                                                      $sql = "SELECT * FROM users WHERE idUsers=?;";
                                                      $stmt = mysqli_stmt_init($conn);

                                                      if (!mysqli_stmt_prepare($stmt, $sql)) {
                                                        header("Location: ../certificates.php?error=sqlerror");
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

          <div>
            <?php
            require 'includes/dbh.inc.php';

            $sql = "SELECT * FROM certscompany WHERE issuerCerts=?;";
            $stmt = mysqli_stmt_init($conn_certs);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: certificates.php?error=sqlerror");
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
                    <div>
                      <h4>Add more space</h4>
                      <form action="includes/add-space.inc.php" method="post">
                        <input type="hidden" name="id" value=<?php echo $row['certId']; ?>>
                        <input type="number" name="addup" min="1" max="<?php echo $userrow['certificatesAv']; ?>">
                        <button type="submit" name="addup-submit">Add</button>
                      </form>
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

</html>
<?php
require 'footer.php';
?>