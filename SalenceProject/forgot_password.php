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
<?php include "navbar.php"?>

<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Enter your email address</h2>
    <div class="form-content">
        <form action="forgot_submit.php" method="POST">
            <div class="block-content">
                <label>Email</label>
                <input class="form-input" type="email" autocomplete="off" value="<?php echo isset($_SESSION["mail"]) ? $_SESSION["mail"] : null ?>" name="email" placeholder="Enter your email..">
                <div class="error-message"><?php echo isset($_SESSION["mail_error"]) ? $_SESSION["mail_error"] : null ?></div>
            </div>

            <button type="submit" name="submit" class="form-button auth-alt">Request Reset Code</button>
        </form>

    </div>
</div>

</body>
</html>