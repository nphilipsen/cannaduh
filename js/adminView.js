$('.content-area').hide();
$('.content-area[data-link="orders"]').fadeIn({width: '200px'}, 300);

$('.link').click(function() {
    $('.content-area').hide();
    $('.content-area[data-link=' + $(this).data('link') + ']').fadeIn({
        width: '200px'
    }, 300);
});
