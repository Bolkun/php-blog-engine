// Zoom image on click
$('.zoom').css({cursor: 'pointer'}).on('click', function () {
    var img = $(this);
    var bigImg = $('<img />').css({
        'position': 'fixed',
        'top': '50%',
        'left': '50%',
        'transform': 'translate(-50%, -50%)',
        'max-width': '100%',
        'max-height': '100%',
        'display': 'inline'
    });
    bigImg.attr({
        src: img.attr('src'),
        alt: img.attr('alt'),
        title: img.attr('title')
    });
    var over = $('<div />').text(' ').css({
        'height': '100%',
        'width': '100%',
        'background': 'rgba(0,0,0,.82)',
        'position': 'fixed',
        'top': 0,
        'left': 0,
        'right': 0,
        'bottom': 0,
        'opacity': 0.0,
        'cursor': 'pointer',
        'z-index': 9999,
        'text-align': 'center'
    }).append(bigImg).bind('click', function () {
        $(this).fadeOut(300, function () {
            $(this).remove();
        });
    }).insertAfter(this).animate({
        'opacity': 1
    }, 300);
});