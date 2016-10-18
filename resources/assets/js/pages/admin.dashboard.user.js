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
      pattern: ['#E53935', '#3949AB']
    },
    data: {
      x: 'label',
      url: '/api/dashboard/chart-login-activity',
      mimeType: 'json',
      types: {
        data: 'area-spline'
      }
    },
    axis: {
      x: {
        type: 'timeseries',
        tick: {
          format: '%d/%m/%Y'
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