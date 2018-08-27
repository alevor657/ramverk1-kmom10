document.addEventListener("DOMContentLoaded", function () {
    $('.reply-link').on('click', function(e) {
        // console.log(e);
        // console.log(this);

        console.log();
        $(this).siblings('form').toggle(400);



        return false;
    });
});
