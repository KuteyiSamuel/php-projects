<?php
    session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="css/salence.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>

</head>
<body>

<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Enter the reset code</h2>
    <div class="form-content">
        <form action="reset_submit.php" method="POST">
            <div class="block-content">
                <input class="form-input" type="text" autocomplete="off" value="<?php echo isset($_SESSION["code"]) ? $_SESSION["code"] : null ?>" name="code" placeholder="Enter the code sent to your mail..">
                <div class="error-message"><?php echo isset($_SESSION["code_error"]) ? $_SESSION["code_error"] : null ?></div>
                <div id="token-message"></div>
            </div>

            <button type="submit" name="submit" class="form-button auth">Verify Token</button>
            <div class="flexcheck" style="text-align: center"><a href="send_token.php" id="resend-token">Resend token</a></div>
        </form>

    </div>
</div>

<script src="js/token_sender.js"></script>
</body>
</html>