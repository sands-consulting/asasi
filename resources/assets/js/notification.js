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
    mounted: function (ev) {
      this.source = $(this.$el).data('source');
      this.listen();
      this.getNotification();

    },
    methods: {
      getNotification() {
        axios.get(this.source, {
          params: {
            status: 'unread',
          }
        })
          .then(response => {
            this.notifications = response.data;
            this.count = response.data.length;
          });
      },
      read(notificationId) {
        // use variable instead of hardcode for url.
        axios.put('/api/notifications/read', {
          id: notificationId
        })
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      listen() {
        socket.on('notifications', function () {
          this.getNotification(this.source);
        }.bind(this));
      }
    }
  });
});
