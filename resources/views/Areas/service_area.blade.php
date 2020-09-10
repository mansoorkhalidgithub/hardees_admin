 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Manage Areas</h3>
                <a href="{{ route('new_area') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Area</a>
	</div>
    <div class="uper" style=" margin-bottom: 50px">
		
                
                <!-- Admin Role on Product List -->
                
                <table class="table table-striped table-hover" id="area_list" style=" font-size: 13px">
			<thead>
				<tr style="color:black">
                                        <th>#</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Car Type</th>
					<th>Area Name</th>
					<th>Created Date</th>
					<th>Status</th>
                                        <th style="min-width: 100px">Action</th>
				</tr>
			</thead>
			<tbody>
                            <tr style="color: black">
					<td>1</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
                                        <td>Delivery Lahore</td>
                                        <td>Lahore</td>
                                        <td>2020-03-21 06:31:00</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        
					<td>
                                            <a href="{{ route('view_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>2</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Multan</td>
                                        <td>Multan Delivery</td>
                                        <td>Multan Delivery</td>
                                        <td>2020-04-30 16:36:00</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('view_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>3</td>
					<td>Pakistan</td>
					<td>Federal Capital Area</td>
					<td>Islamabad</td>
                                        <td>Delivery islamabad</td>
                                        <td>Delivery islamabad</td>
                                        <td>2020-05-04 16:22:00</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('view_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>4</td>
					<td>Pakistan</td>
					<td>Federal Capital Area</td>
					<td>Rawalpindi</td>
                                        <td>Delivery Rawalpindi</td>
                                        <td>Delivery Rawalpindi</td>
                                        <td>2020-05-06 16:59:00</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>                                        
                                        <td>
                                            <a href="{{ route('view_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_area') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
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
		var table = $('#area_list').DataTable();
	});
</script>                               
				
		@endsection