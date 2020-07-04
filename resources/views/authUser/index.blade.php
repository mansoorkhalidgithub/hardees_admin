 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Manage Admin</h3>
 		<a href="{{ route('auth.create') }}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Create new Admin</a>

 	</div>
 	<div class="uper" style=" overflow-x: scroll">

 		<table class="table table-striped table-hover" id="sub_admins" style="width: fit-content; font-size: 11px;">
 			<thead>
 				<tr style="color:black">
 					<th>Sr.</th>
 					<th>User</th>
 					<th>Country</th>
 					<th>State</th>
 					<th>City</th>
 					<th>Type</th>
 					<th>Name</th>
 					<th>Contact No.</th>
 					<th>Email</th>
 					<th>User Name</th>
 					<th style="min-width: 65px">Last Login</th>
 					<th style="min-width: 65px">Created Date</th>
 					<th>Status</th>
 					<th style="min-width: 120px;">Action</th>
 				</tr>
 			</thead>
 			<tbody style="color:black">
 				@foreach($model as $key => $auth)
 				<tr>
 					<th scope="row"> {{ ++$key }} </th>
 					<td>HHHH</td>
 					<td>
 						@if(!empty($auth->country_id))
 						{{ $auth->country->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($auth->state_id))
 						{{ $auth->state->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($auth->city_id))
 						{{ $auth->city->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>City Admin</td>
 					<td> {{ $auth->first_name }} {{$auth->last_name}} </td>
 					<td> {{ $auth->phone_number }} </td>
 					<td> {{ $auth->email }} </td>
 					<td> {{ $auth->username }} </td>
 					<td>{{ date('h:i:s a m/d/Y', strtotime($auth->last_login_at)) }}</td>
 					<td>2020-06-08 06:47:00</td>
 					<td>
 						<a href="{{ route('auth.status', $auth->id) }}" title="{{($auth->status === 1) ? 'Click To In Active' : 'Click To Active' }}" class="btn {{ ($auth->status === 1) ? 'btn-success' : 'btn-danger' }}" style=" color: white;width:6rem">
 							@if($auth->status === 1) Active @elseif($auth->status === 0) In Active @endif
 						</a>
 					</td>
 					<td>
 						<a href="{{route('auth.show', $auth->id)}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
 						<a href="{{route('auth.edit', $auth->id)}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
 						<form action="{{ route('auth.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$auth->username}}');" style="display: inline-block;">
 							@csrf
 							<input type="hidden" name="id" value="{{$auth->id}}">
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