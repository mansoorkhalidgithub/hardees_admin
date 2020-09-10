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
		<h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">ADD NEW RIDER</h1>
                <a href="{{ route('riders_details') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Riders List</span></a>
                        
	</div>
      <div class="card-body">
    <form>
<fieldset>

<!-- Form Name -->
<legend style="color: black; font-family: serif; font-weight: bold">BASIC DETAILS</legend>
<hr>
<!-- Text input-->
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="first_name">FIRST NAME</label>  
  
    <input id="first_name" name="first_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="last_name">LAST NAME</label>  
  
  <input id="last_name" name="last_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="phone">PHONE</label>  
  
    <input id="phone" name="phone" style="border-radius: 0px" class="form-control "  required="" type="tel">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="email">EMAIL</label>  
  
  <input id="email" name="email" style="border-radius: 0px" class="form-control "  required="" type="email">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="cnic">CNIC</label>  
  
    <input id="cnic" name="cnic" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="cnic_expiry">CNIC Expiry Date</label>  
  
  <input id="cnic_expiry" name="cnic_expiry" style="border-radius: 0px" class="form-control " required="" type="date">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="pass">PASSWORD</label>  
  
    <input id="pass" name="pass" style="border-radius: 0px" class="form-control " required="" type="password">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="con_pass">CONFIRM PASSWORD</label>  
  
  <input id="con_pass" name="con_pass" style="border-radius: 0px" class="form-control " required="" type="password">
    
  
</div></div>
</div>
<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="status">ONLINE/OFFLINE</label>  
  
    <select id="status" name="status" style="border-radius: 0px" class="form-control">
        <option>Online</option>
        <option>Offline</option>
    </select>
    
  
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
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant">RESTAURANT</label>
 
    <select id="restaurant" name="restaurant" style="border-radius: 0px" class="form-control">
        <option>Select Branch</option>
        <option>DHA</option>
        <option>Packages Mall</option>
        <option>M.M Alam</option>
        <option>Lalik Chowk</option>
        <option>Thokar Niaz Baig</option>
    </select>
  
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="rider_image">RIDER IMAGE</label>
  <br>
  <input id="rider_image" class="col-md-6" name="rider_image" class="input-file" type="file">
  
</div>
    </div>
    
</div>

<!-- Text input-->
<hr>
<legend style="color: black; font-family: serif; font-weight: bold">ADDRESS DETAILS</legend>
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
  
      <button id="add_rider" name="add_rider" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">ADD RIDER</button>
  
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
