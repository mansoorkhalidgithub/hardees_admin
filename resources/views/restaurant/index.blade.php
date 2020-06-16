@extends('layouts.main')

@section('title', 'Restaurants')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Manage @yield('title') </h3>
				<div class="card-tools">
					<a href="{{ route('add-restaurant') }}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Add @yield('title') </a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="">
					<table id="restaurants" class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Sr No</th>
								<th scope="col">Name</th>
								<th scope="col">Email</th>
								<th scope="col">Phone</th>
								<th scope="col">Status</th>
								<!-- <th scope="col">Category</th> -->
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($model as $key => $restaurant)
							<tr>
								<th scope="row"> {{ ++$key }} </th>
								<td> {{ $restaurant->name }} </td>
								<td> {{ $restaurant->email }} </td>
								<td> {{ $restaurant->contact_number }} </td>
								<td> @if($restaurant->status===1)Active @else Inactive @endif </td>
								<!-- <td> {{ $restaurant->category->title }} </td> -->
								<td>
									<a href="{{route('restaurant.edit', $restaurant->id)}}"><i class="fas fa-edit"></i></a>
									<a href="{{route('restaurant.show', $restaurant->id)}}"><i class="fas fa-eye"></i></a>
									<form action="{{ route('restaurant.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$restaurant->name}}');" style="display: inline-block;">
										@csrf
										<input type="hidden" name="id" value="{{$restaurant->id}}">
										<button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
									</form>
								</td>
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
		var table = $('#restaurants').DataTable();
	});
</script>