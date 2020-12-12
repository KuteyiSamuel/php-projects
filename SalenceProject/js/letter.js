var recipient, index = 0, paper_type, material, letter;
var recipient_array = [];

var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    [{ 'direction': 'rtl' }],                         // text direction

    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],

    ['clean']                                         // remove formatting button
];

var options = {
    modules: {
        toolbar: toolbarOptions
    },
    placeholder: "Start typing your letter",
    theme: "snow"
};

var  quill = new Quill("#editor", options);

$(document).ready(function () {
    localStorage.removeItem("array")
    localStorage.removeItem("index")
    localStorage.removeItem("stage")

    if (localStorage.getItem("index") == null){
        localStorage.setItem("index", index.toString())
    }

    $('#loader').show();

    if (localStorage.getItem("stage") == null){
        localStorage.setItem("stage", "starter");
    }

    if (localStorage.getItem("stage") == "finishing"){
        setTimeout(function () {
            $('#loader').hide()
            finalDetails();
        }, 1500);
    }else if (localStorage.getItem("stage") == "letter"){
        setTimeout(function () {
            $('#loader').hide()
            letterTyping();
        }, 1500);
    }else if (localStorage.getItem("stage") == "specs"){
        setTimeout(function () {
            $('#loader').hide()
            selectSpecs();
        }, 1500);
    } else if (localStorage.getItem("stage") == "recipients"){
        setTimeout(function () {
            $('#loader').hide()
            recipientForm();
        }, 1500);
    }else{
        setTimeout(function () {
            $('#loader').hide()
            showOptions();
        }, 1500);
    }

    $("#self-recipient").on("click", function () {
        recipient = $(this).data("recipient");
        localStorage.setItem("recipient", recipient);
        localStorage.setItem("stage", "specs");
        localStorage.setItem("previous", "starter");
        $('.header').hide();

        $('#loader').show();

        setTimeout(function () {
            $('#loader').hide()
            selectSpecs();
        }, 1500);

    })

    $("#other-recipient").on("click", function () {
        recipient = $(this).data("recipient");
        localStorage.setItem("recipient", recipient);
        localStorage.setItem("stage", "recipients");
        $('.header').hide();

        $('#loader').show();

        setTimeout(function () {
            $('#loader').hide()

            recipientForm();
        }, 1500);

    })

    $("#add-new-recipient").on("click", function (e) {
        e.preventDefault();

        var  first_name = $('#firstname').val(), last_name = $('#lastname').val(),
            email = $('#email').val(), company = $('#company-name').val(),
            profile_link = $('#profile-link').val();

        $('.warning').remove();


        $.ajax({
            url: "recipient_validator.php",
            method: "POST",
            data: {
                firstname: first_name,
                lastname: last_name,
                email: email,
                company: company,
                profile_link: profile_link
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

                if (response.company){
                    $('#company-error').append(`<span class="warning">${response.company}</span>`)
                    $('#company-name').css('border',  '1px solid red');
                }else{
                    $('#company-name').css('border',  '1px solid green');
                }

                if(response.profile_link){
                    $('#link-error').append(`<span class="warning">${response.profile_link}</span>`);
                    $('#profile-link').css('border',  '1px solid red');
                }

                if (response.success){
                    var values = [];
                    for (var i = 0; i < $('.form-input').length; i++){
                        values[i] = $('.form-input').eq(i).val();
                    }
                    console.log(values);

                    var stored_index = parseInt(localStorage.getItem("index"));

                    if (localStorage.getItem("array") == null) {
                        localStorage.setItem("array", JSON.stringify(recipient_array));
                    }

                    var stored_array = JSON.parse(localStorage.getItem("array"))
                    stored_array[stored_index] = values;
                    localStorage.setItem("array", JSON.stringify(stored_array))
                    var new_index = stored_index + 1;
                    localStorage.setItem("index", new_index.toString())
                    console.log(stored_array);
                    localStorage.setItem("stage", "specs");
                    localStorage.setItem("previous", "recipients");

                   $('#add-another-recipient').show();
                   $("#next-page").show();
                   $("#add-new-recipient").hide();

                }
            }
        })

    });

    $("#next-page").click(function () {

        $("#add-another-recipient").hide()
        $("#add-new-recipient").show();
        $(this).hide();
        $("#loader").show();

        $(".recipient-form").hide();

        setTimeout(function () {
            $('#loader').hide()
            selectSpecs();
        }, 1500);

    });

    $("#add-another-recipient").click(function () {
        $("#next-page").hide();
        $(this).hide();
        $("#add-new-recipient").show();
        $('#firstname').val("")
        $('#lastname').val("")
        $('#email').val("")
        $('#company-name').val("")
        $('#profile-link').val("")
        $('#street-address').val("")
        $('#city').val("")
        $('#post-code').val("")

        $('#firstname').css('border', '1px solid #c3c3c3');
        $('#lastname').css('border', '1px solid #c3c3c3');
        $('#email').css('border', '1px solid #c3c3c3');
        $('#company-name').css('border', '1px solid #c3c3c3');
        $('#profile-link').css('border', '1px solid #c3c3c3');


                $(".recipient-form").hide();

                $("#loader").show();
        localStorage.setItem("stage", "recipients");

                setTimeout(function () {
                    $("#loader").hide();
                    recipientForm();
                }, 1000)
    })

    $(".paper").click(function () {
            $(this).toggleClass("activated");
            $(this).addClass("selected");
            var pos = $(".paper").index(this);

            console.log(pos)
            var classList;

            if (pos == 0) {
              classList = $(".paper").eq(1).attr("class");
              if (classList += "activated"){
                  $(".paper").eq(1).removeClass("activated");
                  $(".paper").eq(1).removeClass("selected");
              }
            }

        if (pos == 1) {
            classList = $(".paper").eq(0).attr("class");
            if (classList += "activated"){
                $(".paper").eq(0).removeClass("activated");
                $(".paper").eq(0).removeClass("selected");
            }
        }
    })

    $("#spec-button").click(function () {
        $(".display-error").text("");

       if($(".selected").text() == ""){
           $(".display-error").text("Please select a paper orientation");
       }else{
           paper_type = $(".selected").text();
           localStorage.setItem("paper_type", paper_type);
           material = $("#material").val();
           localStorage.setItem("material", material);
           localStorage.setItem("stage", "letter");

           $(".spec-selector").hide();

           $("#loader").show();

           setTimeout(function () {
                $("#loader").hide();

                letterTyping();
           }, 1500)
       }
    })

    $(".ql-formats").eq(0).before("<h2 class='tool-header'>Tools</h2>")

    $("#letter-submit").click(function () {
        $(".display-error").text("");

        if($("#editor").text() == ""){
            $(".display-error").text("Please type a letter");
        }else{
                letter = quill.root.innerHTML
                console.log(letter)
                localStorage.setItem("letter", letter);
                localStorage.setItem("stage", "finishing");

                $(".letter-typer").hide();
                $("#loader").show();

                setTimeout(function () {
                    $("#loader").hide();

                    finalDetails();
                }, 1500)
        }
    })

    $("#back-to-options").click(function () {
            $(".recipient-form").hide();
            localStorage.setItem("stage", "starter");
            showOptions();
    })

    $("#back-to-previous").click(function () {
            $(".spec-selector").hide();

            if (localStorage.getItem("previous") == "starter"){
                localStorage.setItem("stage", "starter");
                showOptions()
            }

        if (localStorage.getItem("previous") == "recipients"){
            localStorage.setItem("stage", "recipients");
            recipientForm();
        }
    });

    $("#back-to-specs").click(function () {
        $(".letter-typer").hide();
        localStorage.setItem("stage", "specs");
        selectSpecs();
    })

    $("#back-to-letter").click(function () {
        $(".final-details").hide();
        localStorage.setItem("stage", "letter");
        letterTyping();
    })

    $("#final-submit").click(function () {
        var envelope_cover = $("#envelope-cover").val();
        var envelope_message = $("#envelope-message").val();

        console.log(localStorage.getItem("recipient"))
        console.log(JSON.parse(localStorage.getItem("array")))
        console.log(localStorage.getItem("paper_type"))
        console.log(localStorage.getItem("material"))
        console.log(localStorage.getItem("letter"))
        console.log(envelope_cover)
        console.log(envelope_message)

        var reciever = localStorage.getItem("recipient"), recipients = JSON.parse(localStorage.getItem("array")),
            paper_type = localStorage.getItem("paper_type"), material = localStorage.getItem("material"),
            letter = localStorage.getItem("letter");

        $(".display-error").text("");

        $.ajax({
                url: "create_letter.php",
                type: "POST",
                data: {
                    reciever: reciever,
                    recipients: recipients,
                    paper_type: paper_type,
                    material: material,
                    letter: letter,
                    envelope_cover: envelope_cover,
                    envelope_message: envelope_message
                },
                success: function (response) {
                    console.log(response)
                    if (response.error) {
                        $(".display-error").text("Error creating delivery order. Please try again");
                    }

                    if (response.failure) {
                        $(".display-error").text("Error creating letter. Please try again");
                    }

                        if (response.success){
                            $(".final-details").hide();

                            $("#loader").show();

                            localStorage.removeItem("array")
                            localStorage.removeItem("index")
                            localStorage.removeItem("stage")

                            setTimeout(function () {
                            $("#loader").hide();

                                $("#success").show();
                            },  1500)
                        }
                }
            })
    })
});

function showOptions() {
    $(".header").show();
}

function recipientForm() {
    $("#back-to-options").show();
    $(".recipient-form").show();
    console.log(recipient);
}

function selectSpecs() {
    $("#back-to-previous").show();
    $(".spec-selector").show();
}

function letterTyping() {
    $("#back-to-specs").show();
    $(".letter-typer").show();
}

function finalDetails() {
    $("#back-to-letter").show()
    $(".final-details").show();
}