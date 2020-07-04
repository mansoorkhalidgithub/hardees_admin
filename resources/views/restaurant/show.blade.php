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
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
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
 	<hr>
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
 							<div class="text-xs font-weight-bold text-uppercase mb-1">HARDEES DHA TODAY EARNING</div>
 							<div class="h5 mb-0 font-weight-bold text-light-800">767</div>
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
 							<div class="text-xs font-weight-bold  text-uppercase mb-1">HARDEES DHA WEEKLY EARNING</div>
 							<div class="h5 mb-0 font-weight-bold text-light-800">$215,000</div>
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
 							<div class="text-xs font-weight-bold  text-uppercase mb-1">HARDEES DHA YEARLY EARNING</div>
 							<div class="h5 mb-0 font-weight-bold text-light-800">$215,000</div>
 						</div>

 					</div>
 				</div>
 			</div>
 		</div>

 	</div>
 	<hr>
 	<div class="row">
 		<div class="col-sm-12">
 			<div class="form-group">
 				<legend style="color: black; font-family: serif; font-weight: bold">HARDEES DHA TOTAL EARNING: 213296</legend>
 				<select id="schedule" name="schedule" style="border-radius: 0px" class="form-control">
 					<option>Select Schedule</option>
 					<option>Daily</option>
 					<option>Weekly</option>
 					<option>Yearly</option>
 				</select>
 			</div>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-xl-6 col-lg-6">
 			<div class="card shadow mb-4">
 				<!-- Card Header - Dropdown -->
 				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 					<h6 class="m-0 font-weight-bold text-primary">Hardees DHA Total Earning</h6>
 					<!--div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a> <a
								class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div-->
 				</div>
 				<!-- Card Body -->
 				<div class="card-body">
 					<div class="chart-area">
 						<canvas id="myAreaChart"></canvas>
 					</div>
 				</div>

 			</div>
 		</div>
 		<div class="col-xl-6 col-lg-6">
 			<div class="card shadow mb-4">
 				<!-- Card Header - Dropdown -->
 				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
 					<h6 class="m-0 font-weight-bold text-primary">Hardees DHA Total Rides</h6>
 					<!--div class="dropdown no-arrow">
						<a class="dropdown-toggle" href="#" role="button"
							id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false"> <i
							class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
							aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Dropdown Header:</div>
							<a class="dropdown-item" href="#">Action</a> <a
								class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div-->
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
 	<hr>
 	<div class="row" style="margin-top: 1rem">
 		<div class="col-sm-12">
 			<div class="uper">
 				<table class="table table-striped table-bordered" id="restaurant_riders" style="width:100%; font-size: 15px; color: black;">
 					<thead>
 						<tr style="font-weight: bold; font-size: 18px; font-family: serif; background-color: white">
 							<th>#</th>
 							<th>Rider Name</th>
 							<th>Booking No</th>
 							<th>Total Amount</th>
 						</tr>
 					</thead>
 					<tbody>
 						<tr>
 							<td>1</td>
 							<td>Sharukh Zahid</td>
 							<td>Hardees001842</td>
 							<td>100</td>
 						</tr>
 						<tr>
 							<td>2</td>
 							<td>Sharukh Zahid</td>
 							<td>Hardees001843</td>
 							<td>100</td>
 						</tr>
 						<tr>
 							<td>3</td>
 							<td>Sharukh Zahid</td>
 							<td>Hardees001848</td>
 							<td>100</td>
 						</tr>
 						<tr>
 							<td>4</td>
 							<td>Sharukh Zahid</td>
 							<td>Hardees001852</td>
 							<td>100</td>
 						</tr>
 					</tbody>
 					<tfoot>
 						<tr style="font-weight: bold; background-color: white;">
 							<td></td>
 							<td></td>
 							<td></td>
 							<td>400</td>
 						</tr>
 					</tfoot>
 				</table>
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
 	});
 </script>






 @endsection