<?php

use App\OrderAssigned;
use App\Helpers\Helper;
?>
@extends('layouts.main')
@section('content')

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
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
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
    </div>
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
            <canvas id="myAreaChart"></canvas>
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
            <span class="mr-2"> <i class="fas fa-circle text-success"></i>
              Completed
            </span>
            <span class="mr-2" data-toggle="tooltip" title="<?php echo "12" ?>"> <i class="fas fa-circle text-warning"></i>
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
          <div id="pie-chart" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 bg-secondary d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-white">Menu Categories</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink3">
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
          <div id="pyramid-chart" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </div>

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
        <div class="card-body">
          <h4 class="small font-weight-bold">
            M.M Alam <span class="float-right">53653</span>
          </h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-success" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees DHA <span class="float-right">212352</span>
          </h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees Emporium Mall <span class="float-right">196550</span>
          </h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees MOG <span class="float-right">96000</span>
          </h4>
          <div class="progress mb-4">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees Lalik Chowk <span class="float-right">256100</span>
          </h4>
          <div class="progress" style="margin-bottom: 1.5rem">
            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees F7 Islamabad <span class="float-right">156700</span>
          </h4>
          <div class="progress" style="margin-bottom: 1.5rem">
            <div class="progress-bar bg-info" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees Thokar Niaz Baig <span class="float-right">235650</span>
          </h4>
          <div class="progress" style="margin-bottom: 1.5rem">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees Faisalabad <span class="float-right">135000</span>
          </h4>
          <div class="progress" style="margin-bottom: 1.5rem">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees Fazal Center <span class="float-right">156700</span>
          </h4>
          <div class="progress" style="margin-bottom: 1.5rem">
            <div class="progress-bar bg-info" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <h4 class="small font-weight-bold">
            Hardees Guldasht Colony Multan <span class="float-right">132550</span>
          </h4>
          <div class="progress">
            <div class="progress-bar bg-warning" role="progressbar" style="width: 29%" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

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
        labels: ["Completed", "Inprogress"],
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
        type: 'POST',
        dataType: 'json',
        data: {
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
          console.log(data.data[0])
          completeOrder
          $('#completeOrder').text('Complete Orders (' + data.data[0] + ')');
          $('#progress').text(data.data[1]);
          $('#total').text(data.totalOrders);
          $('#totalEarning').text('Rs : ' + data.totalEarning);
          $('#complete').text(data.completeOrders + ' %');
          $('#completeOrderbar').width(15);
          $('#live_menu_data').html(data.html)
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

  });
</script>