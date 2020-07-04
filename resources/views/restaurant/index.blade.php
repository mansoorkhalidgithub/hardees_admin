 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h3 style="color: black; font-family: serif; font-weight: bold">Restaurant List</h3>

 		<a href="{{ route('add-restaurant') }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add Restaurant</a>

 	</div>
 	<div class="uper">
 		<table class="table table-striped table-hover" id="branches">
 			<thead>
 				<tr style="color:black">
 					<th>Sr No</th>
 					<th>Name</th>
 					<th>Code</th>
 					<th>Timing</th>
 					<th>Brand</th>
 					<th>Email</th>
 					<th>Phone</th>
 					<th>Status</th>
 					<!-- <th >Category</th> -->
 					<th class="text-center">Action</th>
 				</tr>
 			</thead>
 			<tbody>
 				@foreach($model as $key => $restaurant)
 				<tr>
 					<th scope="row"> {{ ++$key }} </th>
 					<td> {{ $restaurant->name }} </td>
 					<td>HR000{{ $restaurant->id }}</td>
 					<td>1000 - 2200</td>
 					<td>Fast Food</td>
 					<td> {{ $restaurant->email }} </td>
 					<td> {{ $restaurant->contact_number }} </td>
 					<td>
 						<a href="#" class="btn {{ ($restaurant->status === 1) ? 'btn-success' : 'btn-danger' }} " style="color: white;width:6rem">
 							@if($restaurant->status===0)Activate @else Deactivate @endif
 						</a>
 					</td>
 					<td>
 						<a href="{{route('restaurant.show', $restaurant->id)}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
 						<a href="{{route('restaurant.edit', $restaurant->id)}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
 						<form action="{{ route('restaurant.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$restaurant->name}}');" style="display: inline-block;">
 							@csrf
 							<input type="hidden" name="id" value="{{$restaurant->id}}">
 							<button type="submit" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete">
 								<i class="fas fa-trash-alt" style="color: #dc3545"></i>
 							</button>
 						</form>
 						<!-- <a href="#" >
 							<i class="fas fa-trash-alt" style="color: #dc3545"></i>
 						</a> -->
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
 		var table = $('#branches').DataTable();
 	});
 </script>

 @endsection