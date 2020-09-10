@extends('layouts.main')

@section('title', $title)

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="row card-header d-sm-flex align-items-center justify-content-between mb-4">
				<div class="col-sm-10">
					<h3 style="color: black; font-family: serif; font-weight: bold">Manage @yield('title')</h3>
				</div>

				@role('admin')
				<div class="col-sm-2" style="float: right;">
					<a href="{{route('user.add', $title)}}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black;float:right"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Create @yield('title')</a>

				</div>
				@endrole
			</div>
			<!-- /.card-header -->
			<div class="uper" style=" overflow-x: scroll">
				<div class="card-body">
					<div class="">
						<table class="table table-striped table-hover" id="users" style="width: fit-content; font-size: 11px;">
							<thead>
								<tr style="color:black">
									<th>Sr.</th>
									<th scope="col">Name</th>
									<th scope="col">Email</th>
									@if(isset($_REQUEST['page']) && $_REQUEST['page'] =='rider')
									<th scope="col">Restaurant</th>
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
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($model as $key => $user)
								<tr>
									<th scope="row"> {{ ++$key }} </th>
									<td> {{ $user->first_name }} {{$user->last_name}} </td>
									<td> {{ $user->email }} </td>
									@if(isset($_REQUEST['page']) && $_REQUEST['page'] =='rider')
									<td>
										@if(!empty($user->restaurant_id))
										{{ $user->getRestaurant->name }}
										@else
										Not set
										@endif
									</td>
									@endif
									<td>
										@if(!empty($user->created_by))
										{{ $user->createdBy->username }}
										@else
										Not set
										@endif
									</td>
									<td>Country</td>
									<td>State</td>
									<td>City</td>
									<td>Type</td>
									<td> {{ $user->phone_number }} </td>
									<td> {{ $user->username }} </td>
									<td> Last Login </td>
									<td> {{ $user->created_at }} </td>
									<td> @if($user->status===1)Active @else Inactive @endif </td>
									<td>
										<a href="{{route('user.edit', [$user->id, $title])}}"><i class="fas fa-edit"></i></a>
										<a href="{{route('user.show', [$user->id, $title])}}"><i class="fas fa-eye"></i></a>
										<form action="{{ route('user.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$user->name}}');" style="display: inline-block;">
											@csrf
											<input type="hidden" name="id" value="{{$user->id}}">
											<button class="btn" style="background-color:  #dc3545; color: white; font-size: 13px" type="submit">Deactivate</button>
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