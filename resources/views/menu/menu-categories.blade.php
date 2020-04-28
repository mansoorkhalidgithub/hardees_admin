@extends('layouts.main')

@section('title', 'Products')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Manage @yield('title') </h3>
				<div class="card-tools">
					<a href="{{ route('add-menu-category') }}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Add @yield('title') </a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="">
					<table id="products" class="table table-striped">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Name</th>
								
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($model as $key => $product)
							<tr>
								<th scope="row"> {{ ++$key }} </th>
								<td> {{ $product->name }} </td>
								
								<td> <i class="fas fa-edit"></i> <i class="fas fa-eye"></i> </td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Name</th>
								<th scope="col">Category</th>
								<th scope="col">Restaurant</th>
								<th scope="col">Price</th>
								<th scope="col">Register Date</th>
								<th scope="col">Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
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
		var table = $('#products').DataTable();
	});
</script>