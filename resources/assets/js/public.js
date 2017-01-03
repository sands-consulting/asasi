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
$(window).resize(function(){
  if ($(window).width() >= 800){  
    var heights = $(".row-eq-height .eq-element").map(function() {
      return $(this).height();
    }).get()
    var maxHeight = Math.max.apply(null, heights);
    $(".row-eq-height .eq-element").height(maxHeight);
  } 
});

$("#demo3").bootstrapNews({
  newsPerPage: 1,
  autoplay: true,
  navigation:false,
  
  onToDo: function () {
    //console.log(this);
  }
});
