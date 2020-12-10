$(document).ready(function () {
    $('#submit-button').on("click",  function (e) {
        e.preventDefault();

        $('.warning').remove();
        var login_form = $('#login-form');


        $.ajax({
            url: "login_validator.php",
            method: "POST",
            data: login_form.serialize(),
            success: function (response) {
                console.log(response)

                if(response.email){
                    $('#email-error').append(`<span class="warning">${response.email}</span>`);
                    $('#email').css('border',  '1px solid red');
                }else{
                    $('#email').css('border', '1px solid green');
                }

                if(response.password){
                    $('#password-error').append(`<span class="warning">${response.password}</span>`);
                    $('#password').css('border',  '1px solid red');
                }else{
                    $('#password').css('border',  '1px solid green');
                }

                if (response.success)  {
                    window.location.href = "index.php";
                }
            }
        })
    })
})