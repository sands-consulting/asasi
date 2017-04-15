const vm = new Vue({
  el: '#submission-wrapper',
  data: {
    completed: false,
    can_submit: false,
    notice: {},
    submission: {},
    loading: false,
    submitted: false
  },
  mounted: function () {
    this.getNotice();
    this.loading = true;
  },
  methods: {
    getNotice: function () {
      var self = this;
      axios.get('/api/vendor-submissions/' + 1 + '/notice')
        .then(function (response) {
          console.log(response.data);
          self.loading = false;
          self.notice = response.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getDetailStatus: function () {
      return this.submission.details
    },
    getFormUrl: function (type, exists) {
      let formUrl = window.location.href + '/details/' + type;
      return exists ? formUrl + '/edit' : formUrl + '/create';
    }
  }
});