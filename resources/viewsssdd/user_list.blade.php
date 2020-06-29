@extends('layouts.main') @section('content')

<div class='container'>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">User List</h1>
               
	</div>
	<div class="uper">
		@if(session()->get('success'))
		<div class="alert alert-success">{{ session()->get('success') }}</div>
		@endif
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Name</th>
					<th>UserName</th>
					<th>Email</th>
					<th>Role</th>
					<th>Status</th>
                                        <th>Action you can Take</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($user_lists as $row)
				<tr>
					<td>{{$row->name}}</td>
					<td>{{$row->name}}</td>
					<td>{{$row->email}}</td>
					<td>{{$row->role}}</td>
					<td @if($row->status == "1")
                                             class="font-weight-bold text-success"
                                             @endif
                                             @if($row->status == "2")
                                             class="font-weight-bold text-danger"
                                             @endif>{{$row->status}}</td>
                                        <td>
                                            @if($row->status == "2")
						<form action="{{ route('unblock', $row->id)}}" method="post">
							@csrf @method('POST')
							<button class="btn btn-success" type="submit">Unblock</button>
						</form>
                                            @endif
                                            @if($row->status == "1")
                                            <form action="{{ route('block', $row->id)}}" method="post">
							@csrf @method('POST')
							<button class="btn btn-danger btn-xs" type="submit">Block</button>
						</form>
                                            @endif
					</td>
                                        <td>
					<form action="{{ route('edit_user', $row->id) }}" method="post">
							@csrf @method('POST')
							<button class="btn btn-warning btn-xs" type="submit">Edit</button>
						</form>
					</td>
                                        
				</tr>
				@endforeach
			</tbody>
		</table>
		<div></div>
		@endsection