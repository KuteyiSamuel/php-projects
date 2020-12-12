<?php
    session_start();

    if ($_SESSION["logged_in"] != true) {
        header("Location: login.php");
    }
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link  href="css/salence.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ee654fe705.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include "navbar.php"?>
<div id="loader"></div>

<div id="container" align="center">
    <div class="header" style="display: none">
        <h2 class="recipient-header">Add Recipients</h2>

        <div class="recipient-holder">
            <div class="recipient" id="self-recipient" data-recipient = "self">I'd like to send a sample to myself</div>
            <div class="recipient" id="other-recipient" data-recipient = "others">I'd like to send to other recipients</div>
        </div>
    </div>

    <div class="recipient-form" id="recipient-form" style="display: none">
        <div class="content-container"><button id="back-to-options" class="back-button">Back</button></div>
        <h2>Enter recipient details</h2>
        <div class="form-content">
                <div class="colon">
                    <div class="flex-content">
                        <input class="form-input" type="text" autocomplete="off" name="firstname" id="firstname"  placeholder="Enter recipient's first name..">
                        <div class="error-message" id="first-name-error"></div>
                    </div>

                    <div class="flex-content">
                        <input class="form-input" type="text" autocomplete="off" name="lastname"  id="lastname" placeholder="Enter recipient's last name..">
                        <div class="error-message" id="last-name-error"></div>
                    </div>
                </div>

                <div class="block-content">
                    <input class="form-input" type="email" autocomplete="off" id="email" name="email"  placeholder="Enter recipient's email address..">
                    <div class="error-message" id="email-error"></div>
                </div>

                <div class="half-content">
                    <input class="form-input" type="text" autocomplete="off" id="company-name" name="company_name"  placeholder="Company name..">
                    <div class="error-message" id="company-error"></div>
                </div>

                <div class="block-content">
                    <input class="form-input" type="text" autocomplete="off" id="profile-link" name="profile_link"  placeholder="Paste recipient's LinkedIn profile URL (optional)">
                    <div class="error-message"  id="link-error"></div>
                </div>

                <h2>Head Office Address (optional)</h2>

                <div class="half-content">
                    <input class="form-input" type="text" autocomplete="off" id="street-address" name="street_address"  placeholder="Street Address..">
                    <div class="error-message"></div>
                </div>

                <div class="half-content">
                    <input class="form-input" type="text" autocomplete="off" id="city" name="city"  placeholder="City..">
                    <div class="error-message"></div>
                </div>


                <div class="half-content">
                    <input class="form-input" type="text" autocomplete="off" id="post-code" name="email"  placeholder="Postcode..">
                </div>

                <div class="half-content">
                    <select class="form-input">
                        <option value="United Kingdom">United Kingdom</option>
                    </select>
                </div>

                <div class="colon">
                    <button class="new-recipient" id="add-another-recipient">Add another recipient</button>
                    <button class="next next-recipient" id="add-new-recipient">Add</button>
                    <button class="next next-recipient" id="next-page">Next</button>
                </div>

        </div>
    </div>

    <div class="spec-selector" style="display: none">
        <h2 class="format-header">Choose letter format</h2>
        <div id="paper-selector" class="paper-selector">
            <div class="paper a-4">
                <p>A4 (210x297mm - 8.3x11.7 inches)</p>
            </div>

            <div class="paper a-5">
                <p>A5 Landscape</p>
            </div>
        </div>

        <div class="material-type">
            <h3>Type of material?</h3>
            <select id="material">
                <option value="Standard plain white paper">Standard plain white paper</option>
            </select>
        </div>
        <div class="error-message display-error"></div>

        <div class="submission-button">
            <button id="back-to-previous" class="back-button">Back</button>
            <button id="spec-button" class="next-button">Next</button>
        </div>
    </div>

    <div class="letter-typer" style="display: none">
        <h2 class="format-header">Type your letter</h2>
        <div class="flex-display">
            <div id="editor" class="editor">

            </div>
        </div>

        <div class="error-message display-error"></div>

        <div class="letter-submit">
            <button id="back-to-specs" class="back-button">Back</button>
            <button id="letter-submit" class="next-button">Next</button>
        </div>
    </div>

    <div class="final-details" id="final-details" style="display: none">
        <h2>Brand envelope</h2>
        <div class="form-content">
            <div class="half-content">
                <h4>Envelope color</h4>
                <select id="envelope-cover">
                    <option value="Standard brown">Standard brown</option>
                </select>
            </div>

            <div class="half-content">
                <h4>Message on envelope cover</h4>
                <textarea id="envelope-message" placeholder="Leave blank for no message"></textarea>
            </div>

            <div class="error-message display-error"></div>

            <div class="half-content final-submission">
                <button id="back-to-letter" class="back-button">Back</button>
                <button id="final-submit" class="next-button">Send</button>
            </div>
        </div>
    </div>

    <div id="success" style="display: none">
        <i class="fas fa-check-circle"></i>
        <p>Your letter delivery order has been sent</p>
        <a href="create.php" class="create">Create another letter</a>
    </div>
</div>



<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="js/letter.js"></script>
</body>
</html>

