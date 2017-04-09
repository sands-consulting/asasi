$(function() {
  if( $('.form-datatable-search').length > 0 ) {
    vmDataTableSearch = new Vue({
      el: '.form-datatable-search',
      data: {
        data_table: 'dataTableBuilder',
        q: {
          keywords: '',
          role: '',
          status: ''
        },
        table: null,
        url: null,
        searching: false,
        panel_color: 'bg-slate-300',
      },
      computed: {
        can_search: function () {
          is_searching = false;
          for (var key in this.q) {
            if (!this.q.hasOwnProperty(key)) {
              continue;
            }
            is_searching = key.length > 0;
          }
          return is_searching;
        },
        params: function () {
          return $.param({q: this.q});
        }
      },
      mounted: function () {
        this.table = $(this.$el).data('data-table') || window.LaravelDataTables[this.data_table];
        this.url = this.table.ajax.url() || '';
      },
      methods: {
        perform_search: function () {
          this.param = $.param({q: this.q});
          if (this.can_search) {
            this.table.ajax.url(this.url + '?' + this.params).load();
            this.table.draw();
            this.searching = true;
          }
        },
        clear_search: function () {
          if (this.searching) {
            this.table.ajax.url('').load();
            this.table.draw();
            this.searching = false;

            for (var key in this.q) {
              if (!this.q.hasOwnProperty(key)) {
                continue;
              }
              this.q[key] = ""
            }
            $(this.$el).find('select').each(function () {
              $(this).find('option:first').attr('selected', 'selected');
            });
          }
        }
      }
    });
  }
});