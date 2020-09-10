 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">User List</h3>
 		@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
				@endif
 		<a href="{{ route('restaurant.create-user') }}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Create User</a>
 	</div>
 	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px">

 		<table class="table table-striped table-hover" id="restaurantUser_list" style=" font-size: 13px">
 			<thead>
 				<tr style="color:black">
 					<th>#</th>
 					<!-- <th>Created By</th> -->
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
 					<!-- <th style="min-width: 100px;">Action</th> -->
 				</tr>
 			</thead>
 			<tbody>
 				@foreach($model as $key => $user)
 				<tr style="color: black">
 					<td>{{$key}}</td>
 					<!-- <td>
 						{{ $user->restaurant_id}}
 					</td> -->
 					<td>
 						{{ $user->getRestaurant->name }}
 					</td>
 					<td>
 						{{$user->last_name? $user->first_name.' '.$user->last_name: $user->first_name }}
 					</td>
 					<td> {{$user->phone_number	}}</td>
 					<td> {{$user->email	}}</td>

 					<!-- <td> -->
 						<!-- <a href="" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
 						<a href="" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
 						<form action="" method="POST" onsubmit="return confirm('Please confirm you want to delete! ');" style="display: inline-block;">
 							@csrf
 							<input type="hidden" name="id" value="">
 							<button type="submit" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete">
 								<i class="fas fa-trash-alt" style="color: #dc3545"></i>
 							</button> -->
 						</form>
 					<!-- </td> -->
 				</tr>
 				@endforeach
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