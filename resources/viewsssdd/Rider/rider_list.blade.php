 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Riders List</h3>
                <a href="{{ route('add_rider') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Rider</a>
	</div>
    <div class="uper" style="overflow-x: scroll; margin-bottom: 50px">
		
                
                <!-- Admin Role on Product List -->
                
                <table class="table table-striped table-hover" id="rider_list" style=" font-size: 13px">
			<thead>
				<tr style="color:black">
                                        <th>#</th>
					<th>User</th>
					<th>Restaurant</th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Name</th>
					<th>Area</th>
					<th>Mobile No.</th>
					<th>Email</th>
                                        <th style="min-width: 80px">Vehical No.</th>
					<th>Avg. Rating</th>
					<th>Approval/Pending</th>
					<th>Current Status</th>
					<th>Offline/Online</th>
					<th style="min-width: 80px">Trip Status</th>
					<th>History</th>
					<th>Credit/Debit</th>
                                        <th style="min-width: 100px;">Action</th>
				</tr>
			</thead>
			<tbody>
                            <tr style="color: black">
					<td>1</td>
					<td>0000</td>
					<td>Hardees Peshawar</td>
					<td>Pakistan</td>
					<td>Federal Capital Area</td>
                                        <td>Peshawar</td>
                                        <td>Nawab Khan</td>
                                        <td>Delivery Peshawar Pakistan</td>
                                        <td>3329384449</td>
                                        <td>nawabrider1122@gmail.com</td>
                                        <td>LA6315</td>
                                        <td>1</td>
                                        <td>Approved</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Online</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Offline</button>
						</form--></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  white; color: red" type="submit">On Trip</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form--></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white" type="submit">Dr Rs 14</button></td>
                                        
                                        <td>
                                            <a href="{{ route('view_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>2</td>
					<td>0000</td>
					<td>Hardees MOG</td>
					<td>Pakistan</td>
					<td>Punjab</td>
                                        <td>Gujranwala</td>
                                        <td>Adnan Kennst</td>
                                        <td>Delivery Gujranwala Pakistan</td>
                                        <td>3217421648</td>
                                        <td>adnanrider1122@gmail.com</td>
                                        <td>GAN551</td>
                                        <td>1</td>
                                        <td>Approved</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<!--button class="btn" style="background-color:  #28a745; color: white" type="submit">Online</button-->
						</form>
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Offline</button>
						</form></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form--></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white" type="submit">Dr Rs 14</button></td>
                                        
                                        <td>
                                            <a href="{{ route('view_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>3</td>
					<td>0000</td>
					<td>Hardees Bahria Rawalpindi</td>
					<td>Pakistan</td>
					<td>Punjab</td>
                                        <td>Bhera</td>
                                        <td>Suleman Asghar</td>
                                        <td>Delivery Rawalpindi Pakistan</td>
                                        <td>3462162940</td>
                                        <td>ssulemanasghar@gmail.com</td>
                                        <td>RIM2878</td>
                                        <td>0</td>
                                        <td>Approved</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Online</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Offline</button>
						</form--></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  white; color: red" type="submit">On Trip</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form--></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white" type="submit">Dr Rs 27</button></td>
                                        
                                        <td>
                                            <a href="{{ route('view_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr style="color: black">
					<td>4</td>
					<td>0000</td>
					<td>Gujranwala Food Truck</td>
					<td>Pakistan</td>
					<td>Punjab</td>
                                        <td>Gujranwala</td>
                                        <td>Amir Sohail</td>
                                        <td>Delivery Gujranwala Pakistan</td>
                                        <td>3091598397</td>
                                        <td>amirrider1122@gmail.com</td>
                                        <td>GAV2568</td>
                                        <td>1</td>
                                        <td>Approved</td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Active</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactive</button>
						</form--></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Online</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Offline</button>
						</form--></td>
                                        <td><form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  white; color: red" type="submit">On Trip</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form--></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white" type="submit">Dr Rs 14</button></td>
                                        
                                        <td>
                                            <a href="{{ route('view_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_riders_details') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
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
		var table = $('#rider_list').DataTable();
	});
</script>                               
				
		@endsection