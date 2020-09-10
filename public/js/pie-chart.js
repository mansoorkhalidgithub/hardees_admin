
  window.onload = function () {
    var chart = new CanvasJS.Chart("pie-chart",
    {
      

      axisX: {
        valueFormatString: "MMM",
        interval: 1,
        intervalType: "month"
      },

      data: [
      {
        type: "stackedBar",
        legendText: "Delivery",
        showInLegend: "true",
        dataPoints: [
        { x: new Date(2012, 01, 1), y: 71 },
        { x: new Date(2012, 02, 1), y: 55},
        { x: new Date(2012, 03, 1), y: 50 },
        { x: new Date(2012, 04, 1), y: 65 },
        { x: new Date(2012, 05, 1), y: 95 }

        ]
      },
        {
        type: "stackedBar",
        legendText: "Takeaway",
        showInLegend: "true",
        dataPoints: [
        { x: new Date(2012, 01, 1), y: 71 },
        { x: new Date(2012, 02, 1), y: 55},
        { x: new Date(2012, 03, 1), y: 50 },
        { x: new Date(2012, 04, 1), y: 65 },
        { x: new Date(2012, 05, 1), y: 95 }

        ]
      },
        {
        type: "stackedBar",
        legendText: "PickUp",
        showInLegend: "true",
        dataPoints: [
        { x: new Date(2012, 01, 1), y: 20 },
        { x: new Date(2012, 02, 1), y: 35},
        { x: new Date(2012, 03, 1), y: 30 },
        { x: new Date(2012, 04, 1), y: 45 },
        { x: new Date(2012, 05, 1), y: 25 }

        ]
      }

      ]
    });

    chart.render();
  }
 