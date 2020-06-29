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
		<h1 class="h3 mb-0"style="color: black; font-family: serif; font-weight: bold">UPDATE MENU CATEGORY</h1>
               
                <a href="{{ route('brand.index') }}"
			class="d-none d-sm-inline-block btn btn-sm  shadow-sm"  style="background-color: #ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-white-300"></i> <span style="font-weight: bold">Menu Category List</span></a>
                      
	</div>
      <div class="card-body">
    <form>
<fieldset>

    <div class="row">
        <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="category_name">CATEGORY NAME</label>  
  
  <input id="category_name" name="category_name" style="border-radius: 0px" class="form-control " required="" type="text">
    
  
</div>
        </div>
        <div class="col-sm-6"><div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="ingredients">DESCRIPTION</label>  
  
  <input id="description" name="description" style="border-radius: 0px"  class="form-control " required="" type="text">
 
</div>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
<div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="category_image">CATEGORY IMAGE</label>
  <br>
  <input id="category_image" class="col-md-4" name="category_image" class="input-file" type="file">
  
</div>
</div>
</div>
 <hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="update_category" name="update_category" class="btn" style="background-color: #F6BF2D; color: black;  font-weight: bold;">UPDATE CATEGORY</button>
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
