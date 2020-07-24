 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Riders List</h3>
 		<a href="{{ route('rider.create') }}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Rider</a>
 	</div>
 	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px">

 		<table class="table table-striped table-hover" id="rider_list" style=" font-size: 13px">
 			<thead>
 				<tr style="color:black">
 					<th>#</th>
 					<th>Created By</th>
 					<th>Restaurant</th>
 					<th>Country</th>
 					<th>State</th>
 					<th>City</th>
 					<th>Name</th>
 					<th>Area</th>
 					<th>Mobile No.</th>
 					<th>Email</th>
 					<th style="min-width: 80px">Vehical No.</th>
 					<th>Avg. Rating</th>
 					<th>Approval/Pending</th>
 					<th>Current Status</th>
 					<th>Offline/Online</th>
 					<th style="min-width: 80px">Trip Status</th>
 					<th>History</th>
 					<th>Credit/Debit</th>
 					<th style="min-width: 100px;">Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				@foreach($model as $key => $rider)
 				<tr style="color: black">
 					<td>1</td>
 					<td>
 						@if(!empty($rider->created_by))
 						{{ $rider->createdBy->username }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($rider->restaurant_id))
 						{{ $rider->getRestaurant->name }}
 						@else
 						Not set
 						@endif</td>
 					<td>
 						@if(!empty($rider->country_id))
 						{{ $rider->country->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($rider->state_id))
 						{{ $rider->state->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($rider->city_id))
 						{{ $rider->city->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td> {{ $rider->first_name }} {{$rider->last_name}} </td>
 					<td>Delivery Peshawar Pakistan</td>
 					<td> {{ $rider->phone_number }} </td>
 					<td> {{ $rider->email }} </td>
 					<td>LA6315</td>
 					<td>1</td>
 					<td>Approved</td>
 					<td>
 						<a href="{{ route('rider.status', $rider->id) }}" class="btn {{ ($rider->status === 1) ? 'btn-success' : 'btn-danger' }}" style=" color: white;width:6rem">
 							{{($rider->status == 1) ? 'Active' : 'Deactive'}}
 						</a>
 					</td>
 					<td>
 						<a href="#" class="btn {{($rider->getRiderStatus->online_status == 'online') ? 'btn-success' : 'btn-danger'}}" style="color: white;width:6rem">
 							{{($rider->getRiderStatus->online_status == 'online') ? 'Online' : 'Offline'}}

 						</a>
 					</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn" style="background-color:  white; color: red" type="submit">
 								{{($rider->getRiderStatus->trip_status == 'free') ? 'Free' : 'On Trip'}}
 							</button>
 						</form>
 					</td>
 					<td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
 					<td><button class="btn" style="background-color:  #dc3545; color: white" type="submit">Dr Rs 14</button></td>

 					<td>
 						<a href="{{route('rider.show', $rider->id)}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
 						<a href="{{route('rider.edit', $rider->id)}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
 						<form action="{{ route('rider.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$rider->username}}');" style="display: inline-block;">
 							@csrf
 							<input type="hidden" name="id" value="{{$rider->id}}">
 							<button type="submit" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete">
 								<i class="fas fa-trash-alt" style="color: #dc3545"></i>
 							</button>
 						</form>
 					</td>
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
 		var table = $('#rider_list').DataTable();
 		setTimeout(function() {
 			window.location = window.location
 		}, 30000);
 	});
 </script>

 @endsection