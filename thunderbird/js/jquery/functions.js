$(document).ready(function($) {
    
    // jQuery easing, don't want to add the whole easing plugin
    $.extend( $.easing, {
        easeOutExpo: function (x, t, b, c, d) {
            return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
        },
    });
     
    //size content
    $(window).bind('load resize', function() {
        var w = $(window).height();
        $('.column2').css({ 'min-height' : (w-224) });
    });
    
    $('.contentBody ul').hide();
    
    $('.toggle').click(function() {
        $(this).parent().toggleClass('open');
        $(this).siblings('ul').slideToggle(400, "easeOutExpo")
    });
    
});