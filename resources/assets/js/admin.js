$(window).load(function() {
    $('.sk-fading-circle').hide();
    $('.content').fadeIn('slow',function() {
      $(this).css('visibility', 'visible');
    })
});

$(function() {

	Vue.config.debug = true;

	vm_datatable_search = new Vue({
		el: '.form-datatable-search',
		data: {
      data_table: 'dataTableBuilder',
			q: {},
			table: null,
			url: null,
      searching: false
		},
		computed: {
			can_search: function() {
				is_searching = false;
				for(var key in this.q) {
					if(!this.q.hasOwnProperty(key)) {
						continue;
					}
					is_searching = is_searching || this.q[key].length > 0;
				}
				return is_searching;
			},
      params: function() {
        return $.param({q: this.$get('q')});
      }
		},
		ready: function() {
			this.table = $(this.$el).data('data-table') || window.LaravelDataTables[this.data_table];
			this.url = this.table.ajax.url() || '';
		},
		methods: {
			perform_search: function() {
        if(this.can_search) {
          this.table.ajax.url(this.url + '?' + this.params).load();
          this.table.draw();
          this.searching = true;
        }
			},
      clear_search: function() {
        if(this.searching) {
          this.table.ajax.url('').load();
          this.table.draw();
          this.searching = false;

          for(var key in this.q) {
            if(!this.q.hasOwnProperty(key)) {
            	continue;
            }
            this.q[key] = ""
          }
          $(this.$el).find('select').each(function() {
            $(this).find('option:first').attr('selected', 'selected');
          });
        }
      }
		}
  });
});

// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})
