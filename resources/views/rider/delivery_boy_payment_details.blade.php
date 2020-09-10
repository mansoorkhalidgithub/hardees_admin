 @extends('layouts.main') @section('content')
 <!--style>
     /* Dropdown Button */
.dropbtn {
  background-color: #eee;
  color: black;
  font-size: 12px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #eee;
}

/* The search field */
#myInput {
  box-sizing: border-box;
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 18px;
  border: none;
  border-bottom: 1px solid #ddd;
}

/* The search field when it gets focus/clicked on */
#myInput:focus {outline: 3px solid #ddd;}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  min-width: 200px;
  height: 200px;
  overflow-y: scroll;
  background-color: #f6f6f6;
  border: 1px solid #ddd;
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  font-size: 14px;
  padding: 5px 20px;
  text-decoration: none;
  display: block;
}

/* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
.show {display:block;}
 </style-->
<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Delivery Boy Payment Section</h3>
                
	</div>
    <div class="row">
        <div class="col-sm-2">
            <select style="height: 35px; border-radius: 10px; width: 100%; border:none; font-size: 13px">
                <option>Select Delivery Boy</option>
                <option>Select Delivery Boy</option>
                <option>Select Delivery Boy</option>
                <option>Select Delivery Boy</option>
            </select>
        </div>
        <div class="col-sm-2">
            <select style="height: 35px; border-radius: 10px; width: 100%; border:none; font-size: 13px">
                <option>Select Payment Method</option>
                <option>Cash</option>
                <option>Online</option>
            </select>
        </div>
        <div class="col-sm-2 text-center">
            
            <select style="height: 35px; border-radius: 10px;width:100%; border:none; font-size: 13px">
                <option>Select Date Range</option>
                <option>Today</option>
                <option>Yesterday</option>
                <option>3 Days</option>
                <option>1 Week</option>
                <option>1 Month</option>
                <option>3 Months</option>
            </select>
        </div>
          <div class="col-sm-4 text-center">
                <input style="height: 35px; border-radius: 10px; border:none;  font-size: 13px" type="date" placeholder="DD/MM/YYYY">
            
            
                <input style="height: 35px; border-radius: 10px; border:none;  font-size: 13px" type="date" placeholder="DD/MM/YYYY">
            
        </div>
        <div class="col-sm-2 text-right">
            <button type="button" style="height: 35px; width: 100%;" class="btn btn-success">Submit</button>
        </div>
        
    </div>
	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px; margin-top: 50px">
		 
                
                <!-- Admin Role on Product List -->
                
               
                <table class="table table-striped table-hover" >
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
					<th style="min-width:60px">Total Rides</th>
					<th>Total Commission</th>
					<th style="min-width:20px">Paid By</th>
					<th style="min-width:40px">Paid Through</th>
				</tr>
				<!--tr style="color:black">
                                        <th></th>
					<th></th>
                                        <th>
                                            <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Select Restaurant</button>
  <div id="myDropdown" class="dropdown-content">
      <input type="text" placeholder="Search.." id="myInput" class="form-control" onkeyup="filterFunction()">
    <a href="#">M.M Alam</a>
    <a href="#">Hardees MOG</a>
    <a href="#">Hardees Truck Adda</a>
    <a href="#">Hardees Guldasht Colony</a>
    <a href="#">Hardees Faisalabad</a>
  </div>
</div>
                                        </th>
					<th>Country</th>
					<th>State</th>
					<th>City</th>
					<th>Name</th>
					<th>Area</th>
					<th>Mobile No.</th>
					<th>Email</th>
                                        <th style="min-width: 80px">Vehical No.</th>
					<th style="min-width:60px">Total Rides</th>
					<th>Total Commission</th>
					<th style="min-width:20px">Paid By</th>
					<th style="min-width:40px">Paid Through</th>
				</tr-->
			</thead>
                        <tbody style="color:black">
				<tr>
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
					<td>16</td>
					<td>1270</td>
                                        <td><input type="text" name="signatury"></td>
                                        <td><input type="text" name="signatury"></td>
                                </tr>
				<tr>
					<td>2</td>
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
					<td>16</td>
					<td>1270</td>
                                        <td><input type="text" name="signatury"></td>
                                        <td><input type="text" name="signatury"></td>
                                </tr>
				<tr>
					<td>3</td>
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
					<td>16</td>
					<td>1270</td>
                                        <td><input type="text" name="signatury"></td>
                                        <td><input type="text" name="signatury"></td>
                                </tr>
				<tr>
					<td>4</td>
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
					<td>16</td>
					<td>1270</td>
                                        <td><input type="text" name="signatury"></td>
                                        <td><input type="text" name="signatury"></td>
                                </tr>
				<tr>
					<td>5</td>
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
					<td>16</td>
					<td>1270</td>
                                        <td><input type="text" name="signatury"></td>
                                        <td><input type="text" name="signatury"></td>
                                </tr>
                                
                                        </tbody>
		</table>
        </div>
</div>
                                        
  	<!--script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
</script--> 
				
@endsection		