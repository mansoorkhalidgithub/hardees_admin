@extends('layouts.main')
@section('content')
<style>
  #myChart {
    height: 25%;
    width: 100%;
  }

  .zc-ref {
    display: none;
  }
</style>
<!-- Begin Page Content -->
<div style="margin: 0px 10px 10px 10px">

  <!-- Page Heading -->
  <!--div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#"
      class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i
      class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div-->

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card shadow h-100 py-2" style="background: linear-gradient(to right, #ff6d00 30%, #ffb278 85%); border-radius: 0px; color: white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <i class="fas fa-car fa-2x text-light-300"></i>
            </div>
            <div class="col ml-5">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Deliveries
              </div>
              <div id="total" class="h5 mb-0 font-weight-bold text-light-800"></div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card shadow h-100 py-2" style="background: linear-gradient(to right, #ff6275 40%, #ff9caa 75%); border-radius: 0px; color: white;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-light-300"></i>
            </div>
            <div class="col ml-5">
              <div class="text-xs font-weight-bold  text-uppercase mb-1">Total Earning
              </div>
              <div id="totalEarning" class="h5 mb-0 font-weight-bold text-light-800">Rs:</div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="{{route('delivery.complete')}}" style="text-decoration: none">
        <div class="card shadow h-100 py-2" style="background:linear-gradient(to right, #ff976a 40%, #ffc1a3 75%); border-radius: 0px; color: white;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <i class="fas fa-cart-arrow-down fa-2x text-light-300"></i>
              </div>
              <div class="col ml-5">
                <div id="completeOrder" class="text-xs font-weight-bold text-uppercase mb-1">Orders Completed</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div id="complete" class="h5 mb-0 mr-3 font-weight-bold text-light-800"></div>
                  </div>
                  <div class="col">
                    <div class="progress progress-sm ml-1">
                      <div id="completeOrderBar" class="progress-bar bg-red" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <a href="{{route('delivery.progress')}}" style="text-decoration: none">
        <div class="card shadow h-100 py-2" style="background:linear-gradient(to right, #10c888 40%, #58dfb6 75%); border-radius: 0px; color: white;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <i class="fas fa-cart-plus fa-2x text-light-300"></i>
              </div>
              <div class="col ml-5">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Inprogress Orders</div>
                <div id="progress" class="h5 mb-0 font-weight-bold text-light-800"></div>
              </div>

            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="row">
    <marquee>
      <p style="font-family: Impact; font-size: 18pt">Average Delivery Time In Current Week:
        <span style="color:red" id="avg_delivery"></span>
      </p>
    </marquee>
  </div>
  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #FF976A">
          <h6 class="m-0 font-weight-bold text-white">Earnings Overview</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Yesterday</a>
              <a class="dropdown-item" href="#">Last 7 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last 3 Month</a>
              <a class="dropdown-item" href="#">Last 6 Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <div style="height: 280px; width: 100%;" id="earning_chart"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background:  linear-gradient(to right, #ff6d00 30%, #ffb278 85%);">
          <h6 class="m-0 font-weight-bold text-white">Orders Summary</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink1">
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Yesterday</a>
              <a class="dropdown-item" href="#">Last 7 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last 3 Month</a>
              <a class="dropdown-item" href="#">Last 6 Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="order_summary"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2"> <i class="fas fa-circle text-warning"></i>
              Completed
            </span>
            <span class="mr-2" data-toggle="tooltip"> <i class="fas fa-circle text-success"></i>
              InProgress
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex bg-success flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-white">Order Details</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink2">
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Yesterday</a>
              <a class="dropdown-item" href="#">Last 7 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last 3 Month</a>
              <a class="dropdown-item" href="#">Last 6 Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div id="order-detail" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 bg-secondary d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-white">Order Types</h6>

        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div id="pyramid-chart" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div id='myChart'><a class="zc-ref" href="https://www.zingchart.com/">Charts by ZingChart</a></div>
  </div>
  <hr>
  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-sm-6">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header bg-info py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-white">Menu Items</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Yesterday</a>
              <a class="dropdown-item" href="#">Last 7 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last 3 Month</a>
              <a class="dropdown-item" href="#">Last 6 Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body" id="live_menu_data">

        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card shadow mb-4">
        <div class="card-header bg-warning py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold" style="color: black">Hardees Branches</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-dark-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="#">Today</a>
              <a class="dropdown-item" href="#">Yesterday</a>
              <a class="dropdown-item" href="#">Last 7 Days</a>
              <a class="dropdown-item" href="#">Last Month</a>
              <a class="dropdown-item" href="#">Last 3 Month</a>
              <a class="dropdown-item" href="#">Last 6 Month</a>
              <a class="dropdown-item" href="#">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body" id="live_branch_data">

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $.noConflict();
    var ctx = document.getElementById("order_summary");
    var order_summary = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: ["Inprogress", "Completed"],
        datasets: [{
          data: [],
          backgroundColor: ["#1cc88a", "#fcbd12", ],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }, ],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: "#dddfeb",
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false,
        },
        cutoutPercentage: 70,
      },
    });

    var chart = new CanvasJS.Chart("pyramid-chart", {

      animationEnabled: true,
      data: [{
        type: "pyramid",
        //valueRepresents: "area",
        indexLabelFontSize: 15,
        indexLabelFontFamily: "Lucida",
        dataPoints: [
          <?php foreach ($data as $item) { ?> {
              y: <?php echo $item->total ?>,
              indexLabel: "<?php echo $item->name ?>"
            },
          <?php } ?>
        ]
      }]
    });
    chart.render();

    var updateChart = function() {
      $.ajax({
        url: "{{ route('api.chart') }}",
        type: 'post',
        dataType: 'json',
        data: {
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
          $('#avg_delivery').text(data.averageCompletionTime);
          $('#completeOrder').text('Complete Orders (' + data.data[1] + ')');
          $('#progress').text(data.data[0]);
          $('#total').text(data.totalOrders);
          $('#totalEarning').text('Rs : ' + data.totalEarning);
          $('#complete').text(data.completeOrders + ' %');
          $('#completeOrderbar').width(100);
          $('#live_menu_data').html(data.html)
          $('#live_branch_data').html(data.branchHtml)
          order_summary.data.datasets[0].data = data.data;
          order_summary.update();
        },
        error: function(data) {
          console.log(data);
        }
      });
    }

    updateChart();
    setInterval(() => {
      updateChart();
    }, 10000);
    var updateDailySale = function() {
      var dataPoints = [];

      var options = {
        // animationEnabled: true,
        theme: "light",
        axisX: {
          valueFormatString: "DD",
        },
        axisY: {
          title: "RS",
          titleFontSize: 24,
          includeZero: false
        },
        data: [{
          type: "spline",
          dataPoints: dataPoints
        }]
      };

      function addData(data) {
        // console.log(data)
        for (var i = 0; i < data.length; i++) {
          dataPoints.push({
            x: new Date(data[i].day),
            y: data[i].total
          });
        }
        $("#earning_chart").CanvasJSChart(options);
      }
      $.getJSON("{{env('APP_URL')}}/jsonobj", addData)
    }
    updateDailySale();
    setInterval(() => {

      updateDailySale();
    }, 10000);

    var order_detail = new CanvasJS.Chart("order-detail", {
      axisX: {
        valueFormatString: "YYYY",
        interval: 1,
        intervalType: "month",
      },

      data: [{
          type: "stackedBar",
          legendText: "WEB",
          showInLegend: "true",
          dataPoints: [{
              x: new Date(2012, 01, 1),
              y: 71
            },
            {
              x: new Date(2012, 02, 1),
              y: 55
            },
            {
              x: new Date(2012, 03, 1),
              y: 50
            },
            {
              x: new Date(2012, 04, 1),
              y: 65
            },
            {
              x: new Date(2012, 05, 1),
              y: 95
            },
          ],
        },
        {
          type: "stackedBar",
          legendText: "UAN",
          showInLegend: "true",
          dataPoints: [{
              x: new Date(2012, 01, 1),
              y: 71
            },
            {
              x: new Date(2012, 02, 1),
              y: 55
            },
            {
              x: new Date(2012, 03, 1),
              y: 50
            },
            {
              x: new Date(2012, 04, 1),
              y: 65
            },
            {
              x: new Date(2012, 05, 1),
              y: 95
            },
          ],
        },
      ],
    });

    order_detail.render();
  });
</script>

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>