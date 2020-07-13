@extends('layouts.main')

@section('title', 'Order Booking')
 
@section('content')

<style>* {
    margin: 0;
    padding: 0
	}

	p {
		color: grey
	}

	#heading {
		text-transform: uppercase;
		color: #673AB7;
		font-weight: normal
	}

	#msform {
		text-align: center;
		position: relative;
		margin-top: 20px
	}

	#msform fieldset {
		background: transparent;
		border: 0 none;
		border-radius: 0.5rem;
		box-sizing: border-box;
		width: 100%;
		margin: 0;
		padding-bottom: 20px;
		position: relative
	}

	.form-card {
		text-align: left
	}

	#msform fieldset:not(:first-of-type) {
		display: none
	}

	#msform input,
	#msform textarea,
	#msform select{
		padding: 8px 15px 8px 15px;
		border: 1px solid #ccc;
		border-radius: 0px;
		margin-bottom: 25px;
		margin-top: 2px;
		width: 100%;
		box-sizing: border-box;
		font-family: montserrat;
		color: #2C3E50;
		background-color: #ECEFF1;
		font-size: 16px;
		letter-spacing: 1px
	}

	#msform input:focus,
	#msform textarea:focus,
	#msform select:focus{
		-moz-box-shadow: none !important;
		-webkit-box-shadow: none !important;
		box-shadow: none !important;
		border: 1px solid #FEC52E;
		outline-width: 0
	}

	#msform .action-button {
		width: 100px;
		background: #FEC52E;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 0px 10px 5px;
		float: right
	}

	#msform .action-button:hover,
	#msform .action-button:focus {
		background-color: #FEC52E
	}

	#msform .action-button-previous {
		width: 100px;
		background: #616161;
		font-weight: bold;
		color: white;
		border: 0 none;
		border-radius: 0px;
		cursor: pointer;
		padding: 10px 5px;
		margin: 10px 5px 10px 0px;
		float: right
	}

	#msform .action-button-previous:hover,
	#msform .action-button-previous:focus {
		background-color: #000000
	}

	.card {
		z-index: 0;
		border: none;
		position: relative
	}

	.fs-title {
		font-size: 18px;
		color: black;
		font-weight: normal;
		text-align: left
	}

	.purple-text {
		color: #FEC52E;
		font-weight: normal
	}

	.steps {
		font-size: 15px;
		color: black;
		margin-bottom: 6px;
		font-weight: normal;
		text-align: right
	}

	.fieldlabels {
		color: gray;
		text-align: left
	}

	#progressbar {
		margin-bottom: 18px;
		overflow: hidden;
		color: lightgrey
	}

	#progressbar .active {
		color: #FEC52E;
	}

	#progressbar li {
		list-style-type: none;
		font-size: 12px;
		width: 20%;
		float: left;
		position: relative;
		font-weight: 400
	}

	#progressbar #info:before {
		font-family: FontAwesome;
		content: "\f007"
	}

	#progressbar #menu:before {
		font-family: FontAwesome;
		content: "\f0f4"
	}

	#progressbar #dropoff:before {
		font-family: FontAwesome;
		content: "\f015"
	}

	#progressbar #summary:before {
		font-family: FontAwesome;
		content: "\f07a"
	}

	#progressbar #finish:before {
		font-family: FontAwesome;
		content: "\f00c"
	}

	#progressbar li:before {
		width: 50px;
		height: 50px;
		line-height: 45px;
		display: block;
		font-size: 20px;
		color: black;
		background: lightgray;
		border-radius: 50%;
		margin: 0 auto 10px auto;
		padding: 2px
	}

	#progressbar li:after {
		content: '';
		width: 100%;
		height: 2px;
		background: lightgray;
		position: absolute;
		left: 0;
		top: 25px;
		z-index: -1
	}

	#progressbar li.active:before,
	#progressbar li.active:after {
		background: #FEC52E;
	}

	.progress {
		height: 20px
	}

	.progress-bar {
		background-color: #FEC52E;
	}

	.fit-image {
		width: 50%;
		height: 100%;
		object-fit: cover;
	}
					  .cart_totals {
	  font-size: 15px;
	  color: #666;
	  width: 66.56%;
	  margin: auto;
	  margin-bottom: 31px; }
	  .cart_totals table {
		width: 100%; }
	  .cart_totals th, .cart_totals td {
		padding: 11px 0;
		vertical-align: top;
		text-align: left; }
	  .cart_totals th {
		font-family: "Lato-Bold";
		color: #333;
		text-align: left;
		width: 65.81%; }
		.cart_totals th span {
		  color: #999;
		  font-size: 14px; }
	  .cart_totals .order-total th, .cart_totals .order-total td {
		padding: 12px 0;
		color: #333;
		font-family: "Lato-Bold"; }

	  .col-sm-2
	  {
		  margin: auto;
	  }
	.popup {
	  position: relative;
	  display: inline-block;
	  cursor: pointer;
	  -webkit-user-select: none;
	  -moz-user-select: none;
	  -ms-user-select: none;
	  user-select: none;
	}

	/* The actual popup */
	.popup .popuptext {
	  visibility: hidden;
	  width: 160px;
	  background-color: rgba(0,0,0,0.8);
	  color: #fff;
	  text-align: center;
	  border-radius: 6px;
	  padding: 8px 0;
	  position: absolute;
	  z-index: 1;
	  bottom: 125%;
	  left: 50%;
	  margin-left: -80px;
	}

	/* Popup arrow */
	.popup .popuptext::after {
	  content: "";
	  position: absolute;
	  top: 100%;
	  left: 50%;
	  margin-left: -5px;
	  border-width: 5px;
	  border-style: solid;
	  border-color: #555 transparent transparent transparent;
	}

	/* Toggle this class - hide and show the popup */
	.popup .show {
	  visibility: visible;
	  -webkit-animation: fadeIn 1s;
	  animation: fadeIn 1s;
	}

	/* Add animation (fade in the popup) */
	@-webkit-keyframes fadeIn {
	  from {opacity: 0;}
	  to {opacity: 1;}
	}

	@keyframes fadeIn {
	  from {opacity: 0;}
	  to {opacity:1 ;}
	}
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;
		var current = 1;
		var steps = $("fieldset").length;

		setProgressBar(current);

		$(".next").click(function(e){
			
			e.preventDefault();
			
			// var bookingForm = $("#msform");
			
			// var validator = bookingForm.validate({
				
				// rules:{
					// first_name : {
						// required : true 
					// },
				// },
				// messages:{
					// first_name :{
						// required : "This field is required"
					// },
					
				// });
			// });
			
			current_fs = $(this).parent();
			next_fs = $(this).parent().next();

			//Add Class Active
			$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({'opacity': opacity});
				},
				duration: 500
			});
			setProgressBar(++current);
		});

		$(".previous").click(function(){

			current_fs = $(this).parent();
			previous_fs = $(this).parent().prev();

			//Remove class active
			$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

			//show the previous fieldset
			previous_fs.show();

			//hide the current fieldset with style
			current_fs.animate({opacity: 0}, {
				step: function(now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					previous_fs.css({'opacity': opacity});
				},
				duration: 500
			});
			setProgressBar(--current);
		});

		function setProgressBar(curStep){
			var percent = parseFloat(100 / steps) * curStep;
			percent = percent.toFixed();
			$(".progress-bar")
			.css("width",percent+"%")
		}

		$(".submit").click(function(){
			return false;
		})

	});
</script>
</head>
<body>
    <div style="margin: 0px 10px 10px 10px; padding: 20px; background-color: white">
        <div>
			<div>
				<div class="card" style="background-color: transparent">
					<form id="msform">
						<!-- progressbar -->
						<ul id="progressbar">
							<li class="active" id="info" style="color:black"><strong>Customer Info</strong></li>
							<li id="menu" style="color:black"><strong>Menu</strong></li>
							<li id="dropoff" style="color:black"><strong>DropOff Location</strong></li>
							<li id="summary" style="color:black"><strong>Order Summary</strong></li>
							<li id="finish" style="color:black"><strong>Finish</strong></li>
						</ul>
						<div class="progress">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
						</div> <br> <!-- fieldsets -->
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h4 class="fs-title"></h4>
									</div>
									<div class="col-5">
										<h4 class="steps">Step 1 - 5</h4>
									</div>
								</div> 
								<div class="row" >
									<div class="col-sm-10">
										<input id="searchbox" class="form-control" style="width: 100% !important;" type="search" name="keyword" placeholder="Search Old Customer by Name, Number" value="" autofocus>
									</div>
									<div class="col-sm-2">
										<input type="reset"  name="Reset" value="Reset" class="btn btn-success btn-md btncustom" style="margin-left: 5px; width: 100%; border-radius:0px; border-color:black; background:black; color:#f6bf2d">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<input type="text" id="first_name" name="first_name" placeholder="First Name" />
									</div>
									<div class="col-sm-6">
										<input type="text" name="last_name" placeholder="Last Name" />
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<input type="tel" name="phone" placeholder="Enter Phone Number" />
									</div>
									<div class="col-sm-6">
										<input type="text" name="address" placeholder="Enter your Address" />
									</div>
								</div>
							</div> 
							
							<input type="button" name="next" class="next action-button" value="Next" style="color: black"/> 
						</fieldset>
						
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h4 class="fs-title"></h4>
									</div>
									<div class="col-5">
										<h4 class="steps">Step 2 - 5</h4>
									</div>
								</div> 
								
								<p style="margin: 0px 10px">
									<select class="form-control textInput" data-live-search="true" data-width="100%" style="width: 100%; border-radius: 0px;" id="ct_id" name="Trip[iVehicleTypeId]">

										<option>Select Category</option>
										<option>Chargrilled Burger</option>
										<option>Angus Burger</option>
										<option>Sides</option>
										<option>Beverages</option>
										<option>Chicken Burger</option>

									</select>
								</p>

								<div class="row" style="margin: 0px 10px 10px 10px">

									<div class="col-sm-2" style="padding: 20px; border-radius: 40px; background-color: #eee;color:black">
										<p><strong>Philly Cheese Steak</strong></p>
										<div class="popup" onmouseover="myFunction()" onmouseout="myFunctionClose()"><img src="{{asset('/img/17.png')}}" width="150px" height="100px"  style="display: block;margin-left: -15px; margin-right: auto">
											<span class="popuptext" id="myPopup"><small>Beef Patty, Cheese Suace, Tomato Suace <br> Onions, Mashrooms, Bun <br> PKR 890</small></span>
										</div>

										<img src="{{asset('/img/plus-button.png')}}" width="25px" height="25px" style="display: block;margin-left: auto; margin-right: auto">
									</div>
									
								</div>
							
							</div> 
							
							<input type="button" name="next" class="next action-button" value="Next"  style="color: black"/> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h4 class="fs-title"></h4>
									</div>
									<div class="col-5">
										<h4 class="steps">Step 3 - 5</h4>
									</div>
								</div> 
								
								<p>
								
									<select class="form-control textInput abcdefgh" data-live-search="true" data-width="100%" style="width: 100%; border-radius: 0px" id="ct_id"  name="Trip[iVehicleTypeId]">

										<option  selected="true" disabled="disabled">Select your City for Delivery</option>
										<option>Delivery Lahore</option>
										<option>Delivery Multan</option>
										<option>Delivery Gujranwala</option>
										<option>Delivery Rawalpindi</option>
										<option>Delivery Islamabad</option>
										<option>Delivery Karachi</option>
										<option>Delivery Peshawar</option>


									</select>
								</p>
							
								<div class="row" style="padding: 0px;margin-left:0px;">
									<div class="col-sm-10" style="padding: 0px;">
										<input  name="drop_off_location" class="form-control textInput abcdefgh" type="text" value="" placeholder="Drop Off Location" style="width: 100%;">
									</div>
									<div class="col-sm-2">To</div>
								</div>

								<div class="row" style="padding: 0px;margin-left:0px ;margin-bottom: 1rem">

									<div class="col-sm-10" style="padding: 0px;">

										<div id="hardees_branches">
											<select readonly class="form-control" data-width="100%" style="border-radius: 0px"  name="HardeesBranches[id]">
												<option>Select Branch</option>
												<option>MM Alam</option>
												<option>Mall Road</option>
												<option>Giga Mall</option>
												<option>F 11/4 Islamabad</option>
												<option>Gulberg</option>
												<option>Packages Mall</option>
												<option>DHA</option>
											</select>
										</div>
									</div>
									<div class="col-sm-2">From</div>
								</div>
							
								<div class="row" style="padding: 0px;margin-left:0px ;margin-bottom: 1rem">

									<div class="col-sm-12" style="padding: 0px;">

										<div id="hardees_branches">
											<select readonly  class="form-control" data-width="100%" style="border-radius: 0px"  name="Hardees_Riders">
												<option>Riders</option>
											</select>
										</div>
									</div>
								</div>
							</div> 
							
							<input type="button" name="next" class="next action-button" value="Next"  style="color: black"/> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h4 class="fs-title"></h4>
									</div>
									<div class="col-5">
										<h4 class="steps">Step 4 - 5</h4>
									</div>
								</div> 
								
								<div class="row">
								  <table id="restaurants" class="table table-striped">
									<thead>
									  <tr>
										<th scope="col">Sr. #</th>
										<th scope="col">Item</th>
										<th scope="col">Price (PKR)</th>
										<th scope="col">Qty.</th>
										<th scope="col">Total</th>
																						<th>Action</th>
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<th scope="row"> 1 </th>
										<td> Angus Burger </td>
										<td> 890 </td>
										<td> 2 </td>
										<td> 1780 </td>
																						<td><img src="{{asset('/img/plus-button copy.png')}}" width="20px" height="20px"></td>
									  </tr>
																				<tr>
										<th scope="row"> 2 </th>
										<td> Jalapeno Burger </td>
										<td> 690 </td>
										<td> 2 </td>
										<td> 1380 </td>
																						<td><img src="{{asset('/img/plus-button copy.png')}}" width="20px" height="20px"></td>
									  </tr>
																				<tr>
										<th scope="row"> 3 </th>
										<td> Cheese Burger </td>
										<td> 590 </td>
										<td> 2 </td>
										<td> 1180 </td>
																						<td><img src="{{asset('/img/plus-button copy.png')}}" width="20px" height="20px"></td>
									  </tr>
									</tbody>

								  </table>
								</div>
								
								<div class="row">
									<div class="col-sm-7">
										<div class="cart_totals">
											<table cellspacing="0">
												<tr>
													<th>Subtotal</th>
													<td data-title="Subtotal">
														<span>
															<span>PKR </span>1130
														</span>
													</td>
												</tr>
												<tr>
													<th>Estimated Time:</th>
													<td data-title="Subtotal">

														<span>10 - 15 mins</span>
													</td>
												</tr>
												<tr>
													<th>Service Tax</th>
													<td data-title="Subtotal">
														<span>
															<span>PKR </span>280
														</span>
													</td>
												</tr>
												<tr class="order-total border-0">
													<th>Total</th>
													<td data-title="Total">
														<span>
															<span>PKR </span>1410
														</span>
													</td>
												</tr>
											</table>
										</div>
										<p>
										<textarea placeholder="Note for Rider..." class="form-control" rows="4" style="border-radius: 0px" oninput="this.className = ''" name="rider_note"></textarea></p>
									</div>
									<div class="col-sm-5">
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d435521.40794971527!2d74.05419759728487!3d31.48263522521835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190483e58107d9%3A0xc23abe6ccc7e2462!2sLahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1592141196058!5m2!1sen!2s" width="500" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
									</div>
								</div>
							</div> 
							
							<input type="button" name="next" class="next action-button" value="Submit"  style="color: black"/> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
						</fieldset>
						<fieldset>
							<div class="form-card">
								<div class="row">
									<div class="col-7">
										<h4 class="fs-title"></h4>
									</div>
									<div class="col-5">
										<h4 class="steps">Step 5 - 5</h4>
									</div>
								</div>
								<h4 class="text-center" style="color:black"><strong>SUCCESS !</strong></h4> <br>
								<div class="row justify-content-center">
									<div class="col-3 text-center"> <img src="{{asset('/img/GwStPmg.png')}}" class="fit-image" > </div>
								</div> <br>
								<div class="row justify-content-center">
									<div class="col-7 text-center">
										<h5 class="text-center" style="color: black">You Order have been Successfully Completed!</h5>
									</div>
								</div>
							</div>
							<a href="{{ route('booking') }}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #FEC52E; color: black">Book a New Order!</a>
						</fieldset>
					</form>
				</div>
        </div>
    </div>
</div>


<script>
	// When the user clicks on div, open the popup

	function myFunction() {
		var popup = document.getElementById("myPopup");
		popup.classList.toggle("show");
	}

	function myFunctionClose() {
		var popup_close = document.getElementById("myPopup");
		popup_close.classList.toggle("hide");
	}
	
	/************* Form Validation ****************/
	$(document).ready(function() {
		$("#next").click(function(){
			
			
		});
	});
	
	

</script>

@endsection