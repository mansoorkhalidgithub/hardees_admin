@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px;">
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  

    <div class="card">
      <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">   
          <h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold" >UPDATE AREA: Delivery Rawalpindi</h1>
                <a href="{{ route('service_area') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Areas List</span></a>  </div>

          <div class="card-body">
              <form>
<fieldset>


<!-- Text input-->

<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="area_name">AREA NAME</label>  
  
    <input id="area_name" name="area_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="car_type">CAR TYPE</label>  
  
  <select id="car_type" name="car_type" style="border-radius: 0px" class="form-control">
        <option>Select your Car Type</option>
        <option>Delivery Lahore</option>
        <option>Delivery Gujranwala</option>
        <option>Delivery Multan</option>
        <option>Delivery Islamabad</option>
        <option>Delivery Rawalpindi</option>
    </select>
    
  
</div>
    </div>
    
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
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="state">STATE</label>  
  
    <select id="state" name="state" style="border-radius: 0px" class="form-control">
        <option>SELECT STATE</option>
        <option>PUNJAB</option>
        <option>SINDH</option>
        <option>BALOCHISTAN</option>
        <option>KPK</option>
        <option>FEDRAL DIVISIONAL AREA</option>
    </select>
    
  
</div>
</div>
    </div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="city">CITY</label>  
  
    <select id="city" name="city" style="border-radius: 0px" class="form-control">
        <option>Select your City</option>
        <option>Lahore</option>
        <option>Gujranwala</option>
        <option>Multan</option>
        <option>Islamabad</option>
        <option>Rawalpindi</option>
    </select>
    
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="status">STATUS</label>  
  
  <select id="status" name="status" style="border-radius: 0px" class="form-control">
        <option>Online</option>
        <option>Offline</option>
    </select>
    
  
</div>
    </div>
</div>
    
    

<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="update_area" name="update_area" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">UPDATE AREA</button>
  
  </div>
</fieldset>
</form>
          </div>
  </div>
    
</div>
@endsection
