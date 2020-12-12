<?php

require_once "connection.php";

$id = $_GET["id"];

$sql = "SELECT * FROM letters WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row["user_id"];
        $recipient = $row["recipient"];
        $orientation = $row["orientation"];
        $material = $row["material"];
        $letter_body = $row["letter_body"];
        $envelope_color = $row["envelope_color"];
        $envelope_message = $row["envelope_message"];
    }
}

$user_query = "SELECT firstname, lastname FROM users WHERE id = '$user_id'";
$result_query = $conn->query($user_query);

if ($result_query->num_rows > 0) {
    while ($user_row = $result_query->fetch_assoc()){
        $firstname = $user_row["firstname"];
        $lastname = $user_row["lastname"];
    }
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
        <div class="content-holder">
            <h2 class="delivery-header">New letter delivery order from <?php echo $firstname ." ". $lastname; ?></h2>

            <div class="delivery delivery-sender"><span class="content-heading">Sender</span>: <?php echo $firstname ." ". $lastname ?></div>
            <div class="delivery delivery-recipient">
                <h3>Recipients</h3>
                <?php
                    if ($recipient == "self") {
                ?>
                    <p><span class="content-heading">Recipient:</span> self</p>
                <?php
                    }  else{
                        $recipient_query = "SELECT * FROM recipients WHERE letter_id = '$id'";
                        $recipient_result = $conn->query($recipient_query);

                        if ($recipient_result->num_rows > 0) {
                            while ($recipient_row = $recipient_result->fetch_assoc()) {
                                $recipient_firstname = $recipient_row["firstname"];
                                $recipient_lastname = $recipient_row["lastname"];
                                $recipient_mail = $recipient_row["email"];
                                $recipient_company = $recipient_row["company_name"];
                                $recipient_profile = $recipient_row["profile_link"];
                                $recipient_address = $recipient_row["street_address"];
                                $recipient_city = $recipient_row["city"];
                                $recipient_post_code = $recipient_row["post_code"];
                                $recipient_region = $recipient_row["region"];
                ?>
                  <div class="delivery delivery-recipients">
                      <div><span class="content-heading">Recipient name:</span> <?php echo $recipient_firstname ." ". $recipient_lastname ?></div>
                      <div><span class="content-heading">Recipient mail:</span> <?php echo $recipient_mail ?></div>
                      <div><span class="content-heading">Recipient company name:</span> <?php echo $recipient_company ?></div>
                      <div><span class="content-heading">Recipient LinkedIn Profile URL:</span> <?php echo $recipient_profile ?></div>
                      <h3>Head office details</h3>
                      <div><span class="content-heading">Company address:</span> <?php echo $recipient_address ?></div>
                      <div><span class="content-heading">City:</span> <?php echo $recipient_city ?></div>
                      <div><span class="content-heading">Post code:</span> <?php echo $recipient_post_code ?></div>
                      <div><span class="content-heading">Region:</span> <?php echo $recipient_region ?></div>
                  </div>
                <?php
                            }
                        }
                    }
                ?>
            </div>
            <div class="delivery delivery-orientation"><span class="content-heading">Paper orientation:</span> <?php echo $orientation ?></div>
            <div class="delivery delivery-letter">
                <h3>Letter</h3>
                <div class="letter-body">
                    <?php echo $letter_body ?>
                </div>
            </div>
            <div class="delivery delivery-envelope"><span class="content-heading">Envelope color: </span> <?php echo $envelope_color ?></div>
            <div class="delivery delivery-envelope-message"><span class="content-heading">Envelope message:</span><?php echo $envelope_message ?></div>
        </div>
</body>
</html>
