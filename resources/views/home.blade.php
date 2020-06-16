@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">CPU Traffic</span>
            <span class="info-box-number">
              10
              <small>%</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Likes</span>
            <span class="info-box-number">41,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Sales</span>
            <span class="info-box-number">760</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">New Members</span>
            <span class="info-box-number">2,000</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly Deliveries Report</h5>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <div class="btn-group">
                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                  <i class="fas fa-wrench"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right" role="menu">
                  <a href="#" class="dropdown-item">Action</a>
                  <a href="#" class="dropdown-item">Another action</a>
                  <a href="#" class="dropdown-item">Something else here</a>
                  <a class="dropdown-divider"></a>
                  <a href="#" class="dropdown-item">Separated link</a>
                </div>
              </div>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <div id="chartContainer" style="height: 250px; width: 100%;"></div>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4 mt-4">
                <p class="text-center">
                  <strong>Deliveries Report</strong>
                </p>

                <div class="progress-group">
                  Total Deliveries
                  <span class="float-right"><b>160</b>/200</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->

                <div class="progress-group">
                  Rejected Deliveries
                  <span class="float-right"><b>310</b>/400</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                  </div>
                </div>

                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Completed Deliveries</span>
                  <span class="float-right"><b>480</b>/800</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 60%"></div>
                  </div>
                </div>

                <!-- /.progress-group -->
                <div class="progress-group">
                  Inprogress Deliveries
                  <span class="float-right"><b>250</b>/500</span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: 50%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                  <h5 class="description-header">$35,210.43</h5>
                  <span class="description-text">TOTAL REVENUE</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                  <h5 class="description-header">$10,390.90</h5>
                  <span class="description-text">TOTAL COST</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                  <h5 class="description-header">$24,813.53</h5>
                  <span class="description-text">TOTAL PROFIT</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block">
                  <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                  <h5 class="description-header">1200</h5>
                  <span class="description-text">GOAL COMPLETIONS</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <!-- MAP & BOX PANE -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Latest Riders</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-danger">
                Click Here to view 4 Riders
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>

            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="d-md-flex">
              <div class="p-1 flex-fill" style="overflow: hidden">
                <!-- Map will be created here -->
                <div id="world-map-markers">
                  <div class="map"></div>
                </div>
              </div>
              <div class="card-footer text-center">
                View All riders
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>

      </div>
      <div class="col-md-4">
        <!-- Info Boxes Style 2 -->
        <div class="info-box mb-3 bg-warning">
          <span class="info-box-icon"><i class="fas fa-tag"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Inventory</span>
            <span class="info-box-number">5,200</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        <div class="info-box mb-3 bg-success">
          <span class="info-box-icon"><i class="far fa-heart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Mentions</span>
            <span class="info-box-number">92,050</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </div>
    <!-- TABLE: LATEST ORDERS -->

    <!--/. container-fluid -->
</section>
<!-- /.content -->


@endsection
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    var chart = new CanvasJS.Chart("chartContainer", {
      data: [{
          type: "column",
          dataPoints: [{
              label: "Jan",
              y: 266.21
            },
            {
              label: "Feb",
              y: 302.25
            },
            {
              label: "March",
              y: 157.20
            },
            {
              label: "April",
              y: 148.77
            },
            {
              label: "May",
              y: 101.50
            },
            {
              label: "June",
              y: 97.8
            }
          ]
        },

        {
          type: "column",
          dataPoints: [{
              label: "Jan",
              y: 10.46
            },
            {
              label: "Feb",
              y: 2.27
            },
            {
              label: "March",
              y: 3.99
            },
            {
              label: "April",
              y: 4.45
            },
            {
              label: "May",
              y: 2.92
            },
            {
              label: "June",
              y: 3.1
            }
          ]
        },
        {
          type: "column",
          dataPoints: [{
              label: "Jan",
              y: 10.46
            },
            {
              label: "Feb",
              y: 2.27
            },
            {
              label: "March",
              y: 3.99
            },
            {
              label: "April",
              y: 4.45
            },
            {
              label: "May",
              y: 2.92
            },
            {
              label: "June",
              y: 3.1
            }
          ]
        },
      ]
    });
    chart.render();

  });
</script>