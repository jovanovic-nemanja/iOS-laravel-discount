$(function() {
    "use strict";

    $('.submit_discount_h').click(function() {
        var title1 = $('.title').val();
        var description1 = $('.description').val();

        if (!title1 || !description1)
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
