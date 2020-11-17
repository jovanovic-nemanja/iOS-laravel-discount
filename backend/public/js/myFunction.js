$(function() {
    "use strict";

    $('.submit_discount_h').click(function() {
        var title1 = $('.title1').val();
        var title2 = $('.title2').val();
        var title3 = $('.title3').val();
        var description1 = $('.description1').val();
        var description2 = $('.description2').val();
        var description3 = $('.description3').val();

        if (!((title1 && description1) || (title2 && description2) || (title3 && description3)))
        {
            Notificationsystem();
            return;
        }

        $('.submit_discount').click();
    });
});

function Notificationsystem() {
    $.toast({
        heading: 'Error',
        text: "Please confirm a title and description. It's required fields.",
        position: String("top-right"),
        icon: 'error',
        stack: false,
        loaderBg: '#f96868'
    });
}
