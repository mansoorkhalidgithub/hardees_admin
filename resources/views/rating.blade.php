 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Manage Ratings</h3>

 	</div>
 	<div class="uper" style=" margin-bottom: 50px">


 		<!-- Admin Role on Product List -->

 		<table class="table table-striped table-hover" id="rating_list" style=" font-size: 13px">
 			<thead>
 				<tr style="color:black">
 					<th>#</th>
 					<th>Booking No.</th>
 					<th>Was</th>
 					<th>User</th>
 					<th>Driver</th>
 					<th>Rating</th>
 					<th>Feedback</th>
 					<th>Date &AMP; Time</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				<tr style="color: black">
 					<td>1</td>
 					<td>Hardees002375</td>
 					<td>Customer</td>
 					<td>abdullah mr</td>
 					<td>Shan Pitras</td>
 					<td>3</td>
 					<td></td>
 					<td>2020-03-21 06:31:00</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-danger btn-xs" type="submit"><span style="color: white; font-size: 12px; font-weight: bold">Delete</span></button>
 						</form>
 					</td>
 				</tr>
 				<tr style="color: black">
 					<td>2</td>
 					<td>Hardees002368</td>
 					<td>Customer</td>
 					<td>Ms Sahra</td>
 					<td>Shan Pitras</td>
 					<td>5</td>
 					<td>Nice and Good Service</td>
 					<td>2020-03-21 06:31:00</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn btn-danger btn-xs" type="submit"><span style="color: white; font-size: 12px; font-weight: bold">Delete</span></button>
 						</form>
 					</td>
 				</tr>
 			</tbody>
 		</table>
 	</div>
 </div>

 <script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



 <script>
 	$(document).ready(function() {
 		$.noConflict();
 		var table = $('#rating_list').DataTable();
 	});
 </script>

 @endsection