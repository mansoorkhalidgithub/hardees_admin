@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  
  <div class="card">
<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">ADD VEHICLE</h1>
                <a href="{{ route('service_type') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Vehicle List</span></a>
                        
	</div>
      <div class="card-body">
    <form>
<fieldset>



<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="title">TITLE</label>  
  
    <input id="title" name="title" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="description">DESCRIPTION</label>  
  
  <input id="description" name="description" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="day_base_fare">DAY BASE FARE</label>  
  
    <input id="day_base_fare" name="day_base_fare" style="border-radius: 0px" class="form-control " required="" type="number">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="day_per_minute">DAY Per MINUTE FARE</label>  
  
  <input id="day_per_minute" name="day_per_minute" style="border-radius: 0px" class="form-control " required="" type="number">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="day_per_km">DAY Per KM FARE</label>  
  
    <input id="day_per_km" name="day_per_km" style="border-radius: 0px" class="form-control " required="" type="number">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="day_min_fare">DAY MINIMUM FARE</label>  
  
  <input id="day_min_fare" name="day_min_fare" style="border-radius: 0px" class="form-control " required="" type="number">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="country">COUNTRY</label>  
  
    <select id="country" name="country" style="border-radius: 0px" class="form-control">
        <option>Select Country</option>
        <option>Pakistan</option>
    </select>
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="capacity">CAPACITY</label>  
  
    <select id="capacity" name="capacity" style="border-radius: 0px" class="form-control">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
    </select>
    
  
</div>
</div>
    
    
</div>
    <div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="status">STATUS</label>  
  
    <select id="status" name="status" style="border-radius: 0px" class="form-control">
        <option>Online</option>
        <option>Offline</option>
    </select>
    
  
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="rider_image">VEHICLE IMAGE</label>
  <br>
  <input id="vehicle_image" class="col-md-6" name="vehicle_image" class="input-file" type="file">
  
</div>
    </div>
    
</div>
<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="add_vehicle" name="add_vehicle" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">ADD VEHICLE</button>
  
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
