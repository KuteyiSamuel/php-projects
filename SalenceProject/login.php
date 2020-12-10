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
            <button type="submit" class="form-button" name="submit" id="submit-button">Log in</button>

        </form>

    </div>
</div>
<script src="js/salence_login.js"></script>
</body>
</html>
