document.addEventListener("DOMContentLoaded", function () {
    $('.reply-link').on('click', function(e) {
        // console.log(e);
        // console.log(this);

        console.log();
        let form = $(this).siblings('form').toggle(400);

        $('form').not($(form)).hide(200);

        return false;
    });

    $('.card').hover(function(e) {
        $(this).find('a.card-link').slideDown(200, 'linear');
    }, function (e) {
        $(this).find('a.card-link').slideUp(200, 'linear');
    });
});
