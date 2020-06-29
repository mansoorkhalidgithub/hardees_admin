@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
   
    
    <div class="card">
<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">Dt23w5: UPDATE PROMO</h1>
                <a href="{{ route('promocode_list') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to PromoCode List</span></a>
                        
	</div>
    
        <div class="card-body">
    <form>
<fieldset>



<div class="row">
    <div class="col-sm-8"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="promocode">PROMOCODE NAME</label>  
  
    <input id="promocode" name="promocode" style="border-radius: 0px" placeholder="Enter or click to generate promocode" class="form-control " required="" type="text">
    
  
</div>
</div>

    <div class="col-sm-4"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for=""></label>  
  
    <button id="generate_promo" name="generate_promo" class="btn" style="background-color: #F6BF2D; color: black; width: 100%; font-weight: bold; margin-top:5px">Generate PromoCode</button>
    
  
</div>
</div>
    
</div>

<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-6" style="color: black; font-size: 12px; font-weight: 700" for="promocode_type">PROMOCODE TYPE</label>  
  
    <select id="promocode_type" name="promocode_type" style="border-radius: 0px" required="" class="form-control">
        <option>Select Promocode Type</option>
        <option>Amount</option>
    </select>
    
  
</div>
</div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="usage_limit">USAGE LIMIT</label>
 
  <input id="usage_limit" name="usage_limit" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
</div>
    
</div>

<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="promo_value">PROMOTION VALUE</label>  
  
    <input id="promo_value" name="promo_value" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="promo_description">PROMO DESCRIPTION</label>  
  
  <input id="promo_description" name="promo_description" style="border-radius: 0px" class="form-control " type="text">
    
  
</div></div>
</div>

<div class="row">
    <div class="col-sm-6"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="start_date">START DATE</label>  
  
    <input id="start_date" name="start_date" style="border-radius: 0px" class="form-control " required="" type="date">
    
  
</div>
</div>
    <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="end_date">END DATE</label>  
  
  <input id="end_date" name="end_date" style="border-radius: 0px" class="form-control " required="" type="date">
    
  
</div></div>
</div>
    <div class="row">
    <div class="col-sm-4"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="country">COUNTRY</label>  
  
  <select id="country" name="country" style="border-radius: 0px" required="" class="form-control">
      <option><span class="filter-option"></span></option>
        <option>Pakistan</option>
    </select>
    
  
</div></div>
    <div class="col-sm-4"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="state">STATE</label>  
  
    <select id="state" name="state" style="border-radius: 0px" required="" class="form-control">
      <option></option>
        <option>Punjab</option>
        <option>Sindh</option>
        <option>Fedral Capital Area</option>
        <option>KPK</option>
        <option>Balochistan</option>
    </select>
    
  
</div>
</div>
    <div class="col-sm-4"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="city">CITY</label>  
  
  <select id="city" name="city" style="border-radius: 0px" required="" class="form-control">
      <option></option>
        <option>Lahore</option>
        <option>Gujranwala</option>
        <option>Multan</option>
        <option>Peshawar</option>
        <option>Islamabad</option>
    </select>
    
  
</div></div>
</div>
<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="update_promocode" name="update_promocode" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">UPDATE PROMOCODE</button>
  
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
