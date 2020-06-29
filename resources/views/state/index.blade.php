@extends('layouts.main')

@section('title', 'Pakistan States')

@section('content')

<div class='container'>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">@yield('title')</h3>
	</div>
	<div class="uper">
		<table class="table table-striped table-hover" id="states">
			<thead>
				<tr>
					<th scope="col">Sr No</th>
					<th scope="col">Country</th>
					<th scope="col">State</th>
					<th scope="col">Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $state)
				<tr>
					<th scope="row"> {{ ++$key }} </th>
					<td> Pakistan </td>
					<td> {{ $state->name }} </td>
					<td>
						<a href="{{ route('state.status', $state->id) }}" class="btn" style="background-color:  #dc3545; color: white;width:6rem">
							@if($state->status===0)Activate @else Deactivate @endif
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
		var table = $('#states').DataTable();
	});
</script>