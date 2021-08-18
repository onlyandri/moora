// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Bisnis Digital", "Sistem Informasi", "Mobile Application", "Creative Advertising", "Teknik Informatika",
             "Rekayasa Sistem Informasi", "Digital Marketing", "Sistem Informasi Akuntasi"],
    datasets: [{
      label: "Mahasiswa",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [3, 10, 20, 15, 15, 15, 15, 25, 15],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'Pilihan Program'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 6
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 500,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
