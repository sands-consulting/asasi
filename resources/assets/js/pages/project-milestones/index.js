var vm = new Vue({
  el: '#project-milestones',
  data: {
    gantt: {},
    tasks: null
  },
  mounted: function () {
    this.initialize()
  },
  methods: {
    initialize: function () {
      self = this;
      axios.get('/api/projects/1/milestones/gantt-tasks')
        .then(response => {
          this.gantt = Gantt('#gantt', response.data);
        });
    },
    view_mode: function (mode) {
      this.gantt.change_view_mode(mode);
    }
  }
})