$(function () {
    /* ChartJS
     * -------
     * Data and config for chartjs
     */

    //var cookies = document.cookie.split(';').map(function(el){ return el.split('='); }).reduce(function(prev,cur){ prev[cur[0]] = cur[1];return prev },{});
    var cookies;

    function readCookie(name,c,C,i){
        if(cookies){ return cookies[name]; }

        c = document.cookie.split('; ');
        cookies = {};

        for(i=c.length-1; i>=0; i--){
            C = c[i].split('=');
            cookies[C[0]] = C[1];
        }
        return cookies[name];
    }

    window.readCookie = readCookie; // or expose it however you want
    var month = readCookie('CookMonth');
    var lastYear = readCookie('CookLastYear');
    var week = readCookie('CookWeek');
    var saleToday = readCookie('saleToday');
    var sale1 = readCookie('sale1');
    var sale2 = readCookie('sale2');
    var sale3 = readCookie('sale3');
    var sale4 = readCookie('sale4');
    var sale5 = readCookie('sale5');

    var data = {
        labels: ["J-J", "J-1", "J-2", "J-3", "J-4", "J-5"],
        datasets: [{
            label: 'Sales of the last six days in €',
            data: [saleToday,sale1, sale2, sale3, sale4, sale5],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };
    var options = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    };
    var doughnutData ={
      datasets: [{
        data: [week, month, lastYear],
        backgroundColor: ['#d9534f','#36a2eb','#5cb85c']
      }],

      // These labels appear in the legend and in the tooltips when hovering different arcs
      labels: [
          'Week',
          'Month',
          'Last Year'
      ]
    };
    var doughnutOptions = {
      responsive: true,
      animation: {
          animateScale: true,
          animateRotate: true
      }
    };

    var areaData = {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            fill: 'origin',      // 0: fill to 'origin'
            fill: '+2',          // 1: fill to dataset 3
            fill: 1,             // 2: fill to dataset 1
            fill: false,         // 3: no fill
            fill: '-2'          // 4: fill to dataset 2
        }]
    };

    var areaOptions = {
        plugins: {
            filler: {
                propagate: true
            }
        }
    }
    // Get context with jQuery - using jQuery's .get() method.
    if($("#barChart").length) {
      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      // This will get the first returned node in the jQuery collection.
      var barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: data,
        options: options
      });
    }

    if($("#lineChart").length) {
      var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
      var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: data,
        options: options
      });
    }

    if($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'doughnut',
        data: doughnutData,
        options: doughnutOptions
      });
    }

    if($("#areaChart").length) {
      var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
      var areaChart = new Chart(areaChartCanvas, {
        type:'line',
        data: areaData,
        options: areaOptions
      });
    }

  });
