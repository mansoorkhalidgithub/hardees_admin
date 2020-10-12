@extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
	<div class="card">

        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
			<h3 style="color: black; font-family: serif; font-weight: bold">Extra Patties</h3>
					@if(session()->has('message'))
					<div class="alert alert-success">
						{{ session()->get('message') }}
					</div>
					@endif
					<a href="{{ route('pattie.create') }}"
					   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
				class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Extra Pattie</a>

		</div>
		<div class="card-body">
			@if(session()->get('success'))
			<div class="alert alert-success">{{ session()->get('success') }}</div>
			@endif
					<table class="table table-striped table-hover" id="patties">
				<thead>
					<tr style="color:black">
						<th scope="col">ID</th>
						<th scope="col">Resturant</th>
						<th scope="col">Extra Pattie</th>
						<th scope="col">Price</th>
						<th scope="col">Active </th>
						<th scope="col">Action </th>
					</tr>
				</thead>
				<tbody>
				@foreach($extras as $key => $extra)
					<tr>
						<th scope="row"> {{ ++$key }} </th>
						<td> {{ $extra->restaurant->name }} </td>
						<td> {{ $extra->name }} </td>
						<td> {{ $extra->price }} </td>
						<td> {{ $extra->active == 1 ? 'Active' : 'Not Active' }} </td>
						<td>
							<!-- <a href="{{ route('pattie.show', $extra->id) }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;cursor: pointer;" title="View"><i class="fas fa-eye" style="color: #28a745"></i></a> -->
							<a href="{{ route('pattie.edit', $extra->id) }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;cursor: pointer;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
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
		var table = $('#patties').DataTable();
	});
</script>
		@endsection