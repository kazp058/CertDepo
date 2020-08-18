<?php
require 'header.php';
?>
<script src="https://www.paypal.com/sdk/js?client-id=AYEuYnrTMJSbENtLsULbIA-DHk7MYeDgAd_enuN2tYsLRgIi7TvsYZTQHx2vRuZkxjJ7AeLJjzGUQggu&currency=USD" data-sdk-integration-source="button-factory"></script>

</script>
<main>
    <section class="payment-container">
        <div class="info">
            <h3>Pricing</h3>
            <p>Use the quantity sliders to customize the certificates that you buy according to your needs.</p>
            <p>These <strong>certificates</strong> are <strong>one-time</strong> payments and they <strong>will not expire</strong>. You can buy a amount of certificates and use them as you like, this means that you can assign them later if you want or save them for later.</p>
            <h3>Payment Methods</h3>
            <p>We manage our payments throught Paypal, so its extra secure for you.</p>
            <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" alt="Pay with PayPal, PayPal Credit or any major credit card" />
        </div>
        <div class="payment-form">
            <h3>Package</h3>
            <div class="field">
                <div class="info-field">
                    <p><span id="certsnum"></span> x $0.05</p>
                    <p>certificates</p>
                </div>
                <div class="info-field">
                    <p>= $<span id="price"></span></p>
                    <p>certificates</p>
                </div>
                <div>
                    <input type="range" min="100" max="500" value="120" class="slider" id="certs">
                </div>
                <div id="paypal-button-container">
                </div>
            </div>
    </section>
</main>
<script>
    var slider = document.getElementById("certs");
    var output = document.getElementById("certsnum");
    var price = document.getElementById("price");
    var cost = 6;
    var certs = 0;
    output.innerHTML = slider.value;
    price.innerHTML = Math.round(slider.value * 0.05 * 100) / 100;
    slider.oninput = function() {
            certs = this.value
            output.innerHTML = certs;
            cost = Math.round(slider.value * 0.05 * 100) / 100;
            price.innerHTML = cost;
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
                            currency_code:"USD",
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
                    window.location = "/AutomailOnline/includes/payment.inc.php?orderID=" + data.orderID + "&userID=<?php echo $_SESSION['userId'];?>";
                });
            }
        }).render('#paypal-button-container');
</script>
<?php
require 'footer.php';
?>