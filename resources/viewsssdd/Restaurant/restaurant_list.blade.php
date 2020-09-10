 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Restaurant List</h3>
                
                <a href="{{ route('restaurant.create') }}"
			class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold"  style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add Restaurant</a>
                        
	</div>
	<div class="uper">
		
                
                <!-- Admin Role on Product List -->
                
               
                <table class="table table-striped table-hover" id="branches">
			<thead>
				<tr style="color:black">
					<th>Name</th>
					<th>Code</th>
					<th>Timing</th>
					<th>Brand</th>
					<th>Status</th>
					<th>Action</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Packages Mall</td>
					<td>HR0001</td>
					<td>1000 - 2200</td>
					<td>Fast Food</td>
					<td >Active</td>
                                        <td>
						<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Activate</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactivate</button>
						</form>
                                             
					</td>
                                        <td>
                                            <a href="{{ route('view_restaurant') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_restaurant') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>DHA</td>
					<td>Mc0002</td>
					<td>1100 - 0000</td>
					<td>Fast Food</td>
					<td >Active</td>
                                        <td>
						<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Activate</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactivate</button>
						</form>
                                             
					</td>
                                        <td>
                                            <a href="{{ route('view_restaurant') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_restaurant') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>M.M Alam</td>
					<td>HR0003</td>
					<td>1230 - 2330</td>
					<td>Fast Food</td>
					<td >Deactive</td>
                                        <td>
						<form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Activate</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactivate</button>
						</form-->
                                             
					</td>
                                        <td>
                                            <a href="{{ route('view_restaurant') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_restaurant') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
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
		var table = $('#branches').DataTable();
	});
</script>				 
				
		@endsection