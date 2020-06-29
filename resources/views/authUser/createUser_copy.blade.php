@extends('layouts.main')

@section('title', 'Create Restuarant User')

@section('content')
<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-body cat-card-body">
                <form role="form" method="post" action="{{ route('save-user') }}">
                    @csrf
					
					<div class="form-group">
						<select name="restaurant_id" id="restaurant_id" class="form-control selectpicker" data-live-search="true" tabindex="-98">
							<option selected="" disabled="" hidden="">Select Restuarant</option>
							@foreach($restaurants as $restaurant)
								<option value="{{ $restaurant->id }}"> {{ $restaurant->name }} </option>
							@endforeach
						</select>
					</div>
					
                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" required="">
                        </div>
                    </div> 
					
					<div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" required="">
                        </div>
                    </div>

                    <!--For entering post tags-->

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="email" placeholder="Enter User Email" class="form-control" required="">
                        </div>
                    </div>

					<div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="password" id="password" name="password" placeholder="Enter Password" class="form-control" required="">
                        </div>
                    </div>
					
					<div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="phone_number" placeholder="Enter Phone Number" class="form-control" required="">
                        </div>
                    </div>

                    <div class="form-group">
						<select name="role" id="role" class="form-control selectpicker" data-live-search="true" tabindex="-98">
							<option selected="" disabled="" hidden="">Select Role</option>
							<option value="employee"> Employee </option>
						</select>
					</div>
		
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success btn-lg"> <i class="fa fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
</div>
@stop
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $.noConflict();
    });

</script>
