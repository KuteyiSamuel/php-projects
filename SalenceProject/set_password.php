<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
    <link href="css/salence.css" rel="stylesheet">
</head>
<body>
<?php include "navbar.php"?>

<div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Set a new password</h2>
    <div class="form-content">
        <form action="set_submit.php" method="POST">
            <div class="block-content">
                <input class="form-input" type="password" autocomplete="off" value="<?php echo isset($_SESSION["password"]) ? $_SESSION["password"] : null?>" name="password" placeholder="Enter your new password..">
                <div class="error-message"><?php echo isset($_SESSION["password_error"]) ? $_SESSION["password_error"] : null?></div>
            </div>

            <button type="submit" name="submit" class="form-button auth-alt">Set New Password</button>
        </form>

    </div>
</div>

</body>
</html>