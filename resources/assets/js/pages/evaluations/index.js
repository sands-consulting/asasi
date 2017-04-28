
let vm = new Vue({
  el: '#evaluation-wrapper',
  data: {
    loading: false,
    action: null,
    confirm: false,
    evaluations: window.evaluations,
  },
  methods: {
    confirmation: function (action) {
      this.loading = true;
      // this.$set(this, 'loading', true);
      this.confirm = true;
      // this.$set(this, 'confirm', true);
      this.$set(this, 'action', action);
      this.loading = false;
    },
    confirmed: function (id, action) {
      if (action === 'accept')
        this.accept(id);
      else
        this.reject(id);
    },
    cancel: function () {
      this.confirm = false;
      this.action =  null;
    },
    accept: function (id) {
      axios.post('/api/evaluations/accept', { id: id })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    reject: function (id) {
      axios.post('/api/evaluations/reject', { id: id })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
});