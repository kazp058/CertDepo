<?php
require 'header.php';
?>
<script src="https://www.paypal.com/sdk/js?client-id=AYEuYnrTMJSbENtLsULbIA-DHk7MYeDgAd_enuN2tYsLRgIi7TvsYZTQHx2vRuZkxjJ7AeLJjzGUQggu"></script>
<div id="paypal-button-container"></div>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '5'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Transaction completed by ' + details.payer.name.given_name);
                <?php
                require 'includes/dbh.inc.php';

                $sql = "SELECT * FROM users WHERE idUsers=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../login.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $amount = $row['certificatesAv'] + 100;
                    } else {
                        header("Location: ../login.php?error=sqlerror");
                        exit();
                    }
                }

                $sql = "UPDATE users SET certificatesAv= ? WHERE idUsers=" . $_SESSION['userId'] . ";";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error!";
                    exit();
                } else {

                    mysqli_stmt_bind_param($stmt, "i", $amount);
                    mysqli_stmt_execute($stmt);
                }
                ?>
            });
        }
    }).render('#paypal-button-container');
</script>
<?php
require 'footer.php';
?>