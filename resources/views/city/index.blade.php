@extends('layouts.main')

@section('title', 'Pakistan Cities')

@section('content')

<div class='container'>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">@yield('title')</h3>
	</div>
	<div class="uper">
		<table class="table table-striped table-hover" id="citys">
			<thead>
				<tr>
					<th scope="col">Sr No</th>
					<th scope="col">State</th>
					<th scope="col">City</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $city)
				<tr>
					<th scope="row"> {{ ++$key }} </th>
					<td> {{$city->state_id}} </td>
					<td> {{ $city->name }} </td>
					<td>
						<a href="{{ route('city.status', $city->id) }}" class="btn" style="background-color:  #dc3545; color: white;width:6rem">
							@if($city->status===0)Activate @else Deactivate @endif
						</a>
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
		var table = $('#citys').DataTable();
	});
</script>