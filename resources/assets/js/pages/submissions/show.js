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
    this.submission_id = $(this.$el).data('submission');
    this.getNotice();
    this.loading = true;
  },
  methods: {
    getNotice: function () {
      var self = this;
      axios.get('/api/vendor-submissions/' + this.submission_id + '/notice')
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
    getFormUrl: function (details, exists) {
      let formUrl = window.location.href + '/details/' + details + '/edit';
      return formUrl;
      // return exists ? formUrl + '/edit' : formUrl + '/create';
    }
  }
});