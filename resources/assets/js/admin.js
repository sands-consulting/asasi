$(function () {
    $('.loading').hide();
    $('.content').fadeIn('slow', function () {
        $(this).css('visibility', 'visible');
    });

    sidebarState = localStorage['sidebarState'];

    if (sidebarState == 'xs') {
        $('body').addClass('sidebar-xs');
    }

    $('.sidebar-main-toggle').click(function () {
        if ($('body').hasClass('sidebar-xs')) {
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
            can_search: function () {
                is_searching = false;
                for (var key in this.q) {
                    if (!this.q.hasOwnProperty(key)) {
                        continue;
                    }
                    is_searching = is_searching || this.q[key].length > 0;
                }
                return is_searching;
            },
            params: function () {
                return $.param({q: this.$get('q')});
            }
        },
        mounted: function () {
            this.table = $(this.$el).data('data-table') || window.LaravelDataTables[this.data_table];
            this.url = this.table.ajax.url() || '';
        },
        methods: {
            perform_search: function () {
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
            },
            perform_filter: function (e) {
                var filter = $(e.currentTarget).data('filter');
                var color = $(e.currentTarget).data('color');
                this.table.ajax.url(this.url + '?filter=' + filter).load();
                this.table.draw();
                this.panel_color = 'bg-' + color;
            },
        }
    });
});

// Equal Height
var heights = $(".row-eq-height .eq-element").map(function () {
    return $(this).height();
}).get()
var maxHeight = Math.max.apply(null, heights);
$(".row-eq-height .eq-element").height(maxHeight);