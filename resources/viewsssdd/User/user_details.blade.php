@extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Manage Users</h3>
                <a href="{{ route('create_user_list') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New User</a>
	</div>
    <div class="uper" style="overflow-x: scroll; font-size: 13px">
		@if(session()->get('success'))
		<div class="alert alert-success">{{ session()->get('success') }}</div>
		@endif
                <table class="table table-striped table-hover" id="manage_users" >
			<thead>
                            <tr style="color:black">
					<th>#</th>
					<th>User</th>
					<th>Country</th>
					<th>State</th>
                                        <th>City</th>
                                        <th>Name</th>
                                        <th style="min-width: 80px">Phone No.</th>
					<th>DOB</th>
					<th>Avg. Rating</th>
                                        <th style="min-width: 60px">Trip status</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>History</th>
                                        <th style="min-width: 100px;">Action</th>
				</tr>
			</thead>
                        <tbody style="color: black">
				
                                <tr>
					<td>1</td>
                                        <td>asdf</td>
                                        <td>Pakistan</td>
                                        <td>Punjab</td>
                                        <td>Lahore</td>
                                        <td>Ms Sahra</td>
                                        <td>3000545593</td>
                                        <td>(Not Set)</td>
                                        <td>1</td>
                                        <td>On Trip</td>
                                        <td>Active</td>
                                        <td>
						<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 12px" type="submit">Activate</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 12px" type="submit">Deactivate</button>
						</form>
                                             
					</td>
                                        <td>
                                            <form>
                                                <button class="btn btn-warning btn-xs" type="submit"><span style="color: black; font-size: 12px; font-weight: bold">History</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('view_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
				</tr>
                                <tr>
					<td>1</td>
                                        <td>asdf</td>
                                        <td>Pakistan</td>
                                        <td>Punjab</td>
                                        <td>Lahore</td>
                                        <td>Ms Sahra</td>
                                        <td>3000545593</td>
                                        <td>(Not Set)</td>
                                        <td>1</td>
                                        <td>On Trip</td>
                                        <td>Active</td>
                                        <td>
						<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 12px" type="submit">Activate</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 12px" type="submit">Deactivate</button>
						</form>
                                             
					</td>
                                        <td>
                                            <form>
                                                <button class="btn btn-warning btn-xs" type="submit"><span style="color: black; font-size: 12px; font-weight: bold">History</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('view_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
				</tr>
                                <tr>
					<td>1</td>
                                        <td>asdf</td>
                                        <td>Pakistan</td>
                                        <td>Punjab</td>
                                        <td>Lahore</td>
                                        <td>Ms Sahra</td>
                                        <td>3000545593</td>
                                        <td>(Not Set)</td>
                                        <td>1</td>
                                        <td>On Trip</td>
                                        <td>Active</td>
                                        <td>
						<form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 12px" type="submit">Activate</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 12px" type="submit">Deactivate</button>
						</form-->
                                             
					</td>
                                        <td>
                                            <form>
                                                <button class="btn btn-warning btn-xs" type="submit"><span style="color: black; font-size: 12px; font-weight: bold">History</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('view_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
				</tr>
                                <tr>
					<td>1</td>
                                        <td>asdf</td>
                                        <td>Pakistan</td>
                                        <td>Punjab</td>
                                        <td>Lahore</td>
                                        <td>Ms Sahra</td>
                                        <td>3000545593</td>
                                        <td>(Not Set)</td>
                                        <td>1</td>
                                        <td>On Trip</td>
                                        <td>Active</td>
                                        <td>
						<form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 12px" type="submit">Activate</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 12px" type="submit">Deactivate</button>
						</form-->
                                             
					</td>
                                        <td>
                                            <form>
                                                <button class="btn btn-warning btn-xs" type="submit"><span style="color: black; font-size: 12px; font-weight: bold">History</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('view_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
				</tr>
                                <tr>
					<td>1</td>
                                        <td>asdf</td>
                                        <td>Pakistan</td>
                                        <td>Punjab</td>
                                        <td>Lahore</td>
                                        <td>Ms Sahra</td>
                                        <td>3000545593</td>
                                        <td>(Not Set)</td>
                                        <td>1</td>
                                        <td>On Trip</td>
                                        <td>Active</td>
                                        <td>
						<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 12px" type="submit">Activate</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 12px" type="submit">Deactivate</button>
						</form>
                                             
					</td>
                                        <td>
                                            <form>
                                                <button class="btn btn-warning btn-xs" type="submit"><span style="color: black; font-size: 12px; font-weight: bold">History</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('view_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
				</tr>
                                <tr>
					<td>1</td>
                                        <td>asdf</td>
                                        <td>Pakistan</td>
                                        <td>Punjab</td>
                                        <td>Lahore</td>
                                        <td>Ms Sahra</td>
                                        <td>3000545593</td>
                                        <td>(Not Set)</td>
                                        <td>1</td>
                                        <td>On Trip</td>
                                        <td>Active</td>
                                        <td>
						<form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 12px" type="submit">Activate</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 12px" type="submit">Deactivate</button>
						</form-->
                                             
					</td>
                                        <td>
                                            <form>
                                                <button class="btn btn-warning btn-xs" type="submit"><span style="color: black; font-size: 12px; font-weight: bold">History</span></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('view_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_user_list') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
				</tr>
                                
                                
			</tbody>
		</table>
        </div>
</div>
                <script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#manage_users').DataTable();
	});
</script>
		@endsection