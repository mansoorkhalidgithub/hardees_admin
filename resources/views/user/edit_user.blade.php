@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
    
    <div class="card">
<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0"style="color: black; font-family: serif; font-weight: bold">UPDATE USER:289</h1>
                <a href="{{ route('user_list') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to User List</span></a>
                        
	</div>
        <div class="card-body">
    <form>
<fieldset>


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
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="user_image">USER IMAGE</label>  
    <br>
    <input id="user_image"  name="user_image" class="input-file" type="file">
    
  
</div>
</div>
    
</div>
    <hr>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="address">ADDRESS</label>
  <input id="address" name="address" style="border-radius: 0px" class="form-control" readonly="" required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-12">
        <div class="form-group">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6806.007666440382!2d74.31320992509033!3d31.469080725546153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391906aa20f282d1%3A0x1f670ea0693b1114!2sTele%20Tower!5e0!3m2!1sen!2s!4v1592383763663!5m2!1sen!2s" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  
</div>
</div>
    
</div>



<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="update_user" name="update_user" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">UPDATE USER</button>
  
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
