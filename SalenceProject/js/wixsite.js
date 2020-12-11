$(document).ready(function () {
       $(".links").click(function () {
          var indicator = $(this).find("span");

          if (indicator.text() == "+") {
              indicator.text("");
              indicator.append('<i class="fas fa-minus"></i>')
          }else {
              indicator.text("+");
          }
                $(this).find(".inner-link").toggle();
       })

    $(".close").click(function () {
            $('#modal-box').hide();
    })

    $('#toggler').click(function () {
        $('#modal-box').toggle();
    });
})