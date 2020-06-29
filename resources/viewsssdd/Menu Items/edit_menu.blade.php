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
		<h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">UPDATE MENU</h1>
               
                <a href="{{ route('product.index') }}"
			class="d-none d-sm-inline-block btn btn-sm shadow-sm"  style="background-color: #ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-white-300"></i> <span style="font-weight: bold">Back to Menu List</span></a>
                      
	</div>
      <div class="card-body">
    <form>
<fieldset>

<div class="row">
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">MENU NAME</label>  
  
  <input id="product_name" name="product_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
</div>
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="menu_categorie">MENU CATEGORY</label>
  
    <select id="menu_categorie" name="menu_categorie" style="border-radius: 0px" class="form-control">
        <option>Select Category</option>
        <option>Angus Burger</option>
        <option>Sides</option>
        <option>Jalapeno Burger</option>
        <option>Chargrilled Burger</option>
        <option>Swiss Burger</option>
    </select>
  
</div>
</div>
<!-- Text input-->

</div>
<!-- Text input-->
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
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="ingredients">INGREDIENTS</label>  
  
  <input id="ingredients" name="ingredients" style="border-radius: 0px"  class="form-control " required="" type="text">
    
 
</div>
</div>


    
</div>

<!-- Text input-->
<div class="row">
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="weight">WEIGHT</label>  
 
  <input id="weight" name="weight"  style="border-radius: 0px" class="form-control " required="" type="text">
    
 
</div>
</div>

    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="discount">DISCOUNT</label>  

  <input id="discount" name="discount" style="border-radius: 0px"  class="form-control " required="" type="text">
    
 
</div>
</div>
</div>

<!-- Text input-->
<div class="row">
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="quantity">QUANTITY</label>  
  
  <input id="quantity" name="quantity" style="border-radius: 0px"  class="form-control " required="" type="text">
    

</div>
</div>


    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="price">PRICE</label>
 
    <input id="price" name="price"  style="border-radius: 0px" class="form-control " required="" type="search">
    

</div>
</div>
</div>
<div class="row">
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="preparation_time">FOOD PREPARATION TIME</label>

    <input id="preparation_time" name="preparation_time"  style="border-radius: 0px" class="form-control " required="" type="time">
  </div>
  </div>
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="status">STATUS</label>

    <select id="status" name="status" style="border-radius: 0px" class="form-control">
        <option>Active</option>
        <option>Disable</option>
    </select>
  </div>
  </div>
</div>

<div class="row">
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="menu_image">MENU IMAGE</label>
  <br>
  <input id="menu_image" class="col-md-6" name="menu_image" class="input-file" type="file">
  
</div>
</div>
    <div class="col-sm-6">
<div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="menu_image">IS FAVORITE</label>
  <br>
  <input id="menu_image" class="col-md-1" name="menu_image" class="input-file" type="checkbox">
  
</div>
</div>
</div>
<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="update_menu" name="update_menu" class="btn" style="background-color: #F6BF2D; color: black;  font-weight: bold;">UPDATE MENU</button>
     
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
