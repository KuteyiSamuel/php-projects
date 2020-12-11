<?php
    session_start();
?>

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
<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Log in and get started</h2>
    <?php
    $updated = isset($_SESSION["updated"]) ? $_SESSION["updated"] : null;

    if ($updated == true) {
        ?>
        <div class="updated">Your new password has been set</div>
        <?php
    }
    ?>
    <div class="form-content">
        <form action="index.php" method="post" id="login-form">
            <div class="block-content">
                <label>E-mail address</label>
                <input class="form-input" type="email" autocomplete="off" id="email" name="email"  placeholder="Enter your email..">
                <div class="error-message" id="email-error"></div>
            </div>

            <div class="block-content">
                <label>Password</label>
                <input class="form-input" type="password" autocomplete="off" id="password" name="password"  placeholder="Type in your password..">
                <div class="error-message" id="password-error"></div>
            </div>

            <div class="error-message"></div>

            <div class="block-content"><a href="forgot_password.php">Forgotten your password?</a></div>

            <button type="submit" class="form-button auth" name="submit" id="submit-button">Log in</button>
            <div align="center" class="register-link"><a href="register.php">Don't have an account? Register</a></div>

        </form>

    </div>
</div>

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
<script src="js/salence_login.js"></script>
</body>
</html>
