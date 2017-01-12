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