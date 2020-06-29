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
							<div
								class="text-xs font-weight-bold text-uppercase mb-1">Total Rides
								(Monthly)</div>
							<div class="h5 mb-0 font-weight-bold text-light-800">767</div>
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
							<div
								class="text-xs font-weight-bold  text-uppercase mb-1">Total Earning
								(Monthly)</div>
							<div class="h5 mb-0 font-weight-bold text-light-800">$215,000</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card shadow h-100 py-2"  style="background:linear-gradient(to right, #ff976a 40%, #ffc1a3 75%); border-radius: 0px; color: white;">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col-auto">
							<i class="fas fa-cart-arrow-down fa-2x text-light-300"></i>
						</div>
                                            <div class="col ml-5">
							<div
								class="text-xs font-weight-bold text-uppercase mb-1">Orders Completed</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-light-800">85%</div>
								</div>
								<div class="col">
									<div class="progress progress-sm ml-1">
										<div class="progress-bar bg-light" role="progressbar"
											style="width: 85%" aria-valuenow="50" aria-valuemin="0"
											aria-valuemax="100"></div>
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
							<div
								class="text-xs font-weight-bold text-uppercase mb-1">Pending
								Orders</div>
							<div class="h5 mb-0 font-weight-bold text-light-800">18</div>
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
				<div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #FF976A">
                                    <h6 class="m-0 font-weight-bold text-white">Earnings Overview</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink">
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
				<div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background:  linear-gradient(to right, #ff6d00 30%, #ffb278 85%);">
					<h6 class="m-0 font-weight-bold text-white">Orders Summary</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink1">
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
						<canvas id="myPieChart"></canvas>
					</div>
					<div class="mt-4 text-center small">
						<span class="mr-2"> <i class="fas fa-circle text-primary"></i>
							Completed
						</span> <span class="mr-2"> <i class="fas fa-circle text-danger"></i>
							Rejected
						</span> <span class="mr-2"> <i class="fas fa-circle text-info"></i>
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
				<div
					class="card-header py-3 d-flex bg-success flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-white">Order Details</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink2">
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
				<div
					class="card-header py-3 bg-secondary d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-white">Menu Categories</h6>
					<div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink3">
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
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink">
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
						Low Carb Angus Burger <span class="float-right">26</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-danger" role="progressbar"
							style="width: 12%" aria-valuenow="12" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Crispy Curls Fries <span class="float-right">229</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-success" role="progressbar"
							style="width: 76%" aria-valuenow="76" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Super Star Chicken Fillet <span class="float-right">196</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-primary" role="progressbar" style="width: 65%"
							aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Jalapeno Burger <span class="float-right">115</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-warning" role="progressbar"
							style="width: 40%" aria-valuenow="40" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
                                        <h4 class="small font-weight-bold">
						Mushroom N Swiss Burger <span class="float-right">149</span>
					</h4>
                                    <div class="progress" style="margin-bottom: 1.5rem">
						<div class="progress-bar bg-warning" role="progressbar"
							style="width: 50%" aria-valuenow="50" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Super Star Burger <span class="float-right">269</span>
					</h4>
                                    <div class="progress" style="margin-bottom: 1.5rem">
						<div class="progress-bar bg-success" role="progressbar"
							style="width: 90%" aria-valuenow="90" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Classic Angus Thickburger <span class="float-right">50</span>
					</h4>
					<div class="progress">
						<div class="progress-bar bg-secondary" role="progressbar"
							style="width: 25%" aria-valuenow="25" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					
				</div>
			</div>
                </div>
                <div class="col-sm-6">
			<div class="card shadow mb-4">
				<div class="card-header bg-warning py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold" style="color: black">Hardees Branches</h6>
                                        <div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-dark-400"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink">
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
						M.M Alam <span class="float-right">536535</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-success" role="progressbar"
							style="width: 89%" aria-valuenow="89" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees DHA <span class="float-right">212352</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-primary" role="progressbar"
							style="width: 60%" aria-valuenow="60" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees Emporium Mall <span class="float-right">196550</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-warning" role="progressbar" style="width: 35%"
							aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees MOG <span class="float-right">96000</span>
					</h4>
					<div class="progress mb-4">
						<div class="progress-bar bg-danger" role="progressbar"
							style="width: 20%" aria-valuenow="20" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
                                        <h4 class="small font-weight-bold">
						Hardees Lalik Chowk <span class="float-right">256100</span>
					</h4>
                                    <div class="progress" style="margin-bottom: 1.5rem">
						<div class="progress-bar bg-info" role="progressbar"
							style="width: 50%" aria-valuenow="50" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees F7 Islamabad <span class="float-right">156700</span>
					</h4>
                                    <div class="progress" style="margin-bottom: 1.5rem">
						<div class="progress-bar bg-info" role="progressbar"
							style="width: 45%" aria-valuenow="45" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees Thokar Niaz Baig <span class="float-right">235650</span>
					</h4>
                                    <div class="progress" style="margin-bottom: 1.5rem">
						<div class="progress-bar bg-primary" role="progressbar"
							style="width: 68%" aria-valuenow="68" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees Faisalabad <span class="float-right">135000</span>
					</h4>
                                    <div class="progress" style="margin-bottom: 1.5rem">
						<div class="progress-bar bg-warning" role="progressbar"
							style="width: 35%" aria-valuenow="35" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees Fazal Center <span class="float-right">156700</span>
					</h4>
                                    <div class="progress" style="margin-bottom: 1.5rem">
						<div class="progress-bar bg-info" role="progressbar"
							style="width: 45%" aria-valuenow="45" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					<h4 class="small font-weight-bold">
						Hardees Guldasht Colony Multan <span class="float-right">132550</span>
					</h4>
					<div class="progress">
						<div class="progress-bar bg-warning" role="progressbar"
							style="width: 29%" aria-valuenow="29" aria-valuemin="0"
							aria-valuemax="100"></div>
					</div>
					
				</div>
			</div>
                </div>
        </div>

			
	</div>

<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection
    
