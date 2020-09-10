@extends('layouts.main') 

@section('title', 'Order Status')

@section('content')

<div  style="margin: 0px 10px 10px 10px">
	<div class="card">

        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold"> @yield('title') List </h3>
		@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@endif
	</div>
	<div class="card-body">
		@if(session()->get('success'))
		<div class="alert alert-success">{{ session()->get('success') }}</div>
		@endif

                <!-- Admin Role on Product List -->


        <table class="table table-striped table-hover" id="orders">
			<thead>
				<tr style="color:black">
					<th scope="col">ID</th>
					<th scope="col"> Status Name </th>
					<th scope="col"> Type </th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $status)
					<tr>
						<th scope="row"> {{ ++$key }} </th>
						<td> {{ $status->name }} </td>
						<td> {{ $status->orderType->type }} </td>
						<td>
							<a href="edit-menu/{{$status->id}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;cursor: pointer;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
							<a href="show-menu-item/{{$status->id}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;cursor: pointer;"><i class="fas fa-eye"></a></i>
						</td>
					</tr>
				@endforeach
            </tbody>
		</table>

        </div>
    </div>
</div>
<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#orders').DataTable();
	});
</script>

		@endsection