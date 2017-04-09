$(function () {
    $('.loading').hide();
    $('.content').fadeIn('slow', function () {
        $(this).css('visibility', 'visible');
    });

    sidebarState = localStorage['sidebarState'];

    if (sidebarState == 'xs') {
        $('body').addClass('sidebar-xs');
    }

    $('.sidebar-main-toggle').click(function () {
        if ($('body').hasClass('sidebar-xs')) {
            localStorage['sidebarState'] = 'xs';
        } else {
            delete localStorage['sidebarState'];
        }
    });

    Vue.config.debug = true;

    // Equal Height
    var heights = $(".row-eq-height .eq-element").map(function () {
        return $(this).height();
    }).get()
    var maxHeight = Math.max.apply(null, heights);
    $(".row-eq-height .eq-element").height(maxHeight);
});