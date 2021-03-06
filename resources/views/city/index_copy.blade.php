@extends('layouts.main')

@section('title', 'Pakistan Cities')

@section('content')

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
					<th>Sr. No</th>
					<th>Country>/th>
					<th>State</th>
					<th>City</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $city)
				<tr>
					<th scope="row"> {{ ++$key }} </th>
					<td>Pakistan</td>
					<td> {{$city->state_id}} </td>
					<td> {{ $city->name }} </td>
					<td>
						<a href="{{ route('city.status', $city->id) }}" class="btn" style="background-color:  #dc3545; color: white;width:6rem">
							@if($city->status===0)Activate @else Deactivate @endif
						</a>
					</td>
					<td>
						<a href="{{ route('update_city') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
						<a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
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
		var table = $('#city_list').DataTable();
	});
</script>