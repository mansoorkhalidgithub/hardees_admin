@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
    
    <div class="card">
<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0"style="color: black; font-family: serif; font-weight: bold">ADD NEW ADMIN</h1>
                <a href="{{ route('sub_admins') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Admins List</span></a>
                        
	</div>
        <div class="card-body">
    <form>
<fieldset>

<div class="row">
    <div class="col-sm-6"><div class="form-group">
        <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="admin_type">ADMIN TYPE</label>  
  
  <select id="admin_type" name="admin_type" style="border-radius: 0px" class="form-control">
        <option>Country Admin</option>
        <option>City Admin</option>
        <option>State Admin</option>
        <option>Support User Admin</option>
        <option>Support Driver Admin</option>
    </select>
    </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="user_name">USERNAME</label>  
  
 <input id="user_name" name="user_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="first_name">FIRST NAME</label>  
  
    <input id="first_name" name="first_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="last_name">LAST NAME</label>  
  
  <input id="last_name" name="last_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
    </div>
    
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="phone">PHONE NUMBER</label>  
  
    <input id="phone" name="phone" style="border-radius: 0px" class="form-control " required="" type="tel">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="email">EMAIL</label>  
  
  <input id="email" name="email" style="border-radius: 0px" class="form-control " required="" type="email">
    
  
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
        <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="status">STATUS</label>  
  
    <select id="status" name="status" style="border-radius: 0px" class="form-control">
        <option>Active</option>
        <option>Inactive</option>
    </select>
    
  
</div>
</div>
    
</div>
<div class="row">
    
    <div class="col-sm-12"><div class="form-group">
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="admin_image">ADMIN IMAGE</label>  
    <br>
    <input id="admin_image"  name="admin_image" class="input-file" type="file">
    
  
</div>
</div>
    
</div>



<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="add_admin" name="add_admin" class="btn" style="background-color: #F6BF2D; color: black;  font-weight: bold">ADD ADMIN</button>
  
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
