@extends('layouts.main')

@section('title', 'Menu')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Manage @yield('title') Items </h3>
				@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
				@endif
				<div class="card-tools">
					<a href="{{ route('create-menu-item') }}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Add @yield('title') Item </a>
				</div>

			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="">
					<table id="items" class="table table-striped">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Name</th>
								<th scope="col"> Menu Category </th>
								<th scope="col">Restaurant</th>
								<th scope="col">Created By</th>
								<th scope="col">Price</th>
								<th scope="col">Discount</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($model as $key => $item)
							<tr>
								<th scope="row"> {{ ++$key }} </th>
								<td> {{ $item->name }} </td>
								<td> {{ $item->category->name }} </td>
								<td>
									@if(!empty($item->restaurant_id))
									{{ $item->getRestaurant->name }}
									@else
									Not set
									@endif
								</td>
								<td>
									@if(!empty($item->created_by))
									{{ $item->createdBy->username }}
									@else
									Not set
									@endif
								</td>
								<td> {{ $item->price }} </td>
								<td> {{ $item->discount }} </td>
								<td> <a href="edit-menu/{{$item->id}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
									<a href="show-menu-item/{{$item->id}}" class="btn  btn-sm"><i class="fas fa-eye"></a></i></td>
							</tr>
							@endforeach
						</tbody>

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
		var table = $('#items').DataTable();
	});
</script>