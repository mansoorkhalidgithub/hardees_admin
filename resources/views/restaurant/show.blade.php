 @extends('layouts.main') @section('content')
 <style>
 	.table-bordered th {
 		border: 1px solid transparent;
 	}

 	.table-bordered tfoot tr td {
 		border: 1px solid transparent;
 	}
 </style>
 <div style="margin: 0px 10px 10px 10px">
 	<div class="card">
 		<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
 			<h3 style="color: black; font-family: serif; font-weight: bold">{{$model->name}}</h3>

 			<form action="{{ route('restaurant.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$model->name}}');" style="display: inline-block;">
 				@csrf
 				<input type="hidden" name="id" value="{{$model->id}}">
 				<button type="submit" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #dc3545; color: white" title="Delete">
 					Delete
 				</button>
 			</form>
 			<!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #dc3545; color: white">Delete</a> -->

 		</div>
 		<div class="card-body">
 			<div class="row" style="margin-bottom:2rem">
 				<div class="col-sm-12">
 					<table class="table-striped table-bordered abc" style="width:100%; font-size: 15px; color: black;">

 						<tbody>
 							<tr>
 								<td style="font-weight: bold">Name:</td>
 								<td>{{$model->name}}</td>
 							</tr>
 							<tr>
 								<td style="font-weight: bold">Address:</td>
 								<td>{{$model->address}}</td>
 							</tr>
 							<tr>
 								<td style="font-weight: bold">Status:</td>
 								<td>@if($model->status===1)Active @else In Active @endif</td>
 							</tr>
 						</tbody>

 					</table>
 				</div>


 			</div>
 			<div class="row" style="margin-bottom:1.5rem">

 				<!-- Earnings (Monthly) Card Example -->
 				<div class="col-xl-4 col-md-6 mb-4">
 					<div class="card shadow h-100 py-2" style="background: linear-gradient(to right, #ff6d00 30%, #ffb278 85%); border-radius: 0px; color: white">
 						<div class="card-body">
 							<div class="row no-gutters align-items-center">
 								<div class="col-auto">
 									<i class="fas fa-money-bill-alt fa-3x text-light-300"></i>
 								</div>
 								<div class="col ml-4">
 									<div class="text-xs font-weight-bold text-uppercase mb-1">HARDEES {{$model->name}} TODAY EARNING</div>
 									<div class="h5 mb-0 font-weight-bold text-light-800">RS:{{$today}}</div>
 								</div>

 							</div>
 						</div>
 					</div>
 				</div>

 				<!-- Earnings (Monthly) Card Example -->
 				<div class="col-xl-4 col-md-6 mb-4">
 					<div class="card shadow h-100 py-2" style="background: linear-gradient(to right, #ff6275 40%, #ff9caa 75%); border-radius: 0px; color: white;">
 						<div class="card-body">
 							<div class="row no-gutters align-items-center">
 								<div class="col-auto">
 									<i class="fas fa-dollar-sign fa-2x text-light-300"></i>
 								</div>
 								<div class="col ml-5">
 									<div class="text-xs font-weight-bold  text-uppercase mb-1">HARDEES {{$model->name}} WEEKLY EARNING</div>
 									<div class="h5 mb-0 font-weight-bold text-light-800">RS:{{$week}}</div>
 								</div>

 							</div>
 						</div>
 					</div>
 				</div>

 				<!-- Earnings (Monthly) Card Example -->
 				<div class="col-xl-4 col-md-6 mb-4">
 					<div class="card shadow h-100 py-2" style="background:linear-gradient(to right, #ff976a 40%, #ffc1a3 75%); border-radius: 0px; color: white;">
 						<div class="card-body">
 							<div class="row no-gutters align-items-center">
 								<div class="col-auto">
 									<i class="fas fa-dollar-sign fa-2x text-light-300"></i>
 								</div>
 								<div class="col ml-5">
 									<div class="text-xs font-weight-bold  text-uppercase mb-1">HARDEES {{$model->name}} Monthly EARNING</div>
 									<div class="h5 mb-0 font-weight-bold text-light-800">RS:{{$month}}</div>
 								</div>

 							</div>
 						</div>
 					</div>
 				</div>

 			</div>
 			<div class="row">
 				<marquee>
 					<p style="font-family: Impact; font-size: 18pt">Average Delivery Time In Current Week:
 						<span style="color:red" id="avg_delivery">{{$averageCompletionTime}}</span>
 					</p>
 				</marquee>
 			</div>
 			<hr>
 			<div class="row">
 				<div class="col-sm-12">
 					<div class="form-group">
 						<legend style="color: black; font-family: serif; font-weight: bold">HARDEES {{$model->name}} TOTAL EARNING: {{$total}}</legend>
 						<select id="schedule" name="schedule" style="border-radius: 0px" class="form-control">
 							<option selected>Select Schedule</option>
 							<option>Daily</option>
 							<option>Weekly</option>
 							<option>Monthly</option>
 						</select>
 					</div>
 				</div>
 			</div>
 			<div class="row">
 				<div class="col-xl-6 col-lg-6">
 					<div class="card shadow mb-4">
 						<!-- Card Header - Dropdown -->
 						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 							<h6 class="m-0 font-weight-bold text-primary">Hardees {{$model->name}} Earning</h6>

 						</div>
 						<!-- Card Body -->
 						<div class="card-body">
 							<div class="chart-pie pt-4 pb-2">
 								<canvas id="earningChart"></canvas>
 							</div>
 							<div class="mt-4 text-center small">
 								<span class="mr-2"> <i class="fas fa-circle text-primary"></i>
 									Previous
 								</span> <span class="mr-2"> <i class="fas fa-circle text-info"></i>
 									Current
 								</span>
 							</div>
 						</div>

 					</div>
 				</div>
 				<div class="col-xl-6 col-lg-6">
 					<div class="card shadow mb-4">
 						<!-- Card Header - Dropdown -->
 						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 							<h6 class="m-0 font-weight-bold text-primary">Hardees {{$model->name}} Rides</h6>

 						</div>
 						<!-- Card Body -->
 						<div class="card-body">
 							<div class="chart-pie pt-4 pb-2">
 								<canvas id="myPieChart"></canvas>
 							</div>
 							<div class="mt-4 text-center small">
 								<span class="mr-2"> <i class="fas fa-circle text-primary"></i>
 									Completed
 								</span> <span class="mr-2"> <i class="fas fa-circle text-info"></i>
 									InProgress
 								</span>
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 			<hr>
 			<div class="row" style="margin-top: 1rem">
 				<div class="col-sm-6">
 					<h1>Completed Rides</h1>
 					<div class="uper">
 						<table class="table table-striped table-bordered" id="restaurant_riders" style="width:100%; font-size: 15px; color: black;">
 							<thead>
 								<tr style="font-weight: bold; font-size: 18px; font-family: serif; background-color: white">
 									<th>#</th>
 									<th>Rider Name</th>
 									<th>Total Amount</th>
 									<th>Rider Status</th>
 								</tr>
 							</thead>
 							<tbody>
 								@foreach($rider as $key => $rider)
 								<tr>
 									<td>{{++$key}}</td>
 									<td>
 										<a href="{{route('rider.show', $rider->id)}}">
 											{{$rider->name}}
 										</a>
 									</td>
 									<td>{{$rider->RiderOrderCount*45}}</td>
 									<td>
 										<a type="button" class="btn {{$rider->getRiderStatus->online_status == 'online' ? 'btn-primary' : 'btn-danger'}}"> <span style="font-size: 12px; font-weight: bold;color:white">
 												{{$rider->getRiderStatus->online_status}}
 											</span>
 										</a>
 									</td>
 								</tr>
 								@endforeach

 							</tbody>

 						</table>
 					</div>
 				</div>
 				<div class="col-sm-6">
 					<h1>Forcefully Completed Rides</h1>
 					<div class="uper">
 						<table class="table table-striped table-bordered" id="riders" style="width:100%; font-size: 15px; color: black;">
 							<thead>
 								<tr style="font-weight: bold; font-size: 18px; font-family: serif; background-color: white">
 									<th>#</th>
 									<th>Rider Name</th>
 									<th>Total Amount</th>
 									<th>Rider Status</th>
 								</tr>
 							</thead>
 							<tbody>
 								@foreach($rider_1 as $key => $rider)
 								<tr>
 									<td>{{++$key}}</td>
 									<td>
 										<a href="{{route('rider.show', $rider->id)}}">
 											{{$rider->name}}
 										</a>
 									</td>
 									<td>{{App\OrderAssigned::where('rider_id',$rider->id)->where('trip_status_id',11)->count()*45}}</td>
 									<td>
 										<a type="button" class="btn {{$rider->getRiderStatus->online_status == 'online' ? 'btn-primary' : 'btn-danger'}}">
 											<span style="font-size: 12px; font-weight: bold;color:white">
 												{{$rider->getRiderStatus->online_status}}
 											</span>
 										</a>
 									</td>
 								</tr>
 								@endforeach

 							</tbody>

 						</table>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>

 </div>
 <script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



 <script>
 	$(document).ready(function() {
 		$.noConflict();
 		var table = $('#restaurant_riders').DataTable();
 		$('#riders').DataTable();
 		var ctx1 = document.getElementById("earningChart");
 		var earningChart = new Chart(ctx1, {
 			type: "doughnut",
 			data: {
 				labels: ["Previous", "Current"],
 				datasets: [{
 					data: [<?php echo $pre_month ?>, <?php echo $month ?>],
 					backgroundColor: ["#4e73df", "#1cc88a", "red"],
 					hoverBackgroundColor: ["#2e59d9", "#17a673", "red"],
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
 				cutoutPercentage: 50,
 			},
 		});
 		var ctx = document.getElementById("myPieChart");
 		var myPieChart = new Chart(ctx, {
 			type: "doughnut",
 			data: {
 				labels: ["Completed", "Inprogress"],
 				datasets: [{
 					data: [<?php echo $complete ?>, <?php echo $inprogress ?>],
 					backgroundColor: ["#4e73df", "#1cc88a", "red"],
 					hoverBackgroundColor: ["#2e59d9", "#17a673", "red"],
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
 				cutoutPercentage: 50,
 			},
 		});
 		$("#schedule").on("change", function(e) {
 			sch = $(this).val();
 			$.ajax({
 				url: "{{ route('branch.chart') }}",
 				type: 'POST',
 				dataType: 'json',
 				data: {
 					"id": "<?php echo $model->id; ?>",
 					"type": sch,
 					"_token": "{{ csrf_token() }}",
 				},
 				success: function(data) {
 					console.log(data)
 					$('#avg_delivery').text(data.averageCompletionTime);
 					myPieChart.data.datasets[0].data = data.data;
 					myPieChart.update();
 					earningChart.data.datasets[0].data = data.earning;
 					earningChart.update();
 				},
 				error: function(data) {
 					console.log(data);
 				}
 			});
 		});
 	});
 </script>

 @endsection