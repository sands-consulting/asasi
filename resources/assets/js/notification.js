$(function () {
  // Vue.config.debug = true;
  let vm_notifications = new Vue({
    el: '#notifications',
    data: {
      notifications: [],
      url: null,
      userId: null,
    },
    mounted: function (ev) {
      this.url = $(this.$el).data('url');
      this.userId = $(this.$el).data('user-id');
      this.populate();
      this.listen();
    },
    methods: {
      populate() {
        axios.get(this.url)
          .then(response => {
            this.notifications = [];
            for(var i = 0; i < response.data.length; i++) {
              notification = response.data[i];
              notification.created_at = moment(notification.created_at);
              this.notifications.push(notification);
            }
          });
      },
      listen() {
        Echo.private('App.User.' + this.userId)
          .notification((notification) => {
            this.populate();
          });
      },
      read(notificationId) {
        axios.put(this.url + '/' + notificationId + '/read', null)
        .then(response => {
            this.populate();
          })
          .catch(error => {
            console.log(error);
          });
      }
    }
  });
});
