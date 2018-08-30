document.addEventListener("DOMContentLoaded", function () {
    var $ = window.jQuery;

    $('.reply-link').on('click', function() {
        // console.log(e);
        // console.log(this);

        console.log();
        let form = $(this).siblings('form').toggle(400);

        $('form').not($(form)).hide(200);

        return false;
    });

    $('.card').hover(function() {
        $(this).find('a.card-link').slideDown(200, 'linear');
    }, function () {
        $(this).find('a.card-link').slideUp(200, 'linear');
    });
});
