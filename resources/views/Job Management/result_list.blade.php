 @extends('layouts.main') @section('content')

 <div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">JOB APPLICANTS TEST RESULTS</h3>


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
					<th>Test Number</th>
					<th>Result</th>
                                        <th style="min-width: 90px">Actions</th>
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
					<td>5</td>
					<td>80</td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D; float: left" title="Shortlist this Candidate"><i class="fas fa-list-alt" style="color: #28a745; "></i></a>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D; float: right" title="Reject this Candidate"><i class="fas fa-trash-alt" style="color: #dc3545;"></i></a>
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
					<td>5</td>
					<td>80</td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D; float: left" title="Shortlist this Candidate"><i class="fas fa-list-alt" style="color: #28a745; "></i></a>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D; float: right" title="Reject this Candidate"><i class="fas fa-trash-alt" style="color: #dc3545;"></i></a>
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
					<td>5</td>
					<td>80</td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D; float: left" title="Shortlist this Candidate"><i class="fas fa-list-alt" style="color: #28a745; "></i></a>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D; float: right" title="Reject this Candidate"><i class="fas fa-trash-alt" style="color: #dc3545;"></i></a>
					</td>
                                </tr>
                                        </tbody>
		</table>
        </div>
</div>



@endsection