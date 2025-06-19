$(document).ready(function() {
   var ctx = document.getElementById('newuserchartBar').getContext("2d");
   window.myDoughnut = new Chart(ctx, {
     type: "bar",
     data: dataGrafik(),
     options: { 
      maintainAspectRatio: false, 
      responsive: true, 
      legend: { position: "bottom", 
      labels: { usePointStyle: true  } },
      title: { display: true, text: "" }, 
      animation: { animateScale: true, animateRotate: true },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            callback: function(value, index, values) {
              return 'Rp. ' + parseInt(value).toLocaleString("id-ID");
            }
          }
        }]
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            return 'Rp. ' + parseInt(value).toLocaleString("id-ID");
          }

        }
      } 
    },
    });


   var ctx2 = document.getElementById('newuserchartBar2').getContext("2d");
   window.myDoughnut = new Chart(ctx2, {
    type: "bar",
    data: dataGrafik2(),
    options: { 
      maintainAspectRatio: false, 
      responsive: true, 
      legend: { position: "bottom", 
      labels: { usePointStyle: true  } },
      title: { display: true, text: "" }, 
      animation: { animateScale: true, animateRotate: true },
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            callback: function(value, index, values) {
              return 'Rp. ' + parseInt(value).toLocaleString("id-ID");
            }
          }
        }]
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            return 'Rp. ' + parseInt(value).toLocaleString("id-ID");
          }

        }
      } 
    },
  });

} );

