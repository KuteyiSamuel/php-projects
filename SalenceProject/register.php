
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
    <div class="content-setter" id="registration" style="display: none">
        <h2 style="color: #000d1a;text-align: center">Sign Up</h2>
        <div class="form-content">
            <form action="index.php" method="post" id="request-form">
                <div class="colon">
                    <div class="flex-content">
                        <label>First Name</label>
                        <input class="form-input" type="text" autocomplete="off" name="firstname" id="firstname"  placeholder="Enter your first name..">
                        <div class="error-message" id="first-name-error"></div>
                    </div>

                    <div class="flex-content">
                        <label>Last Name</label>
                        <input class="form-input" type="text" autocomplete="off" name="lastname"  id="lastname" placeholder="Enter your last name..">
                        <div class="error-message" id="last-name-error"></div>
                    </div>
                </div>

                <div class="block-content">
                    <label>Work Email</label>
                    <input class="form-input" type="email" autocomplete="off" id="email" name="email"  placeholder="Enter your email..">
                    <div class="error-message" id="email-error"></div>
                </div>

                <div class="block-content">
                    <label>House address</label>
                    <input class="form-input" type="email" autocomplete="off" id="house-address" name="house_address"  placeholder="Enter your home address..">
                    <div class="error-message" id="address-error"></div>
                </div>


                <div class="block-content">
                    <select id="career-field">
                        <option value="" disabled selected>Which best describes you?</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Sales">Sales</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="Development">Development</option>
                        <option value="Others">Others</option>
                    </select>
                    <div class="error-message" id="field-error"></div>
                </div>

                <div class="block-content">
                    <input class="form-input" type="password" autocomplete="off" id="password" name="password"  placeholder="Type in a password..">
                    <div class="error-message" id="password-error"></div>
                </div>

                <div class="error-message"></div>
                <button type="submit" name="submit" id="submit-button" class="form-button auth">Sign Up</button>
                <div class="flexcheck">
                    <p>By signing up, you agree to the <a href="#" class="terms">Terms Of Service</a> and <a href="#" class="privacy">Privacy Policy</a></p>
                </div>
            </form>

        </div>
    </div>

    <div class="content-setter" id="verification" style="display: none">
        <h2 style="color: #000d1a;text-align: center">Mail Verification</h2>
        <div class="form-content">
            <form action="index.php" method="post" id="verify-form">
                <div class="block-content">
                    <input class="form-input" type="text" autocomplete="off" id="token" name="token"  placeholder="Please enter the code sent to your mail">
                    <div id="token-message"></div>
                </div>
                <button type="submit" name="submit" class="form-button auth-alt" id="verify-button">Verify mail</button>
                <div class="flexcheck" style="text-align: center"><a href="send_token.php" id="resend-token">Resend token</a></div>
            </form>
        </div>
    </div>
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
