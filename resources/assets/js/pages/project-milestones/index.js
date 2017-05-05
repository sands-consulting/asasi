var vm = new Vue({
  el: '#project-milestones',
  data: {
    gantt: {},
    tasks: null
  },
  mounted: function () {
    this.initialize()
  },
  filters: {
    // 
  },
  methods: {
    initialize: function () {
      var self = this
      axios.get('/api/projects/1/milestones/gantt-tasks')
        .then(response => {
          this.gantt = Gantt('#gantt', response.data, {
            on_click: function (task) {
              console.log(task);
            },
            on_date_change: function(task, start, end) {
              task.start = start.format('YYYY-MM-DD');
              task.end = end.subtract(1, 'days').format('YYYY-MM-DD');
              task.duration = moment.duration(end.add(1, 'days').diff(start)).asDays();

              console.log(task, start, end);

              var data = {
                start: task.start,
                end: task.end,
                duration: task.duration,
              }
              self.updateTask(task.id, data);
            },
            on_progress_change: function(task, progress) {
              var data = {
                progress: progress
              }
              self.updateTask(task.id, data)
            },
            on_view_change: function(mode) {
              console.log(mode);
            }
          })
              console.log(this.gantt.tasks);
        })
    },
    updateTask: function (id, data) {
      axios.put('/api/projects/1/milestones/update-task', {
        id: id,
        data: data
      }).then(response => {
        console.log(response)
      }).catch(error => {
        console.log(error)
      })
    },
    updateRating: function (rate, taskId) {
      axios.put('/api/projects/1/milestones/update-rating', {
        id: taskId,
        ratings: rate
      }).then(response => {
        console.log(response)
      }).catch(error => {
        console.log(error)
      })
    },
    getRated: function (n, ratings) {
      return (n <= ratings) ? 'icon-star-full2' : 'icon-star-empty3'
    },
    view_mode: function (mode) {
      this.gantt.change_view_mode(mode)
    },

  }
})