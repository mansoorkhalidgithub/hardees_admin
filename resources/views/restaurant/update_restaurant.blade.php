@extends('layouts.main')
@section('title', 'Create Restaurant')



@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
    <div class="card">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">UPDATE RESTAURANT: HARDEES DHA</h1>
                <a href="{{ route('restaurant_show') }}"
			class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold"   style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-arrow-circle-left fa-sm text-dark-300"></i>Restaurant List</a>

	</div>
        <div class="card-body">
<form>
<fieldset>


<div class="row">
    <div class="col-sm-12"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_name">RESTAURANT NAME</label>

    <input type="text" name="restaurant_name" style="border-radius: 0px" class="form-control" required="">


</div>
</div>

</div>
<div class="row">
    <div class="col-sm-12"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_tags">RESTAURANT TAGS</label>

    <input type="text" name="restaurant_tags" style="border-radius: 0px"  class="form-control" required="">


</div>
</div>

</div>
<div class="row">
    <div class="col-sm-12"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_address">RESTAURANT ADDRESS</label>

    <input type="text" id="address" style="border-radius: 0px" name="restaurant_address" class="form-control" required="">


</div>
</div>

</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
        <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="latitude">LATITUDE</label>

    <input type="text" readonly id="latitude" style="border-radius: 0px" name="latitude" class="form-control" required="">


</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="longitude">LONGITUDE</label>

  <input type="text" readonly id="longitude" style="border-radius: 0px" name="longitude" class="form-control" required="">


</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
        <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="min_order_price">MINIMUM ORDER PRICE</label>

    <input type="text" class="form-control" style="border-radius: 0px" name="min_order_price" >


</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="expense_type">EXPENSE TYPE</label>

  <input type="text" class="form-control" style="border-radius: 0px" name="expense_type" >


</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
        <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="currency_symbol">CURRENCY SYMBOL</label>

    <input type="text" name="currency_symbol" style="border-radius: 0px" class="form-control">
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="currency_name">CURRENCY NAME</label>

  <input type="text" name="currency_name" style="border-radius: 0px"  class="form-control">


</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
        <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="delivery_charges">DELIVERY CHARGES</label>

    <input type="text" name="delivery_charges" style="border-radius: 0px"  class="form-control" required="">


</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="delivery_charges_km">CHARGES Per KM</label>

  <input type="text" name="delivery_charges_km" style="border-radius: 0px"  class="form-control">


</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
        <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="payment_method_id">PAYMENT METHOD</label>

    <select name="payment_method_id" id="payment_method_id" style="border-radius: 0px" class="form-control">
                                <option selected="" disabled="" hidden="">Select Payment Method</option>

                                <option value="cash"> Cash on Delivery</option>

                            </select>


</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="category_id">RESTAURANT CATEGORY</label>

 <select name="category_id" id="category_id" class="form-control" style="border-radius: 0px" >
                                <option selected="" disabled="" hidden="">Select Restaurant Category</option>

                                <option value="fast">Fast Food</option>

                            </select>


</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
        <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="delivery_time">ESTIMATED TIME</label>

        <input type="text" name="delivery_time" placeholder="in Mins..." style="border-radius: 0px" class="form-control" required="">


</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="contact_number">CONTACT NO.</label>

   <input type="tel" name="contact_number"  style="border-radius: 0px" class="form-control" required="">


</div></div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_category">RESTAURANT CATEGORY</label>
</div>
        <div id="restaurant_categories">
                    </div>
        <div class="row">

                        <div class="col-sm-11">
                            <div class="form-group">
                                <input type="text" class="form-control" id="item" value="" style="border-radius: 0px" placeholder=" e.g 'Hot Deals' ">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="input-group-btn">
                                <button class="btn btn-warning" onclick="restaurant_categories();" type="button"> <i class="fas fa-plus"></i> </button>
                            </div>
                        </div>

        </div>
</div>

</div>
<div class="row">
    <div class="col-sm-12"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_timing">RESTAURANT TIMINGS</label>

</div>
        <div id="timing_fields">
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text" class="form-control" id="time" style="border-radius: 0px" value="" placeholder="e.g Friday ">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="time" class="form-control" id="time_from" style="border-radius: 0px" value="" placeholder="e.g Friday ">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="time" class="form-control" id="time_to" style="border-radius: 0px" value="" placeholder="e.g Friday ">
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="input-group-btn">
                                <button class="btn btn-warning" type="button" onclick="timing_fields();"> <i class="fas fa-plus"></i> </button>
                            </div>
                        </div>
                    </div>

</div>

</div>

 <!-- File Button -->
<div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_image">UPLOAD RESTAURANT IMAGE</label>
  <br>
  <input id="logo" class="col-md-4" name="restaurant_image" class="input-file" type="file">

</div>
 <hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">

        <button id="update_restaurant" name="update_restaurant" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">UPDATE RESTAURANT</button>

  </div>
</fieldset>
</form>



</div>
</div>
</div>
@endsection