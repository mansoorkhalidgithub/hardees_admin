 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Manage Admin</h3>
                <a href="{{ route('create_sub_admins') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Create new Admin</a>
                        
	</div>
    <div class="uper" style=" overflow-x: scroll">
		 
                
                <!-- Admin Role on Product List -->
                
               
                <table class="table table-striped table-hover" id="sub_admins" style="width: fit-content; font-size: 11px;">
			<thead>
				<tr style="color:black">
                                        <th>Sr.</th>
                                        <th>User</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Type</th>
                                        <th>Name</th>
					<th >Contact No.</th>
					<th >Email</th>
                                        <th>User Name</th>
					<th style="min-width: 65px">Last Login</th>
					<th style="min-width: 65px">Created Date</th>
                                        <th >Status</th>
					<th>Actions you can take</th>
                                        <th style="min-width: 100px;">Action</th>
				</tr>
			</thead>
			<tbody style="color:black">
				<tr>
					<td>1</td>
                                        <td>HHHH</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>City Admin</td>
					<td>abdul rehman</td>
					<td>3311234567</td>
					<td>rehmandar302@gmail.com</td>
					<td>rehman</td>
					<td>2020-06-11 08:35:00</td>
					<td>2020-06-08 06:47:00</td>
                                        <td>Active</td>
                                        <td>
					<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 13px" type="submit">Activate</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 13px" type="submit">Deactivate</button>
						</form>
					</td>
                                        <td>
                                            <a href="{{ route('view_sub_admins') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_sub_admins') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>1</td>
                                        <td>HHHH</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Support Driver Admin</td>
					<td>Usama Zahid</td>
					<td>03224043816</td>
					<td>usama86774@gmail.com</td>
					<td>usama</td>
					<td>2020-06-15 13:47:00</td>
					<td>2020-06-15 13:43:00</td>
                                        <td>Active</td>
                                        <td>
					<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white; font-size: 13px" type="submit">Activate</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white; font-size: 13px" type="submit">Deactivate</button>
						</form>
					</td>
                                        <td>
                                            <a href="{{ route('view_sub_admins') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_sub_admins') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                
                                        </tbody>
		</table>
        </div>
        </div>
                                        
                                        
                                    <!-- Affiliate Role on Product List -->

                                        
<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#sub_admins').DataTable();
	});
</script>					 
				
@endsection		