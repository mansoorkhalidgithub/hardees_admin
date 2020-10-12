 @extends('layouts.main') @section('content')
 <style>
     .abc tr
     {
         line-height: 40px;
     }
     .table-bordered th
     {
    border: 1px solid transparent;
}
 </style>
 <div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Hardees001910 Detail:</h3>
                
                <a href="#"
			class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold"  style="background-color: #dc3545; color: white"><i
			class="fas fa-fw fa-1x fa-trash-alt fa-sm text-light-300"></i>Delete</a>
                       
	</div>
     <hr>
     <div class="row" style="margin-bottom:2rem">
                <div class="col-sm-6">
                    <table class="table-striped table-bordered abc" style="width:100%; font-size: 15px; color: black;" >
                        <thead>
                            <tr>
                                <th  colspan="2" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Booking Details:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Booking #:</td>
                                <td>Hardees001910</td>
                            </tr>
                            <tr>
                                <td>Customer Name:</td>
                                <td>Umar Sharif</td>
                            </tr>
                            <tr>
                                <td>Customer Contact No:</td>
                                <td>3001234567</td>
                            </tr>
                            <tr>
                                <td>Customer Address:</td>
                                <td>Johar Town, Lahore, Pakistan</td>
                            </tr>
                            <tr>
                                <td>Pickup Location:</td>
                                <td>Emporium Mall & Hyperstar, Abdul Haque Rd</td>
                            </tr>
                            <tr>
                                <td>Drop-off Location:</td>
                                <td>Johar Town, Lahore, Pakistan</td>
                            </tr>
                            <tr>
                                <td>Payment Mode:</td>
                                <td>Cash</td>
                            </tr>
                            <tr>
                                <td>Order Details:</td>
                                <td>Grilled Chicken Sandwitch</td>
                            </tr>
                            <tr>
                                <td>Order Amount:</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>Order Taken By:</td>
                                <td>Call Center</td>
                            </tr>
                            <tr>
                                <td>Date &AMP; Time #:</td>
                                <td>18-06-2020 12:36 PM</td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
         <div class="col-sm-6">
                    <table class="table-striped table-bordered abc" style="width:100%; font-size: 15px; color: black;">
                        <thead>
                            <tr>
                                <th  colspan="2" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Delivery Boy Details:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>Mirza Naeem</td>
                            </tr>
                            <tr>
                                <td>Contact #:</td>
                                <td>3214574508</td>
                            </tr>
                            <tr>
                                <td>Rating:</td>
                                <td>2</td>
                            </tr>
                            
                        </tbody>
                        
                    </table>
                </div>
                
            </div>
     <hr>
     <div class="row" style="margin-bottom:2rem">
                
                <div class="col-sm-6">
                    <table class="table-striped  abc" style="width:100%; font-size: 15px; color: black;">
                        <thead>
                            <tr>
                                <th  colspan="3" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Delivery Log:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Trip Request:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Reject:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Accepted:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Request Rejected by Driver After Accepted:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Arrived:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Started:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Completed:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Payment Done:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                            <tr>
                                <td>Trip Complete:</td>
                                <td>18-06-2020 12:36 PM</td>
                                <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                            </tr>
                        </tbody>
                        
                    </table>
                </div>
         <div class="col-sm-6" style="padding: 0px 20px">
         <legend style="color: red; font-weight: bold; font-size: 20px; font-family: serif;margin-bottom: 1rem; background-color: white; border: none; padding: 10px">Trip View Map</legend>
         
         <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6806.007666440382!2d74.31320992509033!3d31.469080725546153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391906aa20f282d1%3A0x1f670ea0693b1114!2sTele%20Tower!5e0!3m2!1sen!2s!4v1592470342740!5m2!1sen!2s" width="100%" height="380" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
     </div>
            </div>
                
        </div>
                     
                                    

                                        
				 
				
		@endsection