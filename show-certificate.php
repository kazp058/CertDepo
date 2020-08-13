<?php
require 'header.php';
require 'includes/dbh.inc.php';
$sql = "SELECT * FROM certs WHERE idCerts=?;";
$stmt = mysqli_stmt_init($conn_certs);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../certificates.php?id=" . $_GET['id'] . "error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {

        $sql = "SELECT * FROM certscompany WHERE certId=?;";
        $stmt = mysqli_stmt_init($conn_certs);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../certificates.php?id=" . $_GET['id'] . "error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $row['issuerCerts']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($rowissuer = mysqli_fetch_assoc($result)) {
                header("show-certificate.php?id=8&F");
                $command = escapeshellcmd('includes/scripts/generateCert.py 001.png '. $row['userName'] . ' ' . $row['titleCerts'] . ' ' . $row['tokenCerts'] . ' ' . $rowissuer['issuerName']);
?>
                <p>
                    <?php echo shell_exec('python3 includes/scripts/generateCert.py -f 001.png -n '. $row['userName'] . ' -t ' . $row['titleCerts'] . ' -k ' . $row['tokenCerts'] . ' -i ' . $rowissuer['issuerName']); ?>
                </p>
<?php
            }
        }
    }
}
