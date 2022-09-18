$('.cate-item').isotope({
    itemSelector: '.item',
    layoutMode: 'fitRows'
});

$('.cate-list ul li').click(function () {
    $('.cate-list ul li').removeClass('active');
    $(this).addClass('active');
    var selector = $(this).attr('data-filters');
    $('.cate-item').isotope({
        filter: selector
    });
})