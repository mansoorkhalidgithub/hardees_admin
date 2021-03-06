 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Manage City</h3>
 		<a href="{{ route('add_city') }}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New City</a>
 	</div>
 	<div class="uper" style=" margin-bottom: 50px">


 		<!-- Admin Role on Product List -->

 		<table class="table table-striped table-hover" id="city_list" style=" font-size: 13px">
 			<thead>
 				<tr style="color:black">
 					<th>#</th>
 					<th>Country</th>
 					<th>State</th>
 					<th>City</th>
 					<th>Status</th>
 					<th>Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				@foreach($model as $key => $city)
 				<tr style="color: black">
 					<td>1</td>
 					<td>Pakistan</td>
 					<td>
 						@if(isset($city->state_id))
 						{{ $city->state_id }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>{{$city->name}}</td>
 					<td>
 						<a href="{{ route('city.status', $city->id) }}" class="btn {{ ($city->status === 1) ? 'btn-success' : 'btn-danger' }}" style="color: white;width:6rem">
 							@if($city->status===0)Activate @else Deactivate @endif
 						</a>
 					</td>
 					<td>
 						<a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
 						<a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
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
 		var table = $('#city_list').DataTable();
 	});
 </script>

 @endsection