@extends('layouts.main')

@section('title', 'Riders')

@section('content')

<div class='container'>
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">@yield('title') List</h3>
		@role('admin')
		<div class="col-sm-2" style="float: right;">
			<a href="{{route('rider.create')}}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black;float:right"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Create @yield('title')</a>
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
					@if(isset($_REQUEST['page']) && $_REQUEST['page'] =='rider')
					<th scope="col">rider</th>
					@endif
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
					<th>ON Line / Off Line</th>
					<th style="min-width: 200px">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $rider)
				<tr>
					<th scope="row"> {{ ++$key }} </th>
					<td> {{ $rider->first_name }} {{$rider->last_name}} </td>
					<td> {{ $rider->email }} </td>
					@if(isset($_REQUEST['page']) && $_REQUEST['page'] =='rider')
					<td>
						@if(!empty($rider->rider_id))
						{{ $rider->getrider->name }}
						@else
						Not set
						@endif
					</td>
					@endif
					<td>
						@if(!empty($rider->created_by))
						{{ $rider->createdBy->username }}
						@else
						Not set
						@endif
					</td>
					<td>
						@if(!empty($rider->country_id))
						{{ $rider->country->name }}
						@else
						Not set
						@endif
					</td>
					<td>
						@if(!empty($rider->state_id))
						{{ $rider->state->name }}
						@else
						Not set
						@endif
					</td>
					<td>
						@if(!empty($rider->city_id))
						{{ $rider->city->name }}
						@else
						Not set
						@endif
					</td>
					<td>Type</td>
					<td> {{ $rider->phone_number }} </td>
					<td> {{ $rider->username }} </td>
					<td> Last Login </td>
					<td> {{ $rider->created_at }} </td>
					<td>
						<a href="{{ route('rider.status', $rider->id) }}" class="btn" style="background-color:  #dc3545; color: white;width:6rem">
							@if($rider->status === 0) Activate @elseif($rider->status === 1) Deactivate @endif
						</a>
					</td>
					<td>
						<a href="{{ route('rider.eStatus', $rider->id) }}" class="btn" style="background-color:  #dc3545; color: white;width:6rem">
							@if($rider->eStatus === 10) Online @elseif($rider->eStatus === 9) Offline @endif
						</a>
					</td>
					<td>
						<a href="{{route('rider.show', $rider->id)}}" class="btn btn-warning btn-xs">
							<span style="color: black; font-size: 12px; font-weight: bold">View</span>
						</a>
						<a href="{{route('rider.edit', $rider->id)}}" class="btn btn-warning btn-xs">
							<span style="color: black; font-size: 12px; font-weight: bold">Edit</span>
						</a>
						<form action="{{ route('rider.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$rider->name}}');" style="display: inline-block;">
							@csrf
							<input type="hidden" name="id" value="{{$rider->id}}">
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