var mail, firstname, lastname;

$(document).ready(function () {
    $('#loader').show();

    $.ajax({
        type: "GET",
        url: "register_progress.php",
        success: function (response) {
            console.log(response);
            $('#loader').hide();
            if (response.status == 1){
                verifyMail();
            }else{
                showForm();
            }
        }
    })

    $(document).on("click", '#submit-button', function (e) {
        e.preventDefault();
        var  first_name = $('#firstname').val(), last_name = $('#lastname').val(),
            email = $('#email').val(), password = $('#password').val(),
            career_field = $('#career-field').val();

        $('.warning').remove();


        $.ajax({
            url: "register_validator.php",
            method: "POST",
            data: {
                firstname: first_name,
                lastname: last_name,
                email: email,
                career_field: career_field,
                password: password
            },
            success: function (response) {
                console.log(response)

                if(response.firstname){
                    $('#first-name-error').append(`<span class="warning">${response.firstname}</span>`);
                    $('#firstname').css('border',  '1px solid red');
                }else{
                    $('#firstname').css('border',  '1px solid green');
                }

                if(response.lastname){
                    $('#last-name-error').append(`<span class="warning">${response.lastname}</span>`);
                    $('#lastname').css('border', '1px solid red');
                }else{
                    $('#lastname').css('border', '1px solid green');
                }

                if(response.email){
                    $('#email-error').append(`<span class="warning">${response.email}</span>`);
                    $('#email').css('border',  '1px solid red');
                }else{
                    $('#email').css('border', '1px solid green');
                }

                if (response.career_field){
                    $('#field-error').append(`<span class="warning">${response.career_field}</span>`)
                }

                if(response.password){
                    $('#password-error').append(`<span class="warning">${response.password}</span>`);
                    $('#password').css('border',  '1px solid red');
                }else{
                    $('#password').css('border',  '1px solid green');
                }

                if (response.success){
                    $("#loader").show();
                    mail = $('#email').val();
                    firstname =  $('#firstname').val();
                    lastname =  $('#lastname').val();


                    $('#payer-first-name').val(firstname)
                    $('#payer-last-name').val(lastname)
                    $('#payer-email').val(mail);
                    $("#container").text("");
                    $('.fa-user-check').addClass("passed");
                    verifyMail();
                }
            }
        })
    })

    $(document).on("click", "#resend-token", function (e) {
        e.preventDefault();
        sendMail(mail);
    })

    $(document).on("click", "#verify-button", function (e) {
        e.preventDefault();
        var verify_form = $('#verify-form');

        $.ajax({
            type: "POST",
            url: "mail_verify.php",
            data: verify_form.serialize(),
            success: function (response) {
                console.log(response);

                if (response.error){
                    $('#token-message').append(`<span class="warning">${response.error}</span>`)
                }

                if (response.interval > 60){
                    $('.notification').remove();
                    $('#notice').append(`<span>This code has expired <button id="new-request" class="new-request">Request a new one</button></span>`)
                }

                if (response.success){
                    $('.fa-envelope-opens').addClass("passed");
                    $('#submit-checkout').trigger("click");
                }
            }
        })
    })

    $(document).on("click", "#new-request", function () {
        $.ajax({
            url:  "send_token.php",
            type: "POST",
            data: {
                new_request: true
            },
            success:  function (response) {
                $('#token-message').append(`<span class="success">Mail sent</span>`)
            }
        })
    })
})

function showForm() {
    $('#container').append(`
            <div class="content-setter">
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
            <button type="submit" name="submit" id="submit-button" class="form-button">Sign Up</button>
                <div class="flexcheck">
                    <p>By signing up, you agree to the <a href="#" class="terms">Terms Of Service</a> and <a href="#" class="privacy">Privacy Policy</a></p>
                </div>
        </form>

    </div>
</div>
    `)
}

function verifyMail() {
    $('#loader').hide();


        $('#container').append(`
            <div class="content-setter">
    <h2 style="color: #000d1a;text-align: center">Mail Verification</h2>
        <div class="form-content">
            <form action="index.php" method="post" id="verify-form">
            <div class="block-content">
                <input class="form-input" type="text" autocomplete="off" id="token" name="token"  placeholder="Please enter the code sent to your mail">
                <div id="token-message"></div>
            </div>
            <button type="submit" name="submit" class="form-button" id="verify-button">Verify mail</button>
            <div class="flexcheck" style="text-align: center"><a href="send_token.php" id="resend-token">Resend token</a></div>
            </form>
        </div>
     </div>
        `)

    sendMail(mail);
}

function sendMail(address) {
   $.ajax({
       url:  "send_token.php",
       type: "POST",
       data: {
           mail: address
       },
       success:  function (response) {
            $('#token-message').append(`<span class="success">Mail re-sent</span>`)
       }
   })
}