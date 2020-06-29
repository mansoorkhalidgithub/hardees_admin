 @extends('layouts.main') @section('content')

 <div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">ZONE LIST</h3>
                <a href="{{ route('add_zone') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Zone</a>
                
	</div>
	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px;">
		 
                
                <!-- Admin Role on Product List -->
                
               
                <table class="table table-striped table-hover" style=" font-size: 13px">
			<thead>
				<tr style="color:black">
                                        <th>Sr.</th>
                                        <th>Zone Name</th>
					<th>Country</th>
					<th>State</th>
                                        <th>City</th>
					<th>Latitude</th>
					<th>Longitude</th>
                                        <th style="min-width:80px">Areas</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
                                
			</thead>
                        <tbody style="color: black">
				<tr>
					<td>1</td>
                                        <td>Zone 1</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>37.15687</td>
					<td>45.15968</td>
					<td>DHA Phase (IV), M.M. Alam, Lalik Chowk</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('update_zone') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>2</td>
                                        <td>Zone 2</td>
					<td>Pakitan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>37.15687</td>
					<td>45.15968</td>
					<td>Thokar, Emporium, Packages</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('update_zone') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>3</td>
                                        <td>Zone 3</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Multan</td>
					<td>37.15687</td>
					<td>45.15968</td>
					<td>Multan, Guldasht Colony</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('update_zone') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>4</td>
                                        <td>Zone 4</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Gujranwala</td>
					<td>37.15687</td>
					<td>45.15968</td>
					<td>Truck Adda, MOG</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('update_zone') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                
                                        </tbody>
		</table>
        </div>
</div>

                                      
					 
				
@endsection		