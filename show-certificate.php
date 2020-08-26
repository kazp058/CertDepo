<?php
require 'header.php';
?>
<main>
    <section class="message-container">
        <?php require "messages.php"; ?>
    </section>
    <section class="section-default">
        <div class="certview">
            <?php
            require 'includes/dbh.inc.php';
            $sql = "SELECT * FROM certs WHERE idCerts=?;";
            $stmt = mysqli_stmt_init($conn_certs);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: certificates.php?id=" . $_GET['id'] . "error=sql");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    $sql = "SELECT * FROM certscompany WHERE certId=?;";
                    $stmt = mysqli_stmt_init($conn_certs);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: certificates.php?id=" . $_GET['id'] . "error=sql");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "i", $row['issuerCerts']);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if ($rowissuer = mysqli_fetch_assoc($result)) {

                            $result = exec('sudo /usr/bin/python3 /var/www/certdepo/includes/scripts/generateCert.py -f 001.png -n ' . $row['userName'] . ' -t ' . $row['titleCerts'] . ' -k ' . $row['tokenCerts'] . ' -i ' . $rowissuer['issuerName'] . ' -c ' . $row['idCerts'] . ' 2>&1');
            ?>
                            <div class="certinfo">
                                <h2><?php echo $row['titleCerts']; ?></h2>
                                <div>
                                    <p><strong>Reciever:</strong> <?php echo $row['userName']; ?></p>
                                    <p><strong>Certificate granted by: </strong><?php echo $rowissuer['issuerName']; ?></p>
                                    <p><strong>Validation token: </strong><?php echo $row['tokenCerts']; ?></p>
                                    <?php
                                    if ($row['isClaimed'] == 0) { //<?php echo $_GET['id']; s
                                    ?>
                                        <form action="includes/claim.inc.php" method="post">
                                            <input type="hidden" name="token" value="<?php echo $row['tokenCerts']; ?>">
                                            <div class="field">
                                                <p>Claim code</p>
                                                <div class="input-field">
                                                    <input type="text" name="ccode" maxlength="6">
                                                </div>
                                            </div>
                                            <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']; ?>">
                                            <div class="button">
                                                <button type="submit" name="claim-submit">Claim</button>
                                            </div>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="certimage">
                                <img src="includes/scripts/certificates/temp/Cert8.png">
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