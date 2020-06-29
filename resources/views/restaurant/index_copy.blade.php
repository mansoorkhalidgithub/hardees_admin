@extends('layouts.main')

@section('title', 'Restaurants')

@section('content')

<div class='container'>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Restaurant List</h3>
		@role('admin')
		<a href="{{ route('add-restaurant') }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add Restaurant</a>
		@endrole
	</div>
	<div class="uper">
		<table class="table table-striped table-hover" id="restaurants">
			<thead>
				<tr>
					<th scope="col">Sr No</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Phone</th>
					<th scope="col">Status</th>
					<!-- <th scope="col">Category</th> -->
					<th class="text-center" scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $restaurant)
				<tr>
					<th scope="row"> {{ ++$key }} </th>
					<td> {{ $restaurant->name }} </td>
					<td> {{ $restaurant->email }} </td>
					<td> {{ $restaurant->contact_number }} </td>
					<td>
						<a href="{{ route('restaurant.status', $restaurant->id) }}" class="btn" style="background-color:  #dc3545; color: white;width:6rem">
							@if($restaurant->status===0)Activate @else Deactivate @endif
						</a>
					</td>
					<td>
						<a href="{{route('restaurant.show', $restaurant->id)}}" class="btn btn-warning btn-xs">
							<span style="color: black; font-size: 12px; font-weight: bold">View</span>
						</a>
						<a href="{{route('restaurant.edit', $restaurant->id)}}" class="btn btn-warning btn-xs">
							<span style="color: black; font-size: 12px; font-weight: bold">Edit</span>
						</a>
						<form action="{{ route('restaurant.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$restaurant->name}}');" style="display: inline-block;">
							@csrf
							<input type="hidden" name="id" value="{{$restaurant->id}}">
							<button type="submit" class="btn btn-xs btn-danger">
								<span style="color: white; font-size: 12px; font-weight: bold">Delete</span>
							</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>



</div>

@stop

<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#restaurants').DataTable();
	});
</script>