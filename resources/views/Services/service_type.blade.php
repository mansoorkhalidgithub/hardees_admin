 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Manage Vehicle</h3>
                <a href="{{ route('add_service_type') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Vehicle</a>
	</div>
    <div class="uper" style=" margin-bottom: 50px">
		
                
                <!-- Admin Role on Product List -->
                
                <table class="table table-striped table-hover" id="vehicle_list" style=" font-size: 13px">
			<thead>
				<tr style="color:black">
                                        <th>#</th>
					<th>Country</th>
					<th>Selected Picture</th>
					<th>Title</th>
					<th>Capacity</th>
					<th>Base Fare</th>
					<th>Per KM Fare</th>
					<th>Per Minute Fare</th>
                                        <th>Minimum Fare</th>
					<th>Status</th>
                                        <th style="min-width: 100px">Action</th>
				</tr>
			</thead>
			<tbody>
                            <tr style="color: black">
					<td>1</td>
					<td>Pakistan</td>
					<td>0000</td>
					<td>Delivery Lahore</td>
                                        <td>1</td>
                                        <td>75</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('view_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>2</td>
					<td>Pakistan</td>
					<td>0000</td>
					<td>Delivery Multan</td>
                                        <td>1</td>
                                        <td>75</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('view_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>3</td>
					<td>Pakistan</td>
					<td>0000</td>
					<td>Delivery Islamabad</td>
                                        <td>1</td>
                                        <td>75</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('view_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>4</td>
					<td>Pakistan</td>
					<td>0000</td>
					<td>Delivery Rawalpindi</td>
                                        <td>1</td>
                                        <td>75</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('view_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_service_type') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
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
		var table = $('#vehicle_list').DataTable();
	});
</script>                               
				
		@endsection