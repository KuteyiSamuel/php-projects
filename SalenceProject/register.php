
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link  href="css/salence.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="register-progress" align="center">
    <i class="fas fa-user-check"></i>
    <div class="border-line"></div>
    <i class="fas fa-envelope-open"></i>
    <div class="border-line"></div>
    <i class="fab fa-paypal"></i>
</div>

<div id="container">

</div>
<div id="loader"></div>

<div id="checkout-div" style="display: none" class="check-out" align="center">
    <form class="paypal" id="checkout-form" action="payments.php" method="post" id="paypal_form">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="lc" value="UK" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
        <input type="hidden" id="payer-first-name" name="first_name" value="" />
        <input type="hidden" id="payer-last-name" name="last_name" value=""/>
        <input type="hidden" name="item_name" value="Letter delivery payment" />
        <input type="hidden" name="amount" id="amount" value="35.00" />
        <input type="hidden" id="payer-email" name="payer_email" value="" />
        <input type="hidden" name="item_number" value="123456" / >
        <input type="submit" name="submit" id="submit-checkout" value="Proceed to checkout"/>
    </form>
</div>
<script src="js/salence_register.js"></script>
</body>
</html>
