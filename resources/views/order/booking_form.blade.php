@extends('layouts.main')

@section('title', 'Order Booking')
 
@section('content')

    <div style="margin: 0px 10px 10px 10px; padding: 20px; background-color: white">
        <div>
			<div>
				<div class="card" style="background-color: transparent">
					<div class="card-body">
						<form id="msform">
							
							<div class="form-card">
								 
								<div class="row" >
									<div class="col-sm-10">
										<input id="searchbox" class="form-group form-control" style="width: 100% !important;" type="search" name="keyword" placeholder="Search Old Customer by Name, Number" value="" autofocus>
									</div>
									<div class=" col-sm-2">
										<input type="reset"  name="Reset" value="Reset" class="btn btn-success btn-md btncustom" style="margin-left: 5px; width: 100%; border-radius:0px; border-color:black; background:black; color:#f6bf2d">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" />
									</div>
									<div class="form-group col-sm-6">
										<input type="text" class="form-control" name="last_name" placeholder="Last Name" />
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-6">
										<input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number" />
									</div>
									<div class="form-group col-sm-6">
										<input type="text" class="form-control" name="address" placeholder="Enter your Address" />
									</div>
								</div>
							</div>

							<div class="card" style="background-color: transparent">
								<div class="card-body">
								
								</div>
							</div>
							<br>
							<button type="submit" class="btn btn-secondary" > Submit </button> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
	
</script>

@endsection