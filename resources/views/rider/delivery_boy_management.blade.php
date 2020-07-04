 @extends('layouts.main') @section('content')

 <div style="margin: 0px 10px 10px 10px">
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
 							<div class="font-weight-bold text-uppercase mb-1" style="font-size:13px">Total Delivery Boys
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
 							<div class=" font-weight-bold  text-uppercase mb-1" style="font-size:13px">Total Delivery Boys
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
 							<div class="text-xs font-weight-bold  text-uppercase mb-1" style="font-size:13px">Total Delivery Boys
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
 				<option value="Pakistan">Pakistan</option>
 				<option value="Dubai">Dubai</option>
 				<option value="United State">United States</option>
 			</select>
 		</div>
 		<div class="col-sm-2">
 			<select id="state_id" style="height: 35px; border-radius: 10px; width: 100%; border:1px solid black; font-size: 13px">
 				<option selected="" disabled="" hidden="">Select State</option>
 				@foreach(Helper::getStates() as $key=> $state)
 				<option value="{{$state->name}}">{{$state->name}}</option>
 				@endforeach
 			</select>
 			</select>
 		</div>
 		<div class="col-sm-3">

 			<select id="city_id" style="height: 35px; border-radius: 10px; width: 100%; border:1px solid black; font-size: 13px">
 				<option selected="" disabled="" hidden="">Select City</option>
 				@foreach($cities as $key => $city )
 				<option value="{{ $city }}">{{ $city }}</option>
 				@endforeach
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

 		<table class="table table-striped table-hover" id="rider_list" style="min-width: fit-content; font-size: 13px">
 			<thead>
 				<tr style="color:black">
 					<th>#</th>
 					<th>Created By</th>
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
 				</tr>
 			</thead>
 			<tbody>
 				@foreach($model as $key => $rider)
 				<tr style="color: black">
 					<td>1</td>
 					<td>
 						@if(!empty($rider->created_by))
 						{{ $rider->createdBy->username }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($rider->restaurant_id))
 						{{ $rider->getRestaurant->name }}
 						@else
 						Not set
 						@endif</td>
 					<td>
 						@if(!empty($rider->country_id))
 						{{ $rider->country->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($rider->state_id))
 						{{ $rider->state->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td>
 						@if(!empty($rider->city_id))
 						{{ $rider->city->name }}
 						@else
 						Not set
 						@endif
 					</td>
 					<td> {{ $rider->first_name }} {{$rider->last_name}} </td>
 					<td>Delivery Peshawar Pakistan</td>
 					<td> {{ $rider->phone_number }} </td>
 					<td> {{ $rider->email }} </td>
 					<td>LA6315</td>
 					<td>1</td>
 					<td>Approved</td>
 					<td>
 						<a href="{{ route('rider.status', $rider->id) }}" class="btn {{ ($rider->status === 1) ? 'btn-success' : 'btn-danger' }}" style=" color: white;width:6rem">
 							@if($rider->status === 0) Activate @elseif($rider->status === 1) Deactivate @endif
 						</a>
 					</td>
 					<td>
 						<a href="{{ route('rider.eStatus', $rider->id) }}" class="btn {{ ($rider->eStatus===10) ? 'btn-success' : 'btn-danger' }}" style="color: white;width:6rem">
 							@if($rider->eStatus === 10) Online @elseif($rider->eStatus === 9) Offline @endif
 						</a>
 					</td>
 					<td>
 						<form action="" method="post">
 							@csrf @method('POST')
 							<button class="btn" style="background-color:  white; color: red" type="submit">On Trip</button>
 						</form>
 					</td>
 					<td><button class="btn" style="background-color:  white; color: black;" type="submit">History</button></td>
 					<td><button class="btn" style="background-color:  #dc3545; color: white" type="submit">Dr Rs 14</button></td>

 				</tr>
 				@endforeach
 			</tbody>
 		</table>
 	</div>
 </div>
 @endsection

 <script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
 <script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



 <script>
 	$(document).ready(function() {
 		$.noConflict();
 		var table = $('#rider_list').DataTable();
 		$('#state_id').on('change', function() {
 			table.columns(4).search(this.value).draw();
 		});
 		$('#city_id').on('change', function() {
 			table.columns(5).search(this.value).draw();
 		});
 	});
 </script>