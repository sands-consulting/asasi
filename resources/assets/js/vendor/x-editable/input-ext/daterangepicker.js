//daterange picker for x-editable
(function ($) {
  "use strict";

  var DateRange = function (options) {
    this.init('daterange', options, DateRange.defaults);
    this.initPicker(options, DateRange.defaults);
  };

  //kendo datetime picker for x-editable
  $.fn.editableutils.inherit(DateRange, $.fn.editabletypes.abstractinput);

  $.extend(DateRange.prototype, {
    initPicker: function(options, defaults) {
        //'format' is set directly from settings or data-* attributes

        //by default viewformat equals to format
        // if(!this.options.viewformat) {
        //     this.options.viewformat = this.options.format;
        // }
        
        //try parse daterangepicker config defined as json string in data-daterangepicker
        options.daterangepicker = $.fn.editableutils.tryParseJson(options.daterangepicker, true);

        //overriding daterangepicker config (as by default jQuery extend() is not recursive)
        //since 1.4 daterangepicker internally uses viewformat instead of format. Format is for submit only
        this.options.daterangepicker = $.extend({}, defaults.daterangepicker, options.daterangepicker);

        //store DPglobal
        // this.dpg = $.fn.daterangepicker.DPGlobal; 

        //store parsed formats
        // this.parsedFormat = this.dpg.parseFormat(this.options.format, this.options.formatType);
        // this.parsedViewFormat = this.dpg.parseFormat(this.options.viewformat, this.options.formatType);
    },
    render: function () {

        this.$input = this.$tpl.find('input');;
        this.$input.daterangepicker(this.options.daterangepicker);
        this.$input.prop("readonly", true);

        //"clear" link
        // if(this.options.clear) {
        //     this.$clear = $('<a href="#"></a>').html(this.options.clear).click($.proxy(function(e){
        //         e.preventDefault();
        //         e.stopPropagation();
        //         this.clear();
        //     }, this));

        //     this.$tpl.parent().append($('<div class="editable-clear">').append(this.$clear));  
        // }
    },

    value2html: function(value, element) {
      if(!value) {
        $(element).empty();
        return; 
      }
      $(element).html(value); 
    },

    /**
     * Gets value from element's html
     *
     * @method html2value(html) 
     */
    html2value: function(html) {
      var value = html; 
      return value ? value : null;
    },

    value2str: function(value) {
      return value ? value: '';
      // console.log(value);

      // var str = '';
      // if(value) {
      //  for(var k in value) {
      //      str = str + k + ':' + value[k] + ';';  
      //  }
      // }
      // return str;
    },

    /*
     * Converts string to value. Used for reading value from 'data-value' attribute.
     * 
     * @method str2value(str)  
     */
    str2value: function(str) {
      /*
      this is mainly for parsing value defined in data-value attribute. 
      If you will always set value by javascript, no need to overwrite it
      */
      return str
    },

    value2submit: function(value) {
      return this.value2str(value + ':00');
    },

    value2input: function(value) {
      if(!value) {
        return;
      }
      this.$input.val(value);
    },

    /**
     * Returns value of input.
     *
     * @method input2value()
     */
    input2value: function() { 
      return this.$input.val();
    },

    activate: function() {
      // this.$input.focus();
    },

    /**
     * Attaches handler to submit form in case of 'showbuttons=false' mode
     * @method autosubmit() 
     */
    
    autosubmit: function() {
      // this.$input.on('mouseup', '.minute', function(e){
      //   var $form = $(this).closest('form');
      //   setTimeout(function() {
      //     $form.submit();
      //   }, 200);
      // });
      // this.$input.keydown(function (e) {
      //   if (e.which === 13) {
      //     $(this).closest('form').submit();
      //   }
      // });
    },

    //convert date from local to utc
    toUTC: function(value) {
      return value ? new Date(value.valueOf() - value.getTimezoneOffset() * 60000) : value;  
    },

    //convert date from utc to local
    fromUTC: function(value) {
      return value ? new Date(value.valueOf() + value.getTimezoneOffset() * 60000) : value;  
    },

    /*
     For incorrect date bootstrap-daterangepicker returns current date that is not suitable
     for datetimefield.
     This function returns null for incorrect date.  
    */
    parseDate: function(str, format) {
      var date = null, formattedBack;
      if(str) {
        date = this.dpg.parseDate(str, format, this.options.daterangepicker.language, this.options.formatType);
        if(typeof str === 'string') {
          formattedBack = this.dpg.formatDate(date, format, this.options.daterangepicker.language, this.options.formatType);
          if(str !== formattedBack) {
            date = null;
          } 
        }
      }
      return date;
    }
  });

  DateRange.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
    /**
    @property tpl 
    @default <div></div>
    **/         
    tpl:'<div class="editable-daterangepicker"><input class="form-control" /></div>',
    
    /**
     * @property inputclass 
     * @default null
     */         
    inputclass: null,

    /**
    Configuration of daterangepicker.
    Full list of options: https://github.com/smalot/bootstrap-daterangepicker

    @property daterangepicker 
    @type object
    @default { }
    **/
    daterangepicker:{
      /**
      Format used for sending value to server. Also applied when converting date from <code>data-value</code> attribute.<br>
      Possible tokens are: <code>d, dd, m, mm, yy, yyyy, h, i</code>  
      
      @property format 
      @type string
      @default yyyy-mm-dd hh:ii
      **/         
      locale: { 
        format:'YYYY-MM-DD HH:mm',
        separator: " - ",
        applyLabel: "Apply",
        cancelLabel: "Cancel",
        fromLabel: "From",
        toLabel: "To",
        customRangeLabel: "Custom",
        weekLabel: "W",
        daysOfWeek: [
           "Su",
           "Mo",
           "Tu",
           "We",
           "Th",
           "Fr",
           "Sa"
        ],
        monthNames: [
           "January",
           "February",
           "March",
           "April",
           "May",
           "June",
           "July",
           "August",
           "September",
           "October",
           "November",
           "December"
        ],
        firstDay: 1,
      }
    },
  });

  $.fn.editabletypes.daterange = DateRange;

}(window.jQuery));
