var mail, firstname, lastname;

$(document).ready(function () {

    if (localStorage.getItem("progress") == null){
        localStorage.setItem("progress", "auth");
    }

    if (localStorage.getItem("progress") == "auth") {
        showForm();
    }

    if (localStorage.getItem("progress") == "verify"){
        verifyMail();
    }



    $('#submit-button').on("click", function (e) {
        e.preventDefault();
        var  first_name = $('#firstname').val(), last_name = $('#lastname').val(),
            email = $('#email').val(), password = $('#password').val(), address = $('#house-address').val(),
            career_field = $('#career-field').val();

        $('.warning').remove();


        $.ajax({
            url: "register_validator.php",
            method: "POST",
            data: {
                firstname: first_name,
                lastname: last_name,
                email: email,
                address: address,
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

                if(response.address){
                    $('#address-error').append(`<span class="warning">${response.address}</span>`);
                    $('#house-address').css('border',  '1px solid red');
                }else{
                    $('#house-address').css('border',  '1px solid green');
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

                    $('.fa-user-check').addClass("passed");
                    localStorage.setItem("progress", "verify");
                    localStorage.setItem("mail", mail);
                    verifyMail();
                }
            }
        })
    })

    $("#resend-token").on("click", function (e) {
        e.preventDefault();
        var email = localStorage.getItem("mail");
        sendMail(email);
    })

    $("#verify-button").on("click", function (e) {
        e.preventDefault();
        $(".warning").remove();
        $(".success").remove();

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
                    $('.fa-envelope-open').addClass("passed");
                    localStorage.removeItem("progress");
                    $('#submit-checkout').trigger("click");
                }
            }
        })
    })

    $("#new-request").on("click", function () {
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

    $("#back-to-form").click(function () {
            $("#verification").hide();
            $("#registration").show();
        localStorage.setItem("progress", "auth");
    })
})

function showForm() {
    $("#registration").show();
}

function verifyMail() {
    $('#loader').hide();
    $("#registration").hide();
    $("#verification").show();

    sendMail(mail);
}

function sendMail(address) {
    $(".warning").remove();
    $(".success").remove();

   $.ajax({
       url:  "send_token.php",
       type: "POST",
       data: {
           mail: address
       },
       complete: function () {
         alert("Sent");
       },
       success:  function (response) {
           console.log(response)
           if (response.status == 200){
               $('#token-message').append(`<span class="success">Mail sent</span>`)
           }else{
               $('#token-message').append(`<span class="warning">Error sending mail</span>`)
           }

       }
   })
}