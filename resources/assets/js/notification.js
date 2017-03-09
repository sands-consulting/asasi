$(function () {
  var url = $('meta[name="socket-url"]').attr('content');
  var socket = io(url);
  Vue.config.debug = true;
  vm_notifications = new Vue({
      el: '#notifications',
      data: {
        notifications: [],
        count: null,
        source: null
      },
      mounted: function(ev) {
        this.source = $(this.$el).data('source');
        this.listen();
        this.getNotification();
        
      },
      methods: {
        getNotification() {
          this.$http.get(this.source)
            .then(response => {
              this.notifications = response.data;
              this.count = response.data.length;
          });
        },

        listen() {
          socket.on('notifications', function() {
            this.getNotification(this.source);
          }.bind(this));  
        }
      }
  });
});
