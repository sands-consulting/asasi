$(function () {
    // Area chart
    // ------------------------------

    // Generate chart
    var area_chart = c3.generate({
        bindto: '#c3-area-chart',
        size: { height: 300 },
        point: {
            r: 4
        },
        color: {
            pattern: ['#f39c12']
        },
        data: {
            x: 'label',
            url: '/api/dashboard/chart-login-activity',
            mimeType: 'json',
            types: {
                logins: 'area-spline'
            }
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%d/%m'
                }
            }
        },
        grid: {
            y: {
                show: true
            }
        }
    });
});

new Vue({
    el: '.datatable-filter',
    data: {
        data_table: 'dataTableBuilder',
        table: null,
        url: null,
        panel_color: 'bg-slate-300',
        border_color: 'border-top-primary',
        active: null
    },
    mounted: function () {
        this.table = $(this.$el).data('data-table') || window.LaravelDataTables[this.data_table];
        this.url = this.table.ajax.url() || '';
    },
    methods: {
        perform_filter: function (e) {
            var target = e.currentTarget;
            var filter = $(target).data('filter');

            this.table.ajax.url(this.url + '?filter=' + filter).load();
            this.table.draw();
            this.$nextTick(function () {
                this.active = filter;
            })
        },
        change_header_color: function (e) {
            var color = $(e.currentTarget).data('color');
            this.panel_color = 'bg-' + color;
        },
        change_border_color: function (e) {
            var color = $(e.currentTarget).data('color');
            this.border_color = 'border-top-' + color;
        },
        handle_allocation: function (e) {
            this.perform_filter(e);
            this.change_header_color(e);
        },
        handle_dashboard: function (e) {
            this.perform_filter(e);
            this.change_border_color(e);
        }
    }
});