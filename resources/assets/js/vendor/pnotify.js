$(function() {

  window.flash ={
    opts: {
      width: "100%",
      cornerclass: "no-border-radius",
      stack: {
        dir1: "down",
        dir2: "right",
        push: "top",
        spacing1: 1
      }
    },
    notice: function(text) {
      return this.show($.extend(this.opts, {text: text, addclass: "stack-custom-top bg-success"}));
    },
    alert: function(text) {
      return this.show($.extend(this.opts, {text: text, addclass: "stack-custom-top bg-danger"}));
    },
    show: function(opts) {
      return (new PNotify(opts));
    }
  };

});
