<?php
require 'header.php';
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
                ?><p><?php echo $rowissuer['issuerCerts'];?></p><?php
                $result = exec('/usr/bin/python3 /var/www/html/includes/scripts/generateCert.py -f 001.png -n '. $row['userName'] . ' -t ' . $row['titleCerts'] . ' -k ' . $row['tokenCerts'] . ' -i ' . $rowissuer['issuerName'] . ' -c '.$row['idCerts'].' 2>&1');
                ?>
                <img src="includes/scripts/certificates/temp/Cert<?php echo $_GET['id'];?>.png" >
                <?php
            }else{
                header("Location: certificates.php?error=nocert");
                exit();
            }
        }
    }
}

require 'footer.php';
