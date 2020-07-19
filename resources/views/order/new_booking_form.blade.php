@extends('layouts.form')

@section('content')
<style>
    .product_label{
        padding: 10px 20px;
        border-radius: 40px;
        background-color: transparent;
        color:black;
        font-size: 12px;
    }
    .product_image{
        margin-top: -30px;
        width:100px;
        height:70px; 
        display: block;
        margin-left: 20px;
    }
    .col-sm-2
    {
        margin: auto;
    }
    .add-qty
    {
        margin-left: 15px;
    }
    /*  .popup .product_image{
          display: block;margin-left: auto; margin-right: auto;
      }*/
    .fontawesomeheading{
        color: black; font-family: serif; font-weight: bold;
    }
    .cart_totals {
        font-size: 15px;
        color: #666;
        width: 66.56%;
        margin: auto;
        margin-bottom: 31px; }
    .cart_totals table {
        width: 100%; }
    .cart_totals th, .cart_totals td {
        padding: 11px 0;
        vertical-align: top;
        text-align: left; }
    .cart_totals th {
        font-family: "Lato-Bold";
        color: #333;
        text-align: left;
        width: 65.81%; }
    .cart_totals th span {
        color: #999;
        font-size: 14px; }
    .cart_totals .order-total th, .cart_totals .order-total td {
        padding: 12px 0;
        color: #333;
        font-family: "Lato-Bold"; }
    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* The actual popup */
    .popup .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: rgba(0,0,0,0.8);
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class - hide and show the popup */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {opacity: 0;} 
        to {opacity: 1;}
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
    }

    label.category > input{
        visibility: hidden;
        position: absolute;
    }
    label.category{
        background-color: #eee;
        border-radius: 15px;
    }
    label.category > input {
        width:250px;
        height:100px;
        cursor:pointer;
        float:left;
        border:#999 solid 1px;
    }
    label.category > input:checked + div{
        background-color: #aeaeae;
        border-radius: 15px;
    }


    .input-number-group {
        /*  display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          -webkit-justify-content: center;
              -ms-flex-pack: center;
                  justify-content: center;*/
    }

    .input-number-group input[type=number]::-webkit-inner-spin-button,
    .input-number-group input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        appearance: none;
    }

    .input-number-group .input-group-button {
        line-height: calc(80px/2 - 5px);
    }

    .input-number-group .input-number {
        width: 40px;
        padding: 0 12px;
        vertical-align: top;
        /*text-align: center;*/
        outline: none;
        display: block;
        margin: 0;
    }

    .input-number-group .input-number,
    .input-number-group .input-number-decrement,
    .input-number-group .input-number-increment {
        border: 1px solid #cacaca;
        height: 30px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border-radius: 0;
    }

    .input-number-group .input-number-decrement,
    .input-number-group .input-number-increment {
        display: inline-block;
        width: 30px;
        background: #e6e6e6;
        color: #0a0a0a;
        text-align: center;
        font-weight: bold;
        cursor: pointer;
        font-size: 2rem;
        font-weight: 400;
    }

    .input-number-group .input-number-decrement {
        margin-right: 0.3rem;
    }

    .input-number-group .input-number-increment {
        margin-left: 0.3rem;
    }

