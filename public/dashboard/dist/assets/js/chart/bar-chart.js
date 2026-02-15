// bar chart 1
var options_bar_chart_1 = {
    chart: {
      height: 350,
      type: 'bar'
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        endingShape: 'rounded'
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#28a745', '#007bff', '#17c1e8'],
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    series: [
      {
        name: 'Top-up',
        data: window.chartData.topup
      },
      {
        name: 'Menabung',
        data: window.chartData.menabung
      },
      {
        name: 'Penarikan',
        data: window.chartData.penarikan
      }
    ],
    xaxis: {
      categories: window.chartData.bulan
    },
    fill: {
      opacity: 1
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val.toLocaleString();
        }
      }
    }
  };
  
  var chart_bar_chart_1 = new ApexCharts(document.querySelector("#bar-chart-1"), options_bar_chart_1);
  chart_bar_chart_1.render();