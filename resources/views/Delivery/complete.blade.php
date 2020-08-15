 @extends('layouts.main') @section('content')
 <style>
 	.form-popup {
 		display: none;
 		position: absolute;
 		top: 10%;
 		left: 40%;
 		border: 3px solid #f1f1f1;
 		z-index: 1;
 	}

 	.form-container {
 		max-width: 300px;
 		padding: 20px 20px 50px 20px;
 		background-color: white;
 	}

 	/* Full-width input fields */
 	.form-container input[type=checkbox] {

 		border: none;
 		background: #f1f1f1;
 	}



 	/* Set a style for the submit/login button */
 	.form-container .btn {
 		color: black;
 		font-weight: bold;
 		border: none;
 		width: 45%;
 		text-align: center;
 		opacity: 0.8;
 	}


 	/* Add some hover effects to buttons */
 	.form-container .btn:hover,
 	.open-button:hover {
 		opacity: 1;
 	}
 </style>
 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Complete Trip History</h3>

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
 					<th style="min-width:70px">Customer Name</th>
 					<th style="min-width:60px">Driver Name</th>
 					<th style="min-width:80px">Booking Time</th>
 					<th style="min-width:80px">Delivered Time</th>
 					<th style="min-width:80px">Total Time</th>
 					<th>Status</th>
 					<th>Order Amount</th>
 					<th style="min-width:80px">Order Items</th>
 					<th>Customer Address</th>
 					<th>Payment Mode</th>
 					<th>Payment Status</th>

 				</tr>

 			</thead>
 			<tbody style="color: black">
 				@foreach($orders as $key => $order)
 				<tr>
 					<td>{{ ++$key}}</td>
 					<td>{{$order->restaurant->name}}</td>
 					<td>{{$order->order_reference}}</td>
 					<td>{{$order->id}}</td>
 					<td>Pakistan</td>
 					<td>Punjab</td>
 					<td>Lahore</td>
 					<td>{{$order->customer->name}}</td>
 					<td>
 						@if(!empty($order->orderAssigned))
 						{{$order->orderAssigned->rider->name}}
 						@else NotSet
 						@endif
 					</td>
 					<td>{{$order->created_at->format('Y-m-d h:i:s a')}}</td>
 					<td>{{$order->updated_at->format('Y-m-d h:i:s a')}}</td>
 					<td>{{$order->time}}</td>
 					<td>{{$order->orderStatus}}</td>
 					<td>{{$order->total}}</td>
 					<td>
 						@foreach($order->items as $key => $item)
 						{{++$key.":".$item}} <br>
 						@endforeach
 						{{$order->menu}}
 					</td>
 					<td>{{$order->customer->address}}</td>
 					<td>{{$order->paymentType->name}}</td>
 					<td>{{ ($order->status == 6) ? 'Paid': 'Uppaid' }}</td>

 				</tr>
 				@endforeach
 			</tbody>
 		</table>
 	</div>
 </div>

 <div class="form-popup" id="myForm">
 	<form class="form-container">
 		<h4 style="color:black; margin-bottom: 1.5rem">Whom do you want to send this order again?</h4>
 		<input type="checkbox" name="order_resend"> <label style="font-size:15px; color: black; font-weight: bold">Rider</label><br>
 		<input type="checkbox" name="order_resend"> <label style="font-size:15px; color: black; font-weight: bold">Restaurant</label><br>
 		<div style="margin-top:2rem">
 			<button type="submit" class="btn btn-warning btn-xs" style="float:left">Resend</button>
 			<button type="button" class="btn btn-danger" style="float: right; color: white" onclick="closeForm()">Close</button>
 		</div>
 	</form>
 </div>

 <script>
 	function openForm() {
 		document.getElementById("myForm").style.display = "block";
 	}

 	function closeForm() {
 		document.getElementById("myForm").style.display = "none";
 	}
 </script>
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