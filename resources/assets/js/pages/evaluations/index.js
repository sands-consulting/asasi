Vue.component('modal', {
  props: {
    evaluation: {
      type: Object
    },
    modalId: {
      type: String
    }
  },
  template: '#bs-modal',
  methods: {
    accept: function (id) {
      this.loading = true
      axios.put('/api/evaluations/accept', { id: id })
        .then(response => {
          vm.populate();
          $('.modal').modal('hide');
        })
        .catch(error => {
          console.log(error);
        });
      this.loading = false
    },
  }
});

let vm = new Vue({
  el: '#evaluation-wrapper',
  data: {
    loading: false,
    evaluations: [],
    url: null,
  },
  mounted() {
    this.url = $(this.$el).data('url');
    this.populate();
  },
  methods: {
    populate: function () {
      this.loading = true
      axios.get(this.url)
        .then(response => {
          this.evaluations = response.data
        })
        .catch(error => {
          console.log(error);
        });
      this.loading = false
    },
    confirmation: function (index) {
      this.$set(this.evaluations[index], 'confirm', true)
      console.log(this.evaluations[index]);
    },
    cancel: function (index) {
      this.$set(this.evaluations[index], 'confirm', false)
    },
    reject: function (id) {
      this.loading = true
      axios.put('/api/evaluations/reject', { id: id })
        .then(response => {
          this.populate();
        })
        .catch(error => {
          console.log(error);
        });
      this.loading = false
    },
    confirm: function (evaluation) {
      if (! evaluation.hasOwnProperty('confirm') 
        && evaluation.status !== 'pending') {
        return true;
      }

      return false;
    }
  }
});