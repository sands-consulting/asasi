$(function() {
  $('.loading').hide();
  $('.content').fadeIn('slow', function() {
    $(this).css('visibility', 'visible');
  });

  sidebarState = localStorage['sidebarState'];

  if(sidebarState == 'xs')
  {
    $('body').addClass('sidebar-xs');
  }

  $('.sidebar-main-toggle').click(function(){
    if($('body').hasClass('sidebar-xs')) {
      localStorage['sidebarState'] = 'xs';
    } else {
      delete localStorage['sidebarState'];
    }
  });

	Vue.config.debug = true;

	vm_datatable_search = new Vue({
		el: '.form-datatable-search',
		data: {
      data_table: 'dataTableBuilder',
			q: {},
			table: null,
			url: null,
      searching: false,
      panel_color: 'bg-slate-300'
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
      },
      perform_filter: function(e) {
          var filter = $(e.currentTarget).data('filter');
          var color = $(e.currentTarget).data('color');
          this.table.ajax.url(this.url + '?filter=' + filter).load();
          this.table.draw();
          this.panel_color = 'bg-' + color;
      },
		}
  });

  vm_datatable_filter = new Vue({
    el: '.datatable-filter',
    data: {
      data_table: 'dataTableBuilder',
      table: null,
      url: null,
      panel_color: 'bg-slate-300',
      border_color: 'border-top-primary',
      active: null
    },
    ready: function() {
      this.table = $(this.$el).data('data-table') || window.LaravelDataTables[this.data_table];
      this.url = this.table.ajax.url() || '';
    },
    methods: {
      perform_filter: function(e) {
          var target = e.currentTarget;
          var filter = $(target).data('filter');

          this.table.ajax.url(this.url + '?filter=' + filter).load();
          this.table.draw();
          this.$nextTick( function() {
            this.active = filter;
          })
      },
      change_header_color: function(e) {
          var color = $(e.currentTarget).data('color');
          this.panel_color = 'bg-' + color;
      },
      change_border_color: function(e) {
          var color = $(e.currentTarget).data('color');
          this.border_color = 'border-top-' + color;
      },
      handle_allocation: function(e) {
        this.perform_filter(e);
        this.change_header_color(e);
      },
      handle_dashboard: function (e) {
        this.perform_filter(e);
        this.change_border_color(e);
      }
    }
  });

  // socket
  // var socket = io('http://prompt.dev:3000');
  vm_notifications = new Vue({
      el: '#notifications',
      data: {
        notifications: [],
        count: null
      },
      ready: function(ev) {
        this.fetchData($(this.$el).data('source'));

      },
      methods: {
        fetchData: function (apiURL) {
          var self = this;
          $.get( apiURL, function( data ) {
            console.log(apiURL);
            self.notifications = data;
            self.count = data.length;
          });
        }
      }
  });
});

// Equal Height
var heights = $(".row-eq-height .eq-element").map(function() {
  return $(this).height();
}).get()
var maxHeight = Math.max.apply(null, heights);
$(".row-eq-height .eq-element").height(maxHeight);

// Javascript to enable link to tab
// var url = document.location.toString();
// if (url.match('#')) {
//     $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
// } 

// // Change hash for page-reload
// $('.nav-tabs a').on('shown.bs.tab', function (e) {
//     e.preventDefault();
//     window.location.hash = e.target.hash;
// })
