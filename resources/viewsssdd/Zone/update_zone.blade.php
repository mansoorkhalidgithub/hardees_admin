@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
   
    <div class="card">
<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 " style="color: black; font-family: serif; font-weight: bold">UPDATE ZONE: Zone 1</h1>
                <a href="{{ route('zone_list') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Zones List</span></a>
                        
	</div>
        <div class="card-body">
    <form>
<fieldset>


<div class="row">
     <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="zone_name">ZONE NAME</label>  
  
    <input id="zone_name" name="zone_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="country">COUNTRY</label>  
  
  <select id="country" name="country" style="border-radius: 0px" class="form-control">
      <option></option>
        <option>Pakistan</option>
    </select>
    
  
</div></div>
    
</div>
<div class="row">
   <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="state">STATE</label>  
  
  <select id="state" name="state" style="border-radius: 0px" class="form-control">
      <option></option>
        <option>Punjab</option>
        <option>Sindh</option>
        <option>Fedral Capital Area</option>
        <option>KPK</option>
        <option>Balochistan</option>
    </select>
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="city">CITY</label>  
  
  <select id="city" name="city" style="border-radius: 0px" class="form-control">
      <option></option>
        <option>Lahore</option>
        <option>Gujranwala</option>
        <option>Multan</option>
        <option>Peshawar</option>
        <option>Islamabad</option>
    </select>
    
  
</div></div>
    
</div>

<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="latitude">LATITUDE</label>  
  
    <input id="latitude" name="latitude" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="longitude">LONGITUDE</label>  
  
  <input id="longitude" name="longitude" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-6" style="color: black; font-size: 12px; font-weight: 700" for="zone_area">SELECT RESPECTIVE AREA</label>  
  
    <select id="zone_area" name="zone_area" style="border-radius: 0px" class="form-control">
        <option>DHA Phase (V)</option>
        <option>Johar Town</option>
        <option>Model Town</option>
    </select>
    
  
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="status">STATUS</label>
 
    <select id="status" name="status" style="border-radius: 0px" class="form-control">
        <option>Active</option>
        <option>Inactive</option>
    </select>
  
</div>
</div>
    
</div>
<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="update_zone" name="update_zone" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">UPDATE ZONE</button>
  
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
