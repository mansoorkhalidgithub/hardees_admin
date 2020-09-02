@extends('layouts.form')

@section('content')
<style>
    .product_label {
        padding: 10px 20px;
        border-radius: 40px;
        background-color: transparent;
        color: black;
        font-size: 12px;
    }

    .product_image {
        margin-top: -30px;
        width: 100px;
        height: 70px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .col-sm-2 {
        margin: auto;
    }

    .add-qty {
        margin-left: 25px;
    }

    /*  .popup .product_image{
          display: block;margin-left: auto; margin-right: auto;
      }*/
    .fontawesomeheading {
        color: black;
        font-family: serif;
        font-weight: bold;
    }

    .cart_totals {
        font-size: 15px;
        color: #666;
        width: 66.56%;
        margin: auto;
        margin-bottom: 31px;
    }

    .cart_totals table {
        width: 100%;
    }

    .cart_totals th,
    .cart_totals td {
        padding: 11px 0;
        vertical-align: top;
        text-align: left;
    }

    .cart_totals th {
        font-family: "Lato-Bold";
        color: #333;
        text-align: left;
        width: 65.81%;
    }

    .cart_totals th span {
        color: #999;
        font-size: 14px;
    }

    .cart_totals .order-total th,
    .cart_totals .order-total td {
        padding: 12px 0;
        color: #333;
        font-family: "Lato-Bold";
    }

    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        margin-left: 20px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* The actual popup */
    /*    .popup .popuptext {
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

         Popup arrow
        .popup .popuptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }*/

    /* Toggle this class - hide and show the popup */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    label.category>input {
        visibility: hidden;
        position: absolute;
    }

    label.category {
        background-color: #eee;
        border-radius: 15px;
        height: 140px;
        width: 150px;
    }

    label.category>a>input {
        width: 250px;
        height: 100px;
        cursor: pointer;
        float: left;
        border: #999 solid 1px;
    }

    label.category>a>input:checked+div {
        background-color: #aeaeae;
        border-radius: 15px;
        height: 140px;
        width: 150px;
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
        padding: 0 0px;
        vertical-align: top;
        text-align: center;
        outline: none;
        display: block;
        margin: 0;
    }

    .input-number-group .input-number,
    .input-number-group .input-number-decrement,
    .input-number-group .input-number-increment {
        border: 1px solid #cacaca;
        height: 35px;
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

    /*    .input-number-group .input-number-decrement {
            margin-top: 0.3rem;
        }

        .input-number-group .input-number-increment {
            margin-top: 0.3rem;
        }*/
</style>
<div style="margin: 0px 10px 10px 10px; padding: 10px">

    <div class="card">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 fontawesomeheading">NEW BOOKING</h1>
        </div>
        <div class="card-body">
            <form id="booking-form" action="saveOrder" method="post">
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

                    @foreach($itemCategories as $key => $menuCategory)
                    <h4 class="h3 mb-0 fontawesomeheading">
                        {{ $menuCategory->name }}
                    </h4>
                    <br>
                    <div id="collapse1" class="panel-collapse">

                        <div class="row" id="menu-container" style="margin: 10px 10px 10px 30px">
                            @foreach($menuCategory->menuItems as $key => $item)
                            <div class="col-sm-2">
                                <a onclick="itemAddonModel(this)" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-price="{{ $item->price }}" id="menu-item-{{ $item->id}}" class="menu-item-{{ $item->id}}">
                                    <label class="category">
                                        <div>
                                            <p class="product_label"> {{ $item->name }} </p><br>
                                            <div class="popup"><img src="{{ env('APP_URL') . $item->image }}" class="product_image">

                                            </div>
                                        </div>
                                    </label>
                                </a>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    <hr><br>
                    @endforeach
                  
					<div class="row">
						<div class="col-sm-12 m-b-2">
							<input required id="menu" name="menu" class="form-control textInput abcdefgh" type="text" value="" placeholder="Enter Menu" style="margin-bottom: 10px; width: 100%; border-radius: 0px">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 m-b-2">
							<div id="order_types">
								<select readonly class="form-control" data-width="100%" style="margin-bottom: 10px; border-radius: 0px" name="order_type_id" required>
									<option>Select Order Type</option>
									<option value="1"> Home Delivery </option>
									<option value="2"> Take Away </option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 m-b-2">
							<input required id="drop_off_location" name="drop_off_location" class="form-control textInput abcdefgh" type="text" value="" placeholder="Drop Off Location" style="margin-bottom: 10px; width: 100%; border-radius: 0px">
							<input type="hidden" name="latitude" id="latitude">
							<input type="hidden" name="longitude" id="longitude">
							<input type="hidden" name="location_search_filter" id="location_search_filter" value="0">
						</div>

                        <div class="col-sm-12">

                            <div id="hardees_branches">
                                <select readonly class="form-control" data-width="100%" style="margin-bottom: 10px; border-radius: 0px" name="restaurant_id" required>
                                    <option>Select Branch</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">

                            <div id="hardees_rider">
                                <select readonly class="form-control" data-width="100%" style="margin-bottom: 10px; border-radius: 0px" name="rider_id">
                                    <option>Riders</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>

                </fieldset>
                <div class="card-footer text-right">
                    <button id="btnSubmit" name="" class="btn" type="submit" style="background-color: #F6BF2D; color: black; font-weight: bold">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

<div class="modal fade" id="addonModal" style="display: none" tabindex="-1" role="dialog" aria-labelledby="addonModal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <button type="button" class="btn waves-effect ml-auto" style="border-radius: 0px; color: #f6bf2d; background-color: black" data-dismiss="modal">Close</button>
            <!-- <div><img src="{{asset('user')}}/img/burger.png" width="100%" height="250px"> </div>-->
            <div class="modal-header">

                <h4 id="item-name" class="modal-title text-dark font-weight-bold"> </h4>
                <p id="item-price" class="font-weight-bold"><br></p>

            </div>

            <div class="modal-body">
                <h5 style="color:black; font-size: 16px">Select variation<span style="font-size: 12px; color:#7c888d; float: right; "> ( 1 Required )</span></h5>

                <table class="table" id="variations">

                </table>
                <hr><br>
                <div class="">
                    <div id="variation-items"></div>
                </div>

            </div>

            <div class="modal-footer">

                <!--<button type="button" id="minus" class="btn text-warning" style="background-color: black; border: 1px solid #f6bf2d;" data-type="minus" data-field="">-</button>-->

                <label> Quantity </label> <input type="text" id="vquantity" name="vquantity" style="width: 50px; text-align:center" class="input-number" value="1" min="1" max="100">

                <!--<button id="qtyadd" type="button" class="quantity-right-plus btn text-warning btn-number" style="background-color: black; border: 1px solid #f6bf2d;" data-type="plus" data-field="">+</button>-->
                <a href="#" onclick="addToBucket()" class="btn btn-sm btn-light" style=" color: black; font-weight: 600; background-color: #f6bf2d; margin-top:0px; border:2px solid #f6bf2d; margin-left:10px;"><b>ADD TO BUCKET</b></a>

            </div>
        </div>

    </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyBl-jpsktXKHLD7rFQo9NT3Hfgm16b27C0&libraries=places"></script>
<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

<script>
    // $("#booking-form").submit(function(e) {
    // e.preventDefault();

    // var totalItems = $(this).find('input[name="items[]"]:checked').length;
    // var totalDeal = $(this).find('input[name="deals[]"]:checked').length;
    // var totalAddons = $(this).find('input[name="addons[]"]:checked').length;

    // if(totalItems > 0 || totalDeal > 0 || totalAddons > 0) {
    // $(this).submit()
    // } else {
    // Swal.fire(
    // 'Alert!',
    // 'Please select item, deal or addon!',
    // 'error'
    // )
    // }
    // });
    $("#searchbox").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "search-customer",
                dataType: "json",
                method: "POST",
                data: {
                    term: request.term
                },
                success: function(data) {

                    response($.map(data, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[0] + ', ' + code[1] + ', ' + code[2] + ', ' + code[3],
                            value: code[2],
                            data: item
                        }

                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 2,
        select: function(event, ui) {
            var names = ui.item.data.split("|");

            $("#first_name").val(names[0]);
            $("#last_name").val(names[1]);
            $("#phone").val(names[2]);
            $("#address").val(names[3]);

        }
    });
    var form = document.getElementById('booking-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        // Disable the submit button to prevent repeated clicks
        document.getElementById('btnSubmit').disabled = true;
        form.submit();
    })


    // When the user clicks on div, open the popup
    function myFunction(menuId) {
        var popup = document.getElementById("myPopup-" + menuId);
        popup.classList.toggle("show");
    }

    function myFunctionClose(menuId) {
        var popup_close = document.getElementById("myPopup-" + menuId);
        popup_close.classList.toggle("hide");
    }

    function menuItems(categoryId) {
        $.ajax({
            type: 'POST',
            url: 'get-menu-items',
            data: {
                "menu_category_id": categoryId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                document.getElementById('menu-container').innerHTML = response;
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function addToCart(attribute) {

        var quantityElement = document.getElementById("quantity-" + attribute.id).value;

        if (attribute.checked) {
            $.ajax({
                type: 'POST',
                url: 'add-to-cart',
                data: {
                    "item_id": attribute.value,
                    'quantity': quantityElement
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    attribute.setAttribute("cart_id", response.data.cart_id);
                },
                error: function(error) {
                    console.log(error)
                }
            });
        } else {
            var cartId = attribute.getAttribute('cart_id');
            $.ajax({
                type: 'POST',
                url: 'remove-to-cart',
                data: {
                    "cart_id": cartId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('message');
                },
                error: function(error) {
                    console.log(error)
                }
            });
        }
    }

    function addQuantity(value) {
        var element = document.getElementById("quantity-" + value);
        var itemId = element.getAttribute('data_id');
        var cartId = document.getElementById(itemId).getAttribute("cart_id");
        var newQuantity = +element.value + +1;
        element.value = newQuantity;
        $.ajax({
            type: 'POST',
            url: 'add-quantity',
            data: {
                "cart_id": cartId,
                "item_id": itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function removeQuantity(value) {
        var element = document.getElementById("quantity-" + value);
        var itemId = element.getAttribute('data_id');
        var cartId = document.getElementById(itemId).getAttribute("cart_id");
        var newQuantity = element.value - 1;
        if (newQuantity < 0) {
            newQuantity = 0
        }
        element.value = newQuantity;
        $.ajax({
            type: 'POST',
            url: 'remove-quantity',
            data: {
                "cart_id": cartId,
                "item_id": itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function addDealToCart(attribute) {

        var quantityElement = document.getElementById("deal-quantity-" + attribute.id).value;

        if (attribute.checked) {
            $.ajax({
                type: 'POST',
                url: 'add-to-cart',
                data: {
                    "deal_id": attribute.value,
                    'deal_quantity': quantityElement
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    attribute.setAttribute("cart_deal_id", response.data.cart_id);
                },
                error: function(error) {
                    console.log(error)
                }
            });
        } else {
            var cartId = attribute.getAttribute('cart_deal_id');
            $.ajax({
                type: 'POST',
                url: 'remove-to-cart',
                data: {
                    "cart_id": cartId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('message');
                },
                error: function(error) {
                    console.log(error)
                }
            });
        }
    }

    function addDealQuantity(value) {
        var element = document.getElementById("deal-quantity-" + value);
        var itemId = element.getAttribute('data_id');
        var cartId = $(".deal-" + itemId).attr("cart_deal_id");
        var newQuantity = +element.value + +1;
        element.value = newQuantity;
        $.ajax({
            type: 'POST',
            url: 'add-quantity',
            data: {
                "cart_id": cartId,
                "deal_id": itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function removeDealQuantity(value) {
        var element = document.getElementById("deal-quantity-" + value);
        var itemId = element.getAttribute('data_id');
        var cartId = $(".deal-" + itemId).attr("cart_deal_id");
        var newQuantity = element.value - 1;
        if (newQuantity < 0) {
            newQuantity = 0
        }
        element.value = newQuantity;
        $.ajax({
            type: 'POST',
            url: 'remove-quantity',
            data: {
                "cart_id": cartId,
                "deal_id": itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function addAddonToCart(attribute) {
        var quantityElement = document.getElementById("addon-type-quantity-" + attribute.id).value;

        var typeId = attribute.getAttribute('addon_type_id');
        if (attribute.checked) {
            $.ajax({
                type: 'POST',
                url: 'add-to-cart',
                data: {
                    "addon_id": attribute.value,
                    'addon_quantity': quantityElement,
                    'addon_type_id': typeId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    attribute.setAttribute("addon_cart_id", response.data.cart_id);
                },
                error: function(error) {
                    console.log(error)
                }
            });
        } else {
            var cartId = attribute.getAttribute('addon_cart_id');
            $.ajax({
                type: 'POST',
                url: 'remove-to-cart',
                data: {
                    "cart_id": cartId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('message');
                },
                error: function(error) {
                    console.log(error)
                }
            });
        }
    }

    function addAddonQuantity(value) {
        var element = document.getElementById("addon-type-quantity-" + value);
        var itemId = element.getAttribute('data_id');
        var typeId = element.getAttribute('type_id');
        var cartId = $(".addon-type-" + typeId).attr("addon_cart_id");
        var newQuantity = +element.value + +1;
        element.value = newQuantity;
        $.ajax({
            type: 'POST',
            url: 'add-quantity',
            data: {
                "cart_id": cartId,
                "addon_id": itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    function removeAddonQuantity(value) {
        var element = document.getElementById("addon-type-quantity-" + value);
        var itemId = element.getAttribute('data_id');
        var typeId = element.getAttribute('type_id');
        var cartId = $(".addon-type-" + typeId).attr("addon_cart_id");
        var newQuantity = element.value - 1;
        if (newQuantity < 0) {
            newQuantity = 0
        }
        element.value = newQuantity;
        $.ajax({
            type: 'POST',
            url: 'remove-quantity',
            data: {
                "cart_id": cartId,
                "addon_id": itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response.message);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }

    $(document).ready(function(e) {
        initialize();
    });

    function initialize() {

        var options = {
            componentRestrictions: {
                country: "pk"
            }
        };

        var input = document.getElementById('drop_off_location');
        var autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            var latitude = place.geometry['location'].lat();
            var longitude = place.geometry['location'].lng();
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            $('#location_search_filter').val(1);

            nearestRestaurant(latitude, longitude);

        });
    }

    function nearestRestaurant(lat, lng) {

        $.ajax({
            url: 'nearest-restuarant',
            type: 'POST',
            data: {
                latitude: lat,
                longitude: lng
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("#hardees_branches").html(response.data.nearestRestaurants);
                $("#hardees_rider").html(response.data.restaurantRiders);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }


    ///////////////////////////////////////////////

    function itemAddonModel(element) {
        $('#variation-items').html("");

        var itemId = element.getAttribute('data-id');
        var itemName = element.getAttribute('data-name');
        var itemPrice = element.getAttribute('data-price');

        $('#item-name').html(itemName);
        $('#item-price').html(itemPrice);

        $.ajax({
            'type': 'POST',
            'url': 'item-variations',
            'data': {
                item_id: itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success': function(response) {
                $("#variations").html(response);
            },
            'error': function(response) {
                alert("Error");
            }
        })

        $('#addonModal').modal('toggle');
    }

    function vItems(element) {
        var variationId = element.id;
        var itemId = element.getAttribute('item-id');

        $.ajax({
            'type': 'POST',
            'url': 'variation-items',
            'data': {
                variation_id: variationId,
                item_id: itemId
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'success': function(response) {
                $("#variation-items").html(response);
            },
            'error': function(response) {
                console.log(response);
            }
        })
    }

    function addToBucket() {
        var vElement = document.querySelector("input[name=variation]:checked");
        var itemId = vElement.getAttribute('item-id');

        var variationId = vElement.id;

        var dElement = document.querySelector("input[name=drink]:checked");

        var drinkId = "";
        if (dElement == null) {
            var drinkId = "";
        } else {
            var drinkId = dElement.id;
        }

        var sElement = document.querySelector("input[name=side]:checked");

        var sideId = "";
        if (sElement == null) {
            var sideId = "";
        } else {
            var sideId = sElement.id;
        }

        var eElement = document.querySelector("input[name=extra]:checked");

        var extraId = "";
        if (eElement == null) {
            var extraId = "";
        } else {
            var extraId = eElement.id;
        }

        var quantity = $("#vquantity").val();

        var addons = [];
        $("input:checkbox[name=addon]:checked").each(function() {
            addons.push($(this).val());
        });

        console.log(addons);

        $.ajax({
            'type': 'POST',
            'url': 'add-to-bucket',
            'data': {
                item_id: itemId,
                variation_id: variationId,
                drink_id: drinkId,
                side_id: sideId,
                extra_id: extraId,
                quantity: quantity,
                addons: addons,
            },
            success: function(response) {
                Swal.fire({
                    title: 'Success',
                    text: "Item added successfully.",
                    icon: 'success',
                    confirmButtonText: 'Continue'
                })
            },
            error: function(response) {
                console.log(response);
            }
        });

    }
</script>

@endsection
