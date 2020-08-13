<?php
require 'header.php';
?>
<main>
    <section class="section-default">
        <div>
            <?php
            require 'includes/dbh.inc.php';
            $sql = "SELECT * FROM certs WHERE idCerts=?;";
            $stmt = mysqli_stmt_init($conn_certs);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: certificates.php?id=" . $_GET['id'] . "error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $sql = "SELECT * FROM certscompany WHERE certId=?;";
                    $stmt = mysqli_stmt_init($conn_certs);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: certificates.php?id=" . $_GET['id'] . "error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "i", $row['issuerCerts']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if ($rowissuer = mysqli_fetch_assoc($result)) {

                            $result = exec('/usr/bin/python3 /var/www/html/includes/scripts/generateCert.py -f 001.png -n ' . $row['userName'] . ' -t ' . $row['titleCerts'] . ' -k ' . $row['tokenCerts'] . ' -i ' . $rowissuer['issuerName'] . ' -c ' . $row['idCerts'] . ' 2>&1');
            ?>
                            <div>
                                <h2><?php echo $row['titleCerts']; ?></h2>
                                <div>
                                    <p>Reciever: <?php echo $row['userName']; ?></p>
                                    <p>Certificate granted by: <?php echo $rowissuer['issuerName'];?></p>
                                    <p>Validation token: <?php echo $row['tokenCerts'];?></p>
                                </div>
                            </div>
                            <div>
                                <img src="includes/scripts/certificates/temp/Cert<?php echo $_GET['id']; ?>.png">
                            </div>
            <?php
                        } else {
                            header("Location: certificates.php?error=nocert");
                            exit();
                        }
                    }
                }
            }
            ?>
        </div>
    </section>
</main>
<?php
require 'footer.php';
?>