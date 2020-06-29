 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Manage City</h3>
                <a href="{{ route('add_city') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New City</a>
	</div>
    <div class="uper" style=" margin-bottom: 50px">
		
                
                <!-- Admin Role on Product List -->
                
                <table class="table table-striped table-hover" id="city_list" style=" font-size: 13px">
			<thead>
				<tr style="color:black">
                                        <th>#</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
                            <tr style="color: black">
					<td>1</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('update_city') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>2</td>
					<td>Pakistan</td>
					<td>Sindh</td>
					<td>Karachi</td>
                                        <td><!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form></td>                                        
                                        <td>
                                            <a href="{{ route('update_city') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>3</td>
					<td>Pakistan</td>
					<td>Federal Capital Area</td>
					<td>Islamabad</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('update_city') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>4</td>
					<td>Pakistan</td>
					<td>KPK</td>
					<td>Peshawar</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('update_city') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
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
		var table = $('#city_list').DataTable();
	});
</script>                               
				
		@endsection