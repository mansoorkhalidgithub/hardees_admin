 @extends('layouts.main') @section('content')

 <div class="bg-white" style="margin: 0px 10px 10px 10px; border-radius: 10px; padding: 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Delivery Statement</h3>
                
	</div>

	<div class="uper" style="overflow-x: scroll; margin-bottom: 50px; margin-top: 50px">
		 
                
                <!-- Admin Role on Product List -->
                
               
                <table class="table table-striped table-hover" id="rider_trips_statement">
			<thead>
				<tr style="color:black">
                                        <th>Booking No.</th>
                                        <th style="min-width:120px">From Place</th>
					<th style="min-width:150px">To Place</th>
					<th>Date</th>
					<th>Customer Name</th>
					<th>Rider Name</th>
                                        <th>Type</th>
					<th style="min-width:60px">Commission</th>
					<th>Amount</th>
				</tr>
			</thead>
                        <tbody style="color:black">
				<tr>
					<td>happiiride000749</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                <tr>
					<td>happiiride000748</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-12</td>
					<td>Miss Sara</td>
					<td>Naeem Shahzad</td>
					<td>Cash</td>
					<td>18</td>
					<td>100</td>
                                </tr>
                                <tr>
					<td>happiiride000747</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Muhammad Qadeer</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                <tr>
					<td>happiiride000746</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Maryam razzaq</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>75</td>
					<td>970</td>
                                </tr>
                                <tr>
					<td>happiiride000745</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr><tr>
					<td>happiiride000744</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                <tr>
					<td>happiiride000743</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                <tr>
					<td>happiiride000742</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                <tr>
					<td>happiiride000742</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                <tr>
					<td>happiiride000742</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                <tr>
					<td>happiiride000742</td>
                                        <td>new gardeen town h 58 babar block</td>
					<td>Tele tower, Model Town, Link road Lahore</td>
					<td>2020-06-16</td>
					<td>Umar Sharif</td>
					<td>Mirza Naeem</td>
					<td>Cash</td>
					<td>229</td>
					<td>1270</td>
                                </tr>
                                
                                        </tbody>
		</table>
        </div>
</div>
                                        
                                        
                                    <!-- Affiliate Role on Product List -->

                                        
<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#rider_trips_statement').DataTable();
	});
</script>					 
				
@endsection		