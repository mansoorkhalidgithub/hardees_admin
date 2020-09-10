 @extends('layouts.main') @section('content')

 <div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">PROMOCODE LIST</h3>
                <a href="{{ route('add_promocode') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New PromoCode</a>
                
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
                                        <th>Type</th>
                                        <th>Name</th>
					<th>Value</th>
					<th>Usage Limit</th>
                                        <th style="min-width:60px">Start Date</th>
                                        <th style="min-width:60px">End Date</th>
					<th>Status</th>
                                        <th style="min-width: 100px">Action</th>
				</tr>
                                
			</thead>
                        <tbody style="color: black">
				<tr>
					<td>1</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Amount</td>
					<td>Dtwej4</td>
					<td>100</td>
					<td>200</td>
					<td>2020-06-22</td>
					<td>2020-06-25</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('view_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>2</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Amount</td>
					<td>2fwej4</td>
					<td>100</td>
					<td>200</td>
					<td>2020-06-22</td>
					<td>2020-06-25</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('view_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>3</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Amount</td>
					<td>3rwej4</td>
					<td>100</td>
					<td>200</td>
					<td>2020-06-22</td>
					<td>2020-06-25</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('view_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                <tr>
					<td>4</td>
					<td>Pakistan</td>
					<td>Punjab</td>
					<td>Lahore</td>
					<td>Amount</td>
					<td>Ddafej4</td>
					<td>100</td>
					<td>200</td>
					<td>2020-06-22</td>
					<td>2020-06-25</td>
					<td>Active</td>
                                        <td>
                                            <a href="{{ route('view_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="View"><i class="fas fa-eye" style="color: black"></i></a>
                                            <a href="{{ route('update_promocode') }}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					</td>
                                </tr>
                                
                                        </tbody>
		</table>
        </div>
</div>

                                      
					 
				
@endsection		