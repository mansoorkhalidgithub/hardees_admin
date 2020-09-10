 @extends('layouts.main') @section('content')

 <div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Delivery Boy Management System</h3>
                
	</div>
    <div class="row" style="margin-bottom:2rem; padding: 20px">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2" style="background-color:#F6BF2D; border-radius: 10px; color: black">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col-auto">
							<i class="fas fa-motorcycle fa-2x text-dark-300"></i>
						</div>
                                            <div class="col ml-5">
							<div
								class="font-weight-bold text-uppercase mb-1" style="font-size:13px">Total Delivery Boys
								</div>
							<div class="h5 mb-0 font-weight-bold text-dark-800" style="font-size:25px">60</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2 bg-success" style=" border-radius: 10px; color: white;">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col-auto">
							<i class="fas fa-motorcycle fa-2x text-light-300"></i>
						</div>
                                            <div class="col ml-5">
							<div
								class=" font-weight-bold  text-uppercase mb-1" style="font-size:13px">Total Delivery Boys
								(Online)</div>
							<div class="h5 mb-0 font-weight-bold text-light-800" style="font-size:25px">39</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow h-100 py-2 bg-secondary" style=" border-radius: 10px; color: white;">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col-auto">
							<i class="fas fa-motorcycle fa-2x text-light-300"></i>
						</div>
                                            <div class="col ml-5">
							<div
								class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size:13px">Total Delivery Boys
								(Offline)</div>
							<div class="h5 mb-0 font-weight-bold text-light-800" style="font-size:25px">21</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		
	</div>
     <div class="row" style="padding: 20px">
        <div class="col-sm-2">
            <select style="height: 35px; border-radius: 10px; width: 100%; border:1px solid black; font-size: 13px">
                <option>Select Country</option>
                <option>Pakistan</option>
                <option>Dubai</option>
                <option>United States</option>
            </select>
        </div>
        <div class="col-sm-2">
            <select style="height: 35px; border-radius: 10px; width: 100%; border:1px solid black; font-size: 13px">
                <option>Select State</option>
                <option>Punjab</option>
                <option>Sindh</option>
                <option>Balochistan</option>
                <option>KPK</option>
                <option>Fedral Capital Area</option>
                <option>Gilgit</option>
            </select>
        </div>
        <div class="col-sm-3">
            
            <select style="height: 35px; border-radius: 10px; width: 100%; border:1px solid black; font-size: 13px">
                <option>Select City</option>
                <option>Lahore</option>
                <option>Karachi</option>
                <option>Islamabad</option>
                <option>Peshawar</option>
                <option>Multan</option>
                <option>Faisalabad</option>
                <option>Rawalpindi</option>
            </select>
            
        </div>
        <div class="col-sm-3">
            
            <select style="height: 35px; border-radius: 10px; width: 100%; border:1px solid black; font-size: 13px">
                <option>Select Branch</option>
                <option>M.M Alam Branch</option>
                <option>DHA Branch</option>
                <option>Lalik Chowk Branch</option>
                <option>Emporium Mall Branch</option>
                <option>Thokar Niaz Baig Branch</option>
                <option>Packages Mall Branch</option>
            </select>
            
        </div>
        <div class="col-sm-2 text-right">
            <button type="button" style="height: 35px; width: 100%;" class="btn btn-success">Search</button>
        </div>
        
    </div>
	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px; margin-top: 50px; font-size: 13px">
		 
                
                <!-- Admin Role on Product List -->
                
               
                <table class="table table-striped table-hover" id="rider_list" style="min-width: fit-content; font-size: 13px">
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
					<th style="min-width: 100px">Trip Status</th>
					<th>History</th>
					<th>Credit/Debit</th>
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
							<button class="btn" style="background-color:  white; color: red; font-size: 13px" type="submit">On Trip</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form--></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white; font-size: 13px" type="submit">Dr Rs 14</button></td>
                                        
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
                                        <td><!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  white; color: red" type="submit">On Trip</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white; font-size: 13px" type="submit">Dr Rs 14</button></td>
                                        
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
							<button class="btn" style="background-color:  white; color: red; font-size: 13px" type="submit">On Trip</button>
						</form>
                                             
						<!--form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form--></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white; font-size: 13px" type="submit">Dr Rs 27</button></td>
                                        
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
                                        <td><!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Online</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  #dc3545; color: white" type="submit">Offline</button>
						</form></td>
                                        <td><!--form action="" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  white; color: red" type="submit">On Trip</button>
						</form-->
                                             
						<form action="" method="post">
							@csrf @method('POST')
                                                        <button class="btn" style="background-color:  white; color: black" type="submit">Free</button>
						</form></td>
                                        <td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
                                        <td><button class="btn" style="background-color:  #dc3545; color: white; font-size: 13px" type="submit">Dr Rs 14</button></td>
                                        
                                </tr>
                                        </tbody>
		</table>
        </div>
</div>
                                        
                                        
				 
				
@endsection		