$(function() {
  if( $('#form-settings').length > 0 ) {
    const vmSetting = new Vue({
      el: '#form-settings',
      data: {
        settings: [],
        placeholder: {
          key: '',
          value: '',
        }
      },
      methods: {
        initialize: function() {
          if('settings' in window) {
            for (var i = window.settings.length - 1; i >= 0; i--) {
              this.settings.push(window.settings[i]);
            }
          }
        },
        addSetting: function() {
          this.settings.push(this.placeholder)
        },
        deleteSetting: function(index) {
          this.settings.splice(index, 1);
        }
      },
      mounted: function() {
        this.initialize();
      },
    });
  }
});