</style>
<div  style="margin: 0px 10px 10px 10px; padding: 10px">

    <div class="card">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 fontawesomeheading">NEW BOOKING</h1>
        </div>
        <div class="card-body">
            <form action="save-order" method="post">
				@csrf
                <fieldset>
                    <h4 class="h3 mb-0 fontawesomeheading">Customer Info</h4><br>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input id="searchbox" class="form-control" style="width: 100% !important; border-radius: 0px" type="search" name="keyword" placeholder="Search Old Customer by Name, Number" value="" autofocus>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <input type="reset" name="Reset" value="Reset" class="btn btn-success btn-md btncustom" style="margin-left: 5px; width: 100%; border-radius:0px; border-color:black; background:black; color:#f6bf2d">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">FIRST NAME</label>  
                                <input id="first_name" name="first_name" style="border-radius: 0px" class="form-control " required="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">LAST NAME</label>  
                                <input id="last_name" name="last_name" style="border-radius: 0px" class="form-control " required="" type="text">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">PHONE #</label>  
                                <input id="phone" name="phone" style="border-radius: 0px" class="form-control " required="" type="text">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">ADDRESS</label>  
                                <input id="address" name="address" style="border-radius: 0px" class="form-control " required="" type="text">
                            </div>
                        </div>
                    </div>
					
                    <hr>

                    <h4 class="h3 mb-0 fontawesomeheading">
						<!--<i  data-toggle="collapse" href="#collapse1" class="fas fa-fw fa-1x fa-plus-square fa-sm text-white-300" style="color: #4c4c4c; cursor: pointer"></i>-->
						Select Menu Items
					</h4>
						<br>
                    <div id="collapse1" class="panel-collapse">

                        <p style="margin: 0px 10px">
							<select class="form-control textInput" data-live-search="true" data-width="100%" style="width: 100%; border-radius: 0px;" id="menu_category" onchange="menuItems(this.value)" name="menu_category">
								@foreach($itemCategories as $key => $category)
									<option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </p>

                        <div class="row" id="menu-container" data-id="category-{{ $itemCategories[0]->id }}" style="margin: 10px 10px 10px 30px">
							@foreach($items as $key => $item)
								<div class="col-sm-2">
									<label class="category">
										<input type="checkbox" cart_id="" id="{{ $item->id }}" onchange="addToCart(this)" name="items[]" value="{{ $item->id }}"/>
										<div>
											<p class="product_label"> {{ $item->name }} </p><br>
											<div class="popup" onmouseover="myFunction({{ $item->id }})" onmouseout="myFunctionClose({{ $item->id }})"><img src="{{ env('APP_URL') . $item->image }}"  class="product_image">
												<span class="popuptext" id="myPopup-{{ $item->id }}">
													<small> <p class="p-2"> {{ $item->ingredients }}</p> PKR {{ $item->price }} </small>
												</span>
											</div>
										</div>
									</label>
									<div class="input-group input-number-group add-qty">
										<div class="input-group-button">
											<span onclick="removeQuantity(this.id)" id="{{ $item->id }}" class="input-number-decrement bg-whitesmoke">-</span>
										</div>
										<input class="input-number" type="number" data_id="{{ $item->id}}" id="quantity-{{ $item->id }}" name="quantity" value="1" min="0" max="1000">
										<div class="input-group-button">
											<span onclick="addQuantity(this.id)" id="{{ $item->id }}" class="input-number-increment bg-whitesmoke">+</span>
										</div>
									</div>
								</div>
							@endforeach
                        </div>

                        <hr>
						
                        <h4 class="h3 mb-0 fontawesomeheading">Select Add On's</h4><br>

                        <p style="margin: 0px 10px"><select class="form-control textInput" data-live-search="true" data-width="100%" style="width: 100%; border-radius: 0px;" id="ct_id" name="Trip[iVehicleTypeId]">

                                <option>Select Category</option>
                                <option>Chargrilled Burger</option>
                                <option>Angus Burger</option>
                                <option>Sides</option>
                                <option>Beverages</option>
                                <option>Chicken Burger</option>

                            </select>
                        </p>

                        <div class="row" style="margin: 10px 10px 10px 30px">

                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="addon" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/17.png')}}" class="product_image">
                                    </div>
                                </label>
                                <div class="input-group input-number-group add-qty">
                                    <div class="input-group-button">
                                        <span class="input-number-decrement bg-whitesmoke">-</span>
                                    </div>
                                    <input class="input-number" type="number" value="1" min="0" max="1000">
                                    <div class="input-group-button">
                                        <span class="input-number-increment bg-whitesmoke">+</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>

                </fieldset>
				 <div class="card-footer text-right">
					<button id="" name="" class="btn" type="submit" style="background-color: #F6BF2D; color: black; font-weight: bold">Submit</button>
				</div>
            </form>
        </div>
       
    </div>
</div>
<script>
// When the user clicks on div, open the popup
    function myFunction(menuId) {
        var popup = document.getElementById("myPopup-"+menuId);
        popup.classList.toggle("show");
    }
    function myFunctionClose(menuId) {
        var popup_close = document.getElementById("myPopup-"+menuId);
        popup_close.classList.toggle("hide");
    }
	
	function menuItems(categoryId)
	{
		$.ajax({
			type : 'POST',
			url  : 'get-menu-items',
			data : {"menu_category_id" : categoryId},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success : function(response) {
				document.getElementById('menu-container').innerHTML = response;
			},
			error : function(error) {
				console.log(error)
			}
		});
	}
	
	function addToCart(attribute) {
		
		var quantityElement = document.getElementById("quantity-"+attribute.id).value;
		
		if(attribute.checked) {
			$.ajax({
				type : 'POST',
				url  : 'add-to-cart',
				data : {"item_id" : attribute.value, 'quantity': quantityElement},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success : function(response) {
					attribute.setAttribute("cart_id", response.data.cart_id);
				},
				error : function(error) {
					console.log(error)
				}
			});
		} else {
			var cartId = attribute.getAttribute('cart_id');
			console.log(cartId);
			$.ajax({
				type : 'POST',
				url  : 'remove-to-cart',
				data : {"cart_id" : cartId},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success : function(response) {
					console.log('message');
				},
				error : function(error) {
					console.log(error)
				}
			});
		}
	}
	
	function addQuantity(value)
	{
		var element = document.getElementById("quantity-"+value);
		var itemId = element.getAttribute('data_id');
		var cartId = document.getElementById(itemId).getAttribute("cart_id");
		var newQuantity = +element.value + +1;
		element.value = newQuantity;
		$.ajax({
			type : 'POST',
			url  : 'add-quantity',
			data : {"cart_id": cartId, "item_id" : itemId},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success : function(response) {
				console.log(response.message);
			},
			error : function(error) {
				console.log(error)
			}
		});
	}
	
	function removeQuantity(value)
	{
		var element = document.getElementById("quantity-"+value);
		var itemId = element.getAttribute('data_id');
		var cartId = document.getElementById(itemId).getAttribute("cart_id");
		var newQuantity = element.value - 1;
		element.value = newQuantity;
		$.ajax({
			type : 'POST',
			url  : 'remove-quantity',
			data : {"cart_id": cartId,"item_id" : itemId},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success : function(response) {
				console.log(response.message);
			},
			error : function(error) {
				console.log(error)
			}
		});
	}
</script> 
@endsection
