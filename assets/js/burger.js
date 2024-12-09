$(document).ready(function () {
    $('.header__burger').on('click', function () {
        $('.header__group').toggleClass('active');
        $('.header__burger').toggleClass('active');
        $('.overflow__full').toggleClass('active');
        $('body').toggleClass('overflow-hidden');
    });
    $('.header__language').click(function () {
        $('.header__language-popup').slideToggle(300);
        $('.header__language-arrow').toggleClass('open');
    });
});
