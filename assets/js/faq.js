$(document).ready(function () {
    $('.faq__item').click(function (event) {
        $('.faq__item').not(this).removeClass('faq__item--open').find('.faq__answer').slideUp(230);
        $(this).toggleClass('faq__item--open').find('.faq__answer').slideToggle(230);
    });
});
