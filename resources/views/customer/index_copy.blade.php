 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">UAN Users</h3>
 	</div>
 	<div class="uper" style=" overflow-x: scroll">

 		<table class="table table-striped table-hover" id="sub_admins" style="font-size: 12px;">
 			<thead>
 				<tr style="color:black">
 					<th>Sr.</th>
 					<th>Country</th>
 					<th>State</th>
 					<th>City</th>
 					<th>Name</th>
 					<th>Contact No.</th>
 					<th>Email</th>
 					<th>Total Order</th>

 				</tr>
 			</thead>
 			<tbody style="color:black">
 				@foreach($model as $key => $user)
 				<tr>
 					<th scope="row"> {{ ++$key }} </th>
 					<td>
 						@if(!empty($user->country_id))
 						{{ $user->country->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($user->state_id))
 						{{ $user->state->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($user->city_id))
 						{{ $user->city->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td> {{ $user->first_name }} {{$user->last_name}} </td>
 					<td> {{ $user->phone_number }} </td>
 					<td> {{ $user->email }} </td>
 					<td> {{ $user->orderCount }} </td>
 				</tr>
 				@endforeach

 			</tbody>
 		</table>
 	</div>
 </div>


 <!-- Affiliate Role on Product List -->


 <script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



 <script>
 	$(document).ready(function() {
 		$.noConflict();
 		var table = $('#sub_admins').DataTable();
 	});
 </script>

 @endsection