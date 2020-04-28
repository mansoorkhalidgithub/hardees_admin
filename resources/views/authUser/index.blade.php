@extends('layouts.main')

@section('title', 'Users')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Manage @yield('title') </h3>
				<div class="card-tools">
					<a href="{{route('add-user')}}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Add @yield('title')</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="">
					<table id="users" class="table table-striped">
						<thead>
							<tr>
								<th scope="col"> # </th>
								<th scope="col"> Name</th>
								<th scope="col"> Email</th>
								<th scope="col"> Phone</th>
								<th scope="col"> Type</th>
								<th scope="col"> Register Date</th>
								<th scope="col"> Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($model as $key => $user)
							<tr>
								<th scope="row">{{ ++$key }}</th>
								<td> {{ $user->name }} </td>
								<td> {{ $user->email }} </td>
								<td> {{ $user->phone }} </td>
								<td> {{ $user->phone }} </td>
								<td>{{date_format(date_create($user->created_at), 'd-m-Y')}} </td>
								<td> <i class="fas fa-edit"></i> <i class="fas fa-eye"></i> </td>
							</tr>
							@endforeach
						</tbody>
						<thead>
							<tr>
								<th scope="col"> # </th>
								<th scope="col"> Name </th>
								<th scope="col"> Email </th>
								<th scope="col"> Phone </th>
								<th scope="col"> Type </th>
								<th scope="col"> Register Date </th>
								<th scope="col"> Action </th>
							</tr>
						</thead>
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
		var table = $('#users').DataTable({
			"pageLength": 10
		});

	});
</script>