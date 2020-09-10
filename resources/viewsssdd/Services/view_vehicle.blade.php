 @extends('layouts.main') @section('content')
 <style>
     .abc tr
     {
         line-height: 40px;
     }
   

 </style>
 <div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Delivery Lahore Details:</h3>
                
                <a href="#"
			class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold"  style="background-color: #dc3545; color: white">Delete</a>
                       
	</div>
     <hr>
     <div class="row" style="margin-bottom:2rem">
                <div class="col-sm-12">
                    <table class="table-striped abc" style="width:100%; font-size: 18px; color: black;" >
                        <tbody>
                            <tr>
                                <td style="font-weight: bold">Vehicle Selected Picture:</td>
                                <td>0000</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Vehicle Name:</td>
                                <td>Delivery Lahore</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Vehicle Type:</td>
                                <td>Car</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Capacity:</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Description:</td>
                                <td>Here you Deliver Every Thing</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Country:</td>
                                <td>Pakistan</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Day Base Fare:</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Day Per Minute Fare:</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Day Per KM Fare:</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Day Minimum Fare:</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Status:</td>
                                <td>Active</td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
         
                
            </div>
            </div>
     
     
				 
				
		@endsection