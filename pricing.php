<?php
require 'header.php';
?>
<script src="https://www.paypal.com/sdk/js?client-id=ASWTD2lnV8eW6xqTvZU6P2Pro2EbWLSKWiGKe52_FkaYi_-nGpjSyZvqJv4cRFCCAV74GN8jyn5kpKLe&currency=USD" data-sdk-integration-source="button-factory"></script>
</script>
<main>
    <section class="message-container">
        <?php require "messages.php"; ?>
    </section>
    <section class="payment-container">
        <div class="info">
            <h3>Pricing</h3>
            <p>Use the quantity sliders to customize the certificates that you buy according to your needs.</p>
            <p>These <strong>certificates</strong> are <strong>one-time</strong> payments and they <strong>will not expire</strong>. You can buy a amount of certificates and use them as you like, this means that you can assign them later if you want or save them for later.</p>
            <br>
            <h3>Payment Methods</h3>
            <p>We manage our payments throught Paypal, so its extra secure for you. We count with a verification API to confirm your purchases and make the experience as smooth as posible.</p>
            <br>
            <div class="image">
                <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" alt="Pay with PayPal, PayPal Credit or any major credit card" />
            </div>
        </div>


        <div class="payment-form">
            <h3>Package</h3>
            <div class="field">
                <div class="info-field">
                    <p><span id="certsnum"></span><strong>   Certificates</strong></p>
                </div>
                <div class="info-field">
                    <p>Total in USD$<span id="price"></span> </p>
                </div>
                <div class="payment-field">
                    <input type="range" min="100" max="500" value="120" class="slider" id="certs">
                </div>
                <?php
        if(isset($_SESSION['isCompany']) && $_SESSION['isCompany']){
        ?>
                <div id="paypal-button-container">
                </div>
                <?php
            }else{
            ?>
            <div class="info-field">
                    <p><strong>Login into a company account to start buying Certificates</strong></p>
                </div>
            <?php
            }
            ?>
            </div>

    </section>
</main>
<script>
    var slider = document.getElementById("certs");
    var output = document.getElementById("certsnum");
    var price = document.getElementById("price");
    var cost = 6.00;
    var certs = 0;
    output.innerHTML = slider.value;
    price.innerHTML = cost.toFixed(2);
    slider.oninput = function() {
        certs = this.value
        output.innerHTML = certs;
        cost = Math.round(slider.value * 0.05 * 100) / 100;
        price.innerHTML = cost.toFixed(2);
    }
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'black',
            layout: 'vertical',
            label: 'pay',

        },
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency_code: "USD",
                        value: String(cost)
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert("Stand still, we are processing your order.");
                window.location = "/includes/payment.inc.php?orderID=" + data.orderID + "&userID=<?php echo $_SESSION['userId']; ?>";
            });
        }
    }).render('#paypal-button-container');
</script>
<?php
require 'footer.php';
?>