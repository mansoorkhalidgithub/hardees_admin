 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Riders List</h3>
 		<a href="{{ route('restaurant.create-user') }}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Rider</a>
 	</div>
 	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px">

 		<table class="table table-striped table-hover" id="restaurantUser_list" style=" font-size: 13px">
 			<thead>
 				<tr style="color:black">
 					<th>#</th>
 					<th>Created By</th>
 					<th>Restaurant</th>
 					<!-- <th>Country</th>
 					<th>State</th>
 					<th>City</th> -->
 					<th>Name</th>
<!--  					<th>Area</th> -->
 					<th>Mobile No.</th>
 					<th>Email</th>
 					<!-- <th style="min-width: 80px">Vehical No.</th> -->
 					<!-- <th>Avg. Rating</th> -->
 					<!-- <th>Approval/Pending</th> -->
 					<!-- <th>Current Status</th> -->
 					<!-- <th>Offline/Online</th> -->
 					<!-- <th style="min-width: 80px">Trip Status</th> -->
 					<!-- <th>History</th> -->
 					<!-- <th>Credit/Debit</th> -->
 					<th style="min-width: 100px;">Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				<tr style="color: black">
 					<!-- <td>1</td>
 					<td>
 						1
 					</td>
 					<td>
 						2
 						</td>
 					<td>

 					</td>
 					<td>
 						3
 					</td>
 					<td>
 						4
 					</td>
 					<td> 5 </td>
 					<td>6</td>
 					<td>7 </td>
 					<td> 8</td>
 					<td>9</td>
 					<td>10</td>----->
 					<td>11</td>
 					<td>
 						12
 					</td>
 					<td>
 						13
 					</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn" style="background-color:  white; color: red" type="submit">On Trip</button>
 						</form>
 					</td>
 					<td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
 					<td><button class="btn" style="background-color:  #dc3545; color: white" type="submit">Dr Rs 14</button></td>

 					<td>
 						<a href="" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
 						<a href="" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
 						<form action="" method="POST" onsubmit="return confirm('Please confirm you want to delete! ');" style="display: inline-block;">
 							@csrf
 							<input type="hidden" name="id" value="">
 							<button type="submit" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete">
 								<i class="fas fa-trash-alt" style="color: #dc3545"></i>
 							</button>
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
 		var table = $('#restaurantUser_list').DataTable();
 	});
 </script>

 @endsection