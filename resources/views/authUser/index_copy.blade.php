@extends('layouts.main')

@section('title', "Manage Admin")

@section('content')

<div class='container'>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">@yield('title') List</h3>
		@role('admin')
		<div class="col-sm-2" style="float: right;">
			<a href="{{route('auth.create')}}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black;float:right"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Create Admin</a>
		</div>
		@endrole
	</div>
	<div class="uper" style=" overflow-x: scroll">
		<table class="table table-striped table-hover" id="users" style="width: fit-content; font-size: 11px;">
			<thead>
				<tr style="color:black">
					<th>Sr.</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Created By</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Type</th>
					<th>Contact No.</th>
					<th>User Name</th>
					<th style="min-width: 65px">Last Login</th>
					<th style="min-width: 65px">Created Date</th>
					<th>Status</th>
					<th style="min-width: 200px">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $auth)
				<tr>
					<th scope="row"> {{ ++$key }} </th>
					<td> {{ $auth->first_name }} {{$auth->last_name}} </td>
					<td> {{ $auth->email }} </td>
					<td>
						@if(!empty($auth->created_by))
						{{ $auth->createdBy->username }}
						@else
						Not set
						@endif
					</td>
					<td>
						@if(!empty($auth->country_id))
						{{ $auth->country->name }}
						@else
						Not set
						@endif
					</td>
					<td>
						@if(!empty($auth->state_id))
						{{ $auth->state->name }}
						@else
						Not set
						@endif
					</td>
					<td>
						@if(!empty($auth->city_id))
						{{ $auth->city->name }}
						@else
						Not set
						@endif
					</td>
					<td>Type</td>
					<td> {{ $auth->phone_number }} </td>
					<td> {{ $auth->username }} </td>
					<td> Last Login </td>
					<td> {{ $auth->created_at }} </td>
					<td>
						<a href="#" class="btn" style="background-color:  #dc3545; color: white;width:6rem">
							@if($auth->status === 0) Activate @elseif($auth->status === 1) Deactivate @endif
						</a>
					</td>
					<td>
						<a href="{{route('auth.show', $auth->id)}}" class="btn btn-warning btn-xs">
							<span style="color: black; font-size: 12px; font-weight: bold">View</span>
						</a>
						<a href="{{route('auth.edit', $auth->id)}}" class="btn btn-warning btn-xs">
							<span style="color: black; font-size: 12px; font-weight: bold">Edit</span>
						</a>
						<form action="{{ route('auth.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$auth->name}}');" style="display: inline-block;">
							@csrf
							<input type="hidden" name="id" value="{{$auth->id}}">
							<button type="submit" class="btn btn-xs btn-danger">
								<span style="color: white; font-size: 12px; font-weight: bold">Delete</span>
							</button>
						</form>
					</td>
				</tr>
				</tr>
				@endforeach
			</tbody>
		</table>
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
		var table = $('#users').DataTable();
	});
</script>