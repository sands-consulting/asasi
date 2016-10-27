$(function() {
  // Styled checkboxes, radios
  $('.styled, .multiselect-container input').uniform({
    radioClass: 'choice',
    wrapperClass: 'border-primary text-primary'
  });
  // Styled file input
  // $('.file-styled').uniform({
  //     fileButtonClass: 'action btn bg-warning-400'
  // });
  
  $('.daterange-single').daterangepicker({ 
    singleDatePicker: true,
    locale: {
      cancelLabel: 'Clear',
      format: 'YYYY-MM-DD'
    }
  }); 
});

// Equal Height
// var heights = $(".row-eq-height .media-box").map(function() {
// return $(this).height();
// }).get()
// var maxHeight = Math.max.apply(null, heights);
// $(".row-eq-height .media-box").height(maxHeight);