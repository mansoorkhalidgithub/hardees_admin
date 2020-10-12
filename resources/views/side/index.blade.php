@extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
	<div class="card">

        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
			<h3 style="color: black; font-family: serif; font-weight: bold">Sides</h3>
					@if(session()->has('message'))
					<div class="alert alert-success">
						{{ session()->get('message') }}
					</div>
					@endif
					<a href="{{ route('side.create') }}"
					   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
				class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Side</a>

		</div>
		<div class="card-body">
			@if(session()->get('success'))
			<div class="alert alert-success">{{ session()->get('success') }}</div>
			@endif
					<table class="table table-striped table-hover" id="sides">
				<thead>
					<tr style="color:black">
						<th scope="col">ID</th>
						<th scope="col">Resturant</th>
						<th scope="col">Drink</th>
						<th scope="col">Price</th>
						<th scope="col">Default </th>
						<th scope="col">Active </th>
						<th scope="col">Action </th>
					</tr>
				</thead>
				<tbody>
				@foreach($sides as $key => $side)
					<tr>
						<th scope="row"> {{ ++$key }} </th>
						<td> {{ $side->restaurant->name }} </td>
						<td> {{ $side->name }} </td>
						<td> {{ $side->price }} </td>
						<td> {{ $side->default }} </td>
						<td> {{ $side->active == 1 ? 'Active' : 'Not Active' }} </td>
						<td>
							<!-- <a href="{{ route('side.show', $side->id) }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;cursor: pointer;" title="View"><i class="fas fa-eye" style="color: #28a745"></i></a> -->
							<a href="{{ route('side.edit', $side->id) }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;cursor: pointer;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
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
		var table = $('#sides').DataTable();
	});
</script>
		@endsection