 @extends('layouts.main') @section('content')

 <div class='container'>
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Trips History</h3>

 	</div>
 	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px;">


 		<!-- Admin Role on Product List -->


 		<table class="table table-striped table-hover" id="trips" style="width: fit-content; font-size: 13px">
 			<thead>
 				<tr style="color:black">
 					<th>Sr.</th>
 					<th>Branch Name</th>
 					<th>Booking No.</th>
 					<th>Invoice No.</th>
 					<th>Country</th>
 					<th>State</th>
 					<th>City</th>
 					<th style="min-width:70px">User Name</th>
 					<th style="min-width:60px">Driver Name</th>
 					<th style="min-width:80px">Date &AMP; Time</th>
 					<th>Status</th>
 					<th>Order Amount</th>
 					<th style="min-width:80px">Order Items</th>
 					<th>Customer Address</th>
 					<th>Payment Mode</th>
 					<th>Payment Status</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000330</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 				<tr>
 					<td>1</td>
 					<td>Hardees Packages Mall</td>
 					<td>Hardees002246</td>
 					<td>000230</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>salman mr</td>
 					<td>Waseem Basheer</td>
 					<td>15-06-2020 06:11 PM</td>
 					<td>Driver Arrived</td>
 					<td>1250</td>
 					<td>1 angus philly steak sandwich combo with french fries drink peach</td>
 					<td>new gardeen town h 58 babar block</td>
 					<td>Cash</td>
 					<td>PAID</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
 						</form>
 					</td>
 				</tr>
 			</tbody>
 		</table>
 	</div>


 	<!-- Affiliate Role on Product List -->


 	<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
 	<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
 	<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



 	<script>
 		$(document).ready(function() {
 			$.noConflict();
 			var table = $('#trips').DataTable();
 		});
 	</script>

 	@endsection