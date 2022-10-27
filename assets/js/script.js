
$(function () {
    /* SCROLLSPY */
    $(".navbar a, footer a").on("click", function (event) {
        event.preventDefault();
        var hash = this.hash;

        $("body,html").animate({ scrollTop: $(hash).offset().top }, 900, () => {
            window.location.hash = hash;
        });
    });

    /* AJAX */
    $('#contact-form').submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();

        $.ajax({
            type: 'POST',
            url: 'contact.php',
            data: postdata,
            dataType: 'json',
            success: function (result) {
                if (result.isSuccess) {
                    $('#contact-form').append("<p class='message'>merci, message bien envoyer</p>");
                    $('#contact-form')[0].reset();
                } else {
                    $("#firstname + .comments").html(result.firstnameE);
                    $("#lastname + .comments").html(result.lastnameE);
                    $("#email + .comments").html(result.emailE);
                    $("#phone + .comments").html(result.phoneE);
                    $("#message + .comments").html(result.messageE);
                    $('#contact-form')[0].reset();
                }
            }
        })
    });

});
