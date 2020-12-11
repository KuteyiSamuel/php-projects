$(document).ready(function () {
        $("#resend-token").click(function (e) {
                e.preventDefault();
            $.ajax({
                url:  "send_token.php",
                type: "POST",
                success:  function (response) {
                    console.log(response)
                    if (response.status == 200){
                        $('#token-message').append(`<span class="success">Mail sent</span>`)
                    }else{
                        $('#token-message').append(`<span class="warning">Error sending mail</span>`)
                    }

                }
            })
        })

})