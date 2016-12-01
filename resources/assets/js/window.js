$(function() {
  $('.loading').hide();
  $('.content').fadeIn('slow', function() {
    $(this).css('visibility', 'visible');
  });

  sidebarState = localStorage['sidebarState'];

  if(sidebarState == 'xs')
  {
    $('body').addClass('sidebar-xs');
  }
});

// Equal Height
var heights = $(".row-eq-height .eq-element").map(function() {
  return $(this).height();
}).get()
var maxHeight = Math.max.apply(null, heights);
$(".row-eq-height .eq-element").height(maxHeight);