/* ------------------------------------------------------------------------------
*
*  # Stepy wizard
*
*  Specific JS code additions for wizard_stepy.html page
*
*  Version: 1.1
*  Latest update: Dec 25, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {
    // Override defaults
    $.fn.stepy.defaults.legend = false;
    $.fn.stepy.defaults.transition = 'fade';
    $.fn.stepy.defaults.duration = 150;
    $.fn.stepy.defaults.backLabel = '<i class="icon-arrow-left13 position-left"></i> Back';
    $.fn.stepy.defaults.nextLabel = 'Save & Next <i class="icon-arrow-right14 position-right"></i>';

    // Clickable titles
    $(".stepy-clickable").stepy({
        titleClick: true
    });

    //
    // Validation
    //

    // Initialize wizard
    $(".stepy-validation").stepy({
        titleClick: true,
        validate: true,
        block: true,
        back: function(index) {
            $.post('/api/notice')
        },
        next: function(index) {
            var form = $('#notice-form');
            var noticeInput = form.find(':input');
            
            if (!$(".stepy-validation").validate(validate)) {
                return false
            }

            switch(index) {
                case 2:
                    $.post('/api/notices/save', noticeInput)
                        .done(function(data) {
                            if (data.id && !$('#noticeId').val()) {
                                $('<input>').attr({
                                    type: 'hidden',
                                    id: 'noticeId',
                                    name: 'id',
                                    value: data.id
                                }).appendTo(form);

                            }
                            return true;
                        });
                    break;
                case 6:
                    var rulesInput = form.find('input[name^="rule"]')
                    $.post('/api/rules/store', rulesInput)
                        .done(function(data) {
                            return true;
                        });
                    break;
            }
        }
    });

    $(".stepy-validation-edit").stepy({
        titleClick: true,
        validate: true,
        block: true,
        back: function(index) {
            $.post('/api/notice')
        },
        next: function(index) {
            var form = $('#notice-form');
            var noticeInput = form.find(':input');
            
            if (!$(".stepy-validation-edit").validate(validate)) {
                return false
            }

            switch(index) {
                case 2:
                    var url = $(location).attr('href');
                    url = url.replace('/admin/', '/api/').replace('/edit', '/update');
                    console.log(url);
                    $.post(url, noticeInput)
                        .done(function(data) {
                            return true;
                        });
                    break;
                case 6:
                    var rulesInput = form.find('input[name^="rule"]')
                    $.post('/api/rules/store', rulesInput)
                        .done(function(data) {
                            return true;
                        });
                    break;
            }
        }
    });

    // Initialize validation
    var validate = {
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        // Different components require proper error label placement
        errorPlacement: function(error, element) {

            // Styled checkboxes, radios, bootstrap switch
            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }

            // Unstyled checkboxes, radios
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            // Input with icons and Select2
            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }

            // Inline checkboxes, radios
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }

            // Input group, styled file input
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        rules: {
            email: {
                email: true
            }
        }
    }



    // Initialize plugins
    // ------------------------------

    // Apply "Back" and "Next" button styling
    $('.stepy-step').find('.button-next').addClass('btn btn-primary');
    $('.stepy-step').find('.button-back').addClass('btn btn-default');


    // Select2 selects
    $('.select').select2();


    // Styled checkboxes and radios
    $('.styled').uniform({
        radioClass: 'choice'
    });


    // Styled file input
    $('.file-styled').uniform({
        fileButtonClass: 'action btn bg-blue'
    });

    // Editable
    // ------------------------------

    // Change defaults
    $.fn.editable.defaults.highlight = false;
    $.fn.editable.defaults.mode = 'popup';
    $.fn.editable.defaults.onblur = 'submit';
    $.fn.editableform.template = '<form class="editableform">' +
        '<div class="control-group">' +
        '<div class="editable-input"></div> <div class="editable-buttons"></div>' +
        '<div class="editable-error-block"></div>' +
        '</div> ' +
        '</form>';
    $.fn.editableform.buttons = 
        '<button type="submit" class="btn btn-info btn-icon editable-submit"><i class="icon-check"></i></button>' +
        '<button type="button" class="btn btn-default btn-icon editable-cancel"><i class="icon-x"></i></button>';

    // Switchery toggle
    $('.myeditable-switchery').on('shown', function (e, editable) {
        var elem = document.querySelector('.switcher-single');
        var init = new Switchery(elem);
    });
    
    /*
     * Commercial requirement table
     */
    
    // Initialize
    $('.myeditable').editable();

    //make username required
    $('#new-requirement').editable('option', 'validate', function(v) {
        if(!v) return 'Required field!';
    });
     
    //automatically show next editable
    $('.myeditable [data-type="switchery"]').on('save.newcommreq', function(){
        var that = this;
        setTimeout(function() {
            $(that).closest('tr').next().find('.myeditable').editable('show');
        }, 200);
    });

    //create new requirement
    $(document).on('click', '.btn-save', function() {
        var $btn_save = $(this);
        var notice_id = $('#noticeId').val();
        var tbl_id = $btn_save.data('table');
        var $tbl = $(tbl_id);

        $tbl.find('.myeditable').editable('submit', { 
            url: $btn_save.data('url'),
            data: {notice_id: notice_id},
            ajaxOptions: {
                dataType: 'json' //assuming json response
            },           
            success: function(data, config) {
                if(data && data.id) {  //record created, response like {"id": 2}
                   //set pk
                   $(this).editable('option', 'pk', data.id);
                   $btn_save.closest('tr').attr('data-id', data.id);
                   //remove unsaved class
                   $(this).removeClass('editable-unsaved');
                   //show messages
                   var msg = 'New commercial requirement created! Now editables submit individually.';
                   $('#msg').addClass('alert-success').removeClass('alert-error').html(msg).show();
                   $btn_save.hide();
                   $(this).off('save.newcommreq');                   
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


    $(document).on('click', '.btn-add', function () {
        var template = $(this).data('template');
        var cachedTemplate = cachedTemplate || $(template).html();
        var $tr = $(this).closest('tr');
        var $emptyTr = $tr.siblings('.table-empty');
        var $clone = $(cachedTemplate).clone();
        var $switchery = $clone.find('.switchery');
        var $tdAction = $clone.find('.action-column');
        var $myeditable = $clone.find('.myeditable');
        var $switchery = $clone.find('.myeditable-switchery');

        $tdAction.find('btn-remove').show();
        $emptyTr.hide();
        $tr.before($clone);

        $switchery.on('shown', function (e, editable) {
            editable.input.$input.addClass('switcher-single');

            var elem = document.querySelector('.switcher-single');
            var init = new Switchery(elem);
        });

        $myeditable.editable();
        // $myeditable.find('.btn-remove').show();
    })

    $(document).on('click', '.btn-remove', function (ev) {
        ev.preventDefault();
        var url = $(this).data('url');
        var $tr = $(this).closest('tr');
        var $emptyTr = $tr.siblings('.table-empty');
        var id = $tr.data('id');
        var row_left = $tr.siblings().length -1;

        if (id !== undefined) {
            $.post(url + id)
            .success( function() {
                $tr.remove();
            })
            .fail( function() {
                alert('Error occured.')
            })
        } else {
            $tr.remove();
        }

        if (row_left == 0) {
            $('.table-empty').show();
        }
    })

    // // Initialize plugin
    $('.myeditable-switchery').on('shown', function (e, editable) {
        var elem = document.querySelector('.switcher-single');
        var init = new Switchery(elem);
    });

    // Field Codes
    $(document).on('click', '.btn-add-rule', function() {
        var template = $(this).data('template');
        var cachedTemplate = cachedTemplate || $('#'+template).html();
        var clone = $(cachedTemplate).clone();
        var rules = $(this).parents('.row').siblings('.rules:last');
        var btn_add = $(this).parent().find('.btn-add-rule');
        var btn_remove = clone.find('.btn-remove-rule');

        rules.after(clone);

    })
    $(document).on('click', '.btn-remove-rule', function() {
        $(this).parents('.rules').remove();
    });
});
