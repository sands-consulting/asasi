$(function() {    
  //create new requirement
  $(document).on('click', '#evaluations-btn-save', function() {
      var $btnSave = $(this);
      var url = $btnSave.data('url');

      $('.myeditable').editable('submit', { 
        url: url, 
        ajaxOptions: {
            dataType: 'json' //assuming json response
        },           
        success: function(data, config) {
            if(data && data.data) {  //record created, response like {"id": 2}
                // Fixme: try to replace editable field data
                // $.each(data.data, function(index, value) {
                //   var row = $(document).find('#row-' + value.submission_detail_id);

                //   //set pk
                //   row.find('.editable').editable('option', 'pk', value.id);
                //   //remove unsaved class
                //   row.removeClass('editable-unsaved');
                // });
                location.reload();
                //show messages
                // var msg = 'New user created! Now editables submit individually.';
                // $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
                // $('#save-btn').hide(); 
                // $(this).off('save.newuser');                     
            } else if(data && data.errors){ 
                //server-side validation error, response like {"errors": {"username": "username already exist"} }
                config.error.call(this, data.errors);
            }               
        },
        error: function(errors) {
            var msg = '';
            if(errors && errors.responseText) { //ajax error, errors = xhr object
                msg = errors.responseText;
            } else { //validation error (client-side or server-side)
                $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
            } 
            $('#msg').removeClass('alert-success').addClass('alert-error').html(msg).show();
        }
    });
      
  });
});