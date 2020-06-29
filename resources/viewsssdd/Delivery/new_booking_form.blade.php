 @extends('layouts.main')
 @section('content')
 <style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#bookingForm {
  background-color: #ffffff;
  margin: auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input, select {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid, select.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

#nextBtn {
  background-color: #F6BF2D;
  color: black;
  font-weight: bold;
  border: none;
  padding: 10px 20px;
  font-size: 20px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
  color: black;
  font-weight: bold;
  border: none;
  padding: 10px 20px;
  font-size: 20px;
  font-family: Raleway;
  cursor: pointer;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #F6BF2D;
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

</style>
<body>

<form id="bookingForm" action="">
  <h1>New Booking</h1>
  <!-- One "tab" for each step in the form: -->
  <br>
  <div class="tab">
      <h3>Customer Info</h3>
      <div class="row" style="margin-bottom: 1rem">
          <div class="col-sm-10">
              <input id="searchbox" class="form-control" style="width: 100% !important;" type="search" name="keyword" placeholder="Search Old Customer by Name, Number" value="" autofocus>
          </div>
          <div class="col-sm-2">
              <input type="reset" name="Reset" value="Reset" class="btn btn-success btn-md btncustom" style="margin-left: 5px; width: 100%; border-radius:0px; border-color:black; background:black; color:#f6bf2d">
          </div>
      </div>
      <div class="row" style="margin-bottom: 1rem;">
          <div class="col-sm-6">
                <input placeholder="First name..." class="form-control" oninput="this.className = ''" name="fname">
          </div>
          <div class="col-sm-6">
                <input placeholder="Last name..." class="form-control" oninput="this.className = ''" name="lname">
          </div>
      </div>
      <div class="row" style="margin-bottom: 1rem">
          <div class="col-sm-12">
                <input placeholder="Phone..." class="form-control" oninput="this.className = ''" name="phone">
          </div>
          <div class="col-sm-12" style="margin-top: 1rem;">
                <input placeholder="Address" class="form-control" oninput="this.className = ''" name="address">
          </div>
      </div>
  </div>
  <div class="tab">
      <h3>Select City</h3>
      <p><select class="form-control textInput" data-live-search="true" data-width="100%" style="width: 100%" id="ct_id" name="Trip[iVehicleTypeId]">
                        
                        <option>Select your City for Delivery</option>
                        <option>Delivery Lahore</option>
                        <option>Delivery Multan</option>
                        <option>Delivery Gujranwala</option>
                        <option>Delivery Rawalpindi</option>
                        <option>Delivery Islamabad</option>
                        <option>Delivery Karachi</option>
                        <option>Delivery Peshawar</option>
                        
                       
                    </select>
      </p>
      <div class="row" style="padding: 0px;margin-bottom: 1rem;margin-left:0px;">
                    <div class="col-sm-10" style="padding: 0px;">
                        <input  name="drop_off_location" class="form-control textInput" type="text" value="" placeholder="Drop Off Location" style="width: 100%;">
                    </div>
                    <div class="col-sm-2">To</div>
                </div>

                <div class="row" style="padding: 0px;margin-left:0px ;margin-bottom: 1rem">
                    
                    <div class="col-sm-10" style="padding: 0px;">
                        
                        <div id="hardees_branches">
                            <select  class="form-control" data-width="100%"  name="HardeesBranches[id]">
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
                            <select readonly  class="form-control" data-width="100%"  name="Hardees_Riders">
                                <option>Riders</option>
                                
                            </select>
                        </div>
                    </div>
                </div>
  </div>
  <div class="tab">
      <h3>Menu</h3>
      <p><select class="form-control textInput" data-live-search="true" data-width="100%" style="width: 100%" id="ct_id" name="Trip[iVehicleTypeId]">
                        
                        <option>Select Category</option>
                        <option>Chargrilled Burger</option>
                        <option>Angus Burger</option>
                        <option>Sides</option>
                        <option>Beverages</option>
                        <option>Chicken Burger</option>
                       
                    </select>
      </p>
      <div class="row" style="margin-bottom: 1rem">
          <div class="row" style="margin-left:40px ;margin-bottom: 1rem">
                    
                    <div class="col-sm-4" style="padding: 20px; border: 1px dotted black; background-color: #eee;color:black">
                        <label>Philly Cheese Steak</label><br>
                        <small>Beef Patty, Cheese Suace, Tomato Suace <br> Onions, Mashrooms, Bun <br> PKR 890</small>
                        <img src="{{asset('/img/plus-button.png')}}" width="25px" height="25px" style="float:right">
                    </div>
                    <div class="col-sm-4" style="padding: 20px; border: 1px dotted black; background-color: #eee;color:black">
                        <label>Philly Cheese Steak</label><br>
                        <small>Beef Patty, Cheese Suace, Tomato Suace <br> Onions, Mashrooms, Bun <br> PKR 890</small>
                        <img src="{{asset('/img/plus-button.png')}}" width="25px" height="25px" style="float:right">
                    </div>
                    <div class="col-sm-4" style="padding: 20px; border: 1px dotted black; background-color: #eee;color:black">
                        <label>Philly Cheese Steak</label><br>
                        <small>Beef Patty, Cheese Suace, Tomato Suace <br> Onions, Mashrooms, Bun <br> PKR 890</small>
                        <img src="{{asset('/img/plus-button.png')}}" width="25px" height="25px" style="float:right">
                    </div>
                </div>
          <div class="row" style="margin-left:40px ;margin-bottom: 1rem">
                    
                    <div class="col-sm-4" style="padding: 20px; border: 1px dotted black; background-color: #eee;color:black">
                        <label>Philly Cheese Steak</label><br>
                        <small>Beef Patty, Cheese Suace, Tomato Suace <br> Onions, Mashrooms, Bun <br> PKR 890</small>
                        <img src="{{asset('/img/plus-button.png')}}" width="25px" height="25px" style="float:right">
                    </div>
                    <div class="col-sm-4" style="padding: 20px; border: 1px dotted black; background-color: #eee;color:black">
                        <label>Philly Cheese Steak</label><br>
                        <small>Beef Patty, Cheese Suace, Tomato Suace <br> Onions, Mashrooms, Bun <br> PKR 890</small>
                        <img src="{{asset('/img/plus-button.png')}}" width="25px" height="25px" style="float:right">
                    </div>
                    <div class="col-sm-4" style="padding: 20px; border: 1px dotted black; background-color: #eee;color:black">
                        <label>Philly Cheese Steak</label><br>
                        <small>Beef Patty, Cheese Suace, Tomato Suace <br> Onions, Mashrooms, Bun <br> PKR 890</small>
                        <img src="{{asset('/img/plus-button.png')}}" width="25px" height="25px" style="float:right">
                    </div>
                </div>
      </div>
  </div>

  <div class="tab">
      <h3>Order Summary</h3>
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
      <p><textarea placeholder="Note for Rider..." class="form-control" rows="4" oninput="this.className = ''" name="rider_note"></textarea>
  </div>
          <div class="col-sm-5">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d435521.40794971527!2d74.05419759728487!3d31.48263522521835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39190483e58107d9%3A0xc23abe6ccc7e2462!2sLahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1592141196058!5m2!1sen!2s" width="310" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
      </div>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Proceed to Booking";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("bookingForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
 @endsection