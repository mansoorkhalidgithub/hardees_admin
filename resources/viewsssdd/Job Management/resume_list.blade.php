 @extends('layouts.main') @section('content')
<style>
.form-popup {
  display: none;
  position: absolute;
  top: 5%;
  left: 36%;
  border: 3px solid #f1f1f1;
  z-index: 1;
}

.form-container {
  max-width: 600px;
  max-height: 400px;
  padding: 40px 40px 50px 40px;
  background-color: white;
}

.form-container .btn {
  color: black;
  font-weight: bold;
  border: none;
  width: 45%;
  text-align: center;
  opacity: 0.8;
}

.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
@media only screen and (max-width: 800px) {
    .form-popup {
  display: none;
  position: absolute;
  top: 7%;
  left: 28%;
  border: 3px solid #f1f1f1;
  z-index: 1;
}
}
</style>
 <div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">JOB APPLICANT LISTS</h3>


	</div>
	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px;">


                <!-- Admin Role on Product List -->


                <table class="table table-striped table-hover" style=" font-size: 13px">
			<thead>
				<tr style="color:black">
                                        <th>Sr.</th>
					<th>Country</th>
					<th>State</th>
                                        <th>City</th>
                                        <th>Name</th>
                                        <th>CNIC</th>
                                        <th>Phone No.</th>
                                        <th>Qualification</th>
                                        <th>Position Applied for</th>
					<th>CV</th>
					<th>Assign Test</th>
					<th>Action</th>
				</tr>

			</thead>
                        <tbody style="color: black">
				<tr>
					<td>1</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Waqar Ahmad</td>
					<td>3540112345648</td>
					<td>3001234567</td>
					<td>BS SE</td>
					<td>FrontEnd</td>
					<td>####</td>
                                        <td>
                                             <button class="btn open-button" style="background-color:  #dc3545; color: white"  onclick="openForm()"><span style="font-size: 12px; font-weight: bold">Assign</span></button>
                                        </td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Reject this Candidate"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
				<tr>
					<td>2</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Waqar Ahmad</td>
					<td>3540112345648</td>
					<td>3001234567</td>
					<td>BS SE</td>
					<td>FrontEnd</td>
					<td>####</td>
                                        <td>
                                             <button class="btn open-button" style="background-color:  #dc3545; color: white"  onclick="openForm()"><span style="font-size: 12px; font-weight: bold">Assign</span></button>
                                        </td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Reject this Candidate"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
				<tr>
					<td>3</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Waqar Ahmad</td>
					<td>3540112345648</td>
					<td>3001234567</td>
					<td>BS SE</td>
					<td>FrontEnd</td>
					<td>####</td>
                                        <td>
                                             <button class="btn open-button" style="background-color:  #dc3545; color: white"  onclick="openForm()"><span style="font-size: 12px; font-weight: bold">Assign</span></button>
                                        </td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Reject this Candidate"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                        </tbody>
		</table>
        </div>
</div>
<div class="form-popup" id="myForm">
    <form class="form-container" style="overflow-y: scroll">
         <h4 style="color:black; margin-bottom: 1.5rem; font-family: sans-serif">Assign any Test to: Waqar Ahmad?</h4>
         <hr>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="test1">TEST # 1</label>  
  
    <button id="test1" name="test1" class="btn" style="background-color: #F6BF2D; color: black ; width: 100%; font-weight: bold">ASSIGN TEST 1</button>
    
        </div>
    </div>
    
</div>
         <hr>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="test2">TEST # 2</label>  
  
    <button id="test2" name="test2" class="btn" style="background-color: #F6BF2D; color: black ; width: 100%; font-weight: bold">ASSIGN TEST 2</button>
    
        </div>
    </div>
    
</div>
         <hr>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="test3">TEST # 3</label>  
  
    <button id="test3" name="test3" class="btn" style="background-color: #F6BF2D; color: black ; width: 100%; font-weight: bold">ASSIGN TEST 3</button>
    
        </div>
    </div>
    
</div>
         <hr>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="test1">TEST # 4</label>  
  
    <button id="test4" name="test4" class="btn" style="background-color: #F6BF2D; color: black ; width: 100%; font-weight: bold">ASSIGN TEST 4</button>
    
        </div>
    </div>
    
</div>
         <div style="margin-top:2rem">
             <button type="button" class="btn btn-danger" style="float: right; color: white" onclick="closeForm()">Close</button>
         </div>
     </form>
 </div>
                                        
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>          



@endsection