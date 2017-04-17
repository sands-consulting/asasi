$(function () {
  // Area chart
  // ------------------------------

  // Generate chart
  var bar_chart = c3.generate({
    bindto: '#c3-bar-chart',
    size: {height: 300},
    point: {
      r: 4
    },
    data: {
      x: 'label',
      url: '/api/dashboard/chart-vendor-status',
      mimeType: 'json',
      types: {
        vendors: 'bar'
      }
    },
    bar: {
      width: {
        ratio: 0.5 // this makes bar width 50% of length between ticks
      }
      // or
      //width: 100 // this makes bar width 100px
    },
    axis: {
      x: {
        type: 'category',
      }
    },
    grid: {
      y: {
        show: true
      }
    }
  });
});

// Todo: Make datatable header to change color upon filter
// new Vue({
//   el: '.datatable-filter',
//   data: {
//     data_table: 'dataTableBuilder',
//     table: null,
//     url: null,
//     panel_color: 'bg-slate-300',
//     border_color: 'border-top-primary',
//     active: null
//   },
//   mounted: function () {
//     this.table = $(this.$el).data('data-table') || window.LaravelDataTables[this.data_table];
//     this.url = this.table.ajax.url() || '';
//   },
//   methods: {
//     perform_filter: function (e) {
//       var target = e.currentTarget;
//       var filter = $(target).data('filter');
//
//       this.table.ajax.url(this.url + '?filter=' + filter).load();
//       this.table.draw();
//       this.$nextTick(function () {
//         this.active = filter;
//       })
//     },
//     change_header_color: function (e) {
//       var color = $(e.currentTarget).data('color');
//       this.panel_color = 'bg-' + color;
//     },
//     change_border_color: function (e) {
//       var color = $(e.currentTarget).data('color');
//       this.border_color = 'border-top-' + color;
//     },
//     handle_allocation: function (e) {
//       this.perform_filter(e);
//       this.change_header_color(e);
//     },
//     handle_dashboard: function (e) {
//       this.perform_filter(e);
//       this.change_border_color(e);
//     }
//   }
// });