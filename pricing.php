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
            <h3>Precios</h3>
            <p>Usa el deslizador para seleccionar la añadir los certificados que cubran tus necesidades.</p>
            <p>Estos <strong>certificados</strong> son de <strong>un solo pago</strong> y <strong>no tienen caducidad</strong>. Puedes comprar certificados ahora y usarlos como te convengan.</p>
            <br>
            <h3>Métodos de pago</h3>
            <p></p>
            <br>
            <div class="image">
                <img src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/cc-badges-ppppcmcvdam.png" alt="Pay with PayPal, PayPal Credit or any major credit card" />
            </div>
        </div>


        <div class="payment-form">
            <h3>Paquete de certificados</h3>
            <div class="field">
                <div class="info-field">
                    <p><span id="certsnum"></span><strong>   Certificados</strong></p>
                </div>
                <div class="info-field">
                    <p>Total en USD$<span id="price"></span> </p>
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
                    <p><strong>Ingresa a tu cuenta con estado de compañía para comprar certificados</strong></p>
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
                        value: '0.50' //String(cost)
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
