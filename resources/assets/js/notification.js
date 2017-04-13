$(function () {
  // Vue.config.debug = true;
  let vm_notifications = new Vue({
    el: '#notifications',
    data: {
      notifications: [],
      count: null,
      source: null,
      user: null
    },
    mounted: function (ev) {
      this.source = $(this.$el).data('source');
      // fixme: find better solution to get user object
      this.user = $(this.$el).data('user');
      this.getNotification();
      this.listen();
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
        let self = this;
        // use variable instead of hardcode for url.
        axios.put('/api/notifications/read', {
          id: notificationId
        })
          .then(function (response) {
            console.log(response);
            self.getNotification();
          })
          .catch(function (error) {
            console.log(error);
          });
      },
      listen() {
        Echo.private('App.User.' + this.user.id)
          .notification((notification) => {
            this.getNotification();
          });
      }
    }
  });
});
