@extends('layouts.main')

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
        margin-left: auto;
        margin-right: auto;
    }
    .col-sm-2
    {
        margin: auto;
    }
    .add-qty
    {
        margin-left: 25px;
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
        height: 140px;
        width: 150px;
    }
    label.category > a > input {
        width:250px;
        height:100px;
        cursor:pointer;
        float:left;
        border:#999 solid 1px;
    }
    label.category > a > input:checked + div{
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
<div  style="margin: 0px 10px 10px 10px; padding: 10px">

    <div class="card">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 fontawesomeheading">NEW BOOKING</h1>
            <!--                <a href="#"
                               class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                                    class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Menu List</span></a>-->

        </div>
        <div class="card-body">
            <form>
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

                                <input id="product_name" name="product_name" style="border-radius: 0px" class="form-control " required="" type="text">


                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">LAST NAME</label>  

                                <input id="product_name" name="product_name" style="border-radius: 0px" class="form-control " required="" type="text">


                            </div>
                        </div>

                        <!-- Text input-->

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">PHONE #</label>  

                                <input id="product_name" name="product_name" style="border-radius: 0px" class="form-control " required="" type="text">


                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="product_name">ADDRESS</label>  

                                <input id="product_name" name="product_name" style="border-radius: 0px" class="form-control " required="" type="text">


                            </div>
                        </div>

                        <!-- Text input-->

                    </div>
                    <hr>

                    <h4 class="h3 mb-0 fontawesomeheading">Select Menu</h4><br>
                    <div>

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
                                <a data-toggle="modal" data-target="#addonModal">
                                    <label class="category">
                                        <input type="checkbox" name="category" value="item1"/>
                                        <div>
                                            <p class="product_label">Philly Cheese Steak</p><br>
                                            <div class="popup"><img src="{{asset('/img/17.png')}}"  class="product_image">
                                            </div>
                                        </div>
                                    </label>
                                </a>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                        <div class="row" style="margin: 10px 10px 10px 30px">

                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
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
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/14.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/15.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/16.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/14.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/15.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/16.png')}}" class="product_image">
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

                        <div class="row" style="margin: 10px 10px 10px 30px">

                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/18.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/19.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/18.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/20.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/19.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/20.png')}}" class="product_image">
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

                        <div class="row" style="margin: 10px 10px 10px 30px">

                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/11.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/12.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/13.png')}}" class="product_image">
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
                            <div class="col-sm-2">
                                <label class="category">
                                    <input type="checkbox" name="category" value="item1"/>
                                    <div>
                                        <p class="product_label">Philly Cheese Steak</p><br>
                                        <img src="{{asset('/img/21.png')}}" class="product_image">
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
            </form>
        </div>
        <div class="card-footer text-right">
            <button id="" name="" class="btn" type="submit" style="background-color: #F6BF2D; color: black; font-weight: bold">Submit</button>
        </div>
    </div>
</div>




<script src="{{ asset('js/jquery.min.js') }}" ></script>
<script>

$(function () {
    $('#ala_carte').click(function () {
        $('.ala_carte_items').attr('hidden', false);
        $('.with_drink_items').attr('hidden', true);
        $('.regular_combo_items').attr('hidden', true);
        $('.medium_combo_items').attr('hidden', true);
        $('.large_combo_items').attr('hidden', true);
    });
    $('#with_drink').click(function () {
        $('.ala_carte_items').attr('hidden', true);
        $('.with_drink_items').attr('hidden', false);
        $('.regular_combo_items').attr('hidden', true);
        $('.medium_combo_items').attr('hidden', true);
        $('.large_combo_items').attr('hidden', true);
    });
    $('#regular_combo').click(function () {
        $('.ala_carte_items').attr('hidden', true);
        $('.with_drink_items').attr('hidden', true);
        $('.regular_combo_items').attr('hidden', false);
        $('.medium_combo_items').attr('hidden', true);
        $('.large_combo_items').attr('hidden', true);
    });
    $('#medium_combo').click(function () {
        $('.ala_carte_items').attr('hidden', true);
        $('.with_drink_items').attr('hidden', true);
        $('.regular_combo_items').attr('hidden', true);
        $('.medium_combo_items').attr('hidden', false);
        $('.large_combo_items').attr('hidden', true);
    });
    $('#large_combo').click(function () {
        $('.ala_carte_items').attr('hidden', true);
        $('.with_drink_items').attr('hidden', true);
        $('.regular_combo_items').attr('hidden', true);
        $('.medium_combo_items').attr('hidden', true);
        $('.large_combo_items').attr('hidden', false);
    });
});

</script> 
@endsection


<div class="modal fade" id="addonModal"  style="display: none"  tabindex="-1" role="dialog" aria-labelledby="addonModal" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">
            <!--button type="button" class="close ml-auto" data-dismiss="modal" aria-label="Close">
                <img src="{{asset('user')}}/img/plus-button copy.png" width="20px" height="20px">
                </button-->
            <button type="button" class="btn waves-effect ml-auto" style="border-radius: 0px; color: #f6bf2d; background-color: black" data-dismiss="modal">Close</button>
<!--            <div><img src="{{asset('user')}}/img/burger.png" width="100%" height="250px"> </div>-->
            <div class="modal-header">

                <h4 class="modal-title text-dark font-weight-bold" id="exampleModalLabel">Super Star with Cheese </h4>
                <p class="font-weight-bold">PKR 750.0<br>
<!--                    <span class="font-weight-normal">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Id ipsam

                    </span>-->
                </p>



            </div>
            <div class="modal-body">
                <h5 style="color:black; font-size: 16px">Select variation<span style="font-size: 12px; color:#7c888d; float: right; "> ( 1 Required )</span></h5>
                <span style="color:black; font-size: 13px">Select 1</span>

                <table class="table">
                    <tbody>
                        <tr>
                            <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="addon" id="ala_carte"> Ala Carte</td>

                            <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 890.0</td>
                        </tr>

                        <tr>
                            <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="addon" id="with_drink"> With Drink</td>

                            <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 890.0</td>
                        </tr>

                        <tr>
                            <td style="border-bottom:1px solid transparent;color:black"><input type="radio" name="addon" id="regular_combo"> Regular Combo </td>

                            <td style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 890.0</td>
                        </tr>

                        <tr>
                            <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="addon" id="medium_combo"> Medium Combo</td>

                            <td style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 890.0</td>
                        </tr>

                        <tr>
                            <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="addon" id="large_combo"> Large Combo</td>

                            <td style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 890.0</td>
                        </tr>
                    </tbody>
                </table>


                <hr>
                <br>

                <div class="ala_carte_items"  hidden="true">
                    <h5 style="color:black; font-size: 16px">Extra Meat Patty<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Optional</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="extra_meat"> Large Meat</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Add Ons<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Select up to 4 (Optional)</span>
                    <br>
                    <table class="table text-light">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="mushroom"> Mushroom</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 100.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="jalapeno" > Jalapeno</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="cheese" > Cheese</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 40.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="dip_suace" > Dip Suace</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>

                        </tbody>
                    </table>


                </div>


                <div class="with_drink_items"   hidden="true">
                    <h5 style="color:black; font-size: 16px">Choose your Drink<span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5>
                    <span style="color:black; font-size: 13px">Select 1</span>
                    <br>
                    <table class="table text-light" style="border-top:1px solid white;">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coke</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Sprite</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Fanta</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Strawberry Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Chocolate Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Vanilla Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coffee Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Extra Meat Patty<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Optional</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="extra_meat"> Large Meat</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Add Ons<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Select up to 4 (Optional)</span>
                    <br>
                    <table class="table text-light">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="mushroom"> Mushroom</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 100.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="jalapeno" > Jalapeno</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="cheese" > Cheese</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 40.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="dip_suace" > Dip Suace</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>

                        </tbody>
                    </table>


                </div>



                <div class="regular_combo_items"  hidden="true">
                    <h5 style="color:black; font-size: 16px">Choose your Drink<span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5>
                    <span style="color:black; font-size: 13px">Select 1</span>
                    <br>
                    <table class="table text-light" style="border-top:1px solid white;">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coke</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Sprite</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Fanta</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Strawberry Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Chocolate Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Vanilla Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coffee Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Sides<span style="font-size: 12px; color:#7c888d; float: right; "> 1 Required</span></h5>
                    <span style="color:black; font-size: 13px">Select 1</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Natural Cut Fries</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Onion Rings</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 80.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Curly Fries</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 80.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Extra Meat Patty<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Optional</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="extra_meat"> Large Meat</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Add Ons<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Select up to 4 (Optional)</span>
                    <br>
                    <table class="table text-light">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="mushroom"> Mushroom</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 100.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="jalapeno" > Jalapeno</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="cheese" > Cheese</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 40.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="dip_suace" > Dip Suace</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>

                        </tbody>
                    </table>


                </div>



                <div class="medium_combo_items"  hidden="true">
                    <h5 style="color:black; font-size: 16px">Choose your Drink<span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5>
                    <span style="color:black; font-size: 13px">Select 1</span>
                    <br>
                    <table class="table text-light" style="border-top:1px solid white;">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coke</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Sprite</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Fanta</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Strawberry Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Chocolate Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Vanilla Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coffee Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Sides<span style="font-size: 12px; color:#7c888d; float: right; "> 1 Required</span></h5>
                    <span style="color:black; font-size: 13px">Select 1</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Natural Cut Fries</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Onion Rings</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 80.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Curly Fries</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 80.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Extra Meat Patty<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Optional</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="extra_meat"> Large Meat</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Add Ons<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Select up to 4 (Optional)</span>
                    <br>
                    <table class="table text-light">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="mushroom"> Mushroom</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 100.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="jalapeno" > Jalapeno</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="cheese" > Cheese</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 40.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="dip_suace" > Dip Suace</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>

                        </tbody>
                    </table>


                </div>



                <div class="large_combo_items"  hidden="true">
                    <h5 style="color:black; font-size: 16px">Choose your Drink<span style="font-size: 12px; color:#7c888d; float: right; "> 1 REQUIRED</span></h5>
                    <span style="color:black; font-size: 13px">Select 1</span>
                    <br>
                    <table class="table text-light" style="border-top:1px solid white;">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coke</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Sprite</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Fanta</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Strawberry Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Chocolate Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Vanilla Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="drink" > Coffee Shake</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Sides<span style="font-size: 12px; color:#7c888d; float: right; "> 1 Required</span></h5>
                    <span style="color:black; font-size: 13px">Select 1</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Natural Cut Fries</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px"></td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Onion Rings</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 80.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="radio" name="sides"> Curly Fries</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 80.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Extra Meat Patty<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Optional</span>
                    <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="extra_meat"> Large Meat</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 270.0</td>
                            </tr>

                        </tbody>
                    </table>
                    <br>
                    <h5 style="color:black; font-size: 16px">Choose your Add Ons<span style="font-size: 12px; color:#7c888d; float: right; "> OPTIONAL</span></h5>
                    <span style="color:black; font-size: 13px">Select up to 4 (Optional)</span>
                    <br>
                    <table class="table text-light">
                        <tbody>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="mushroom"> Mushroom</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 100.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="jalapeno" > Jalapeno</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="cheese" > Cheese</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 40.0</td>
                            </tr>
                            <tr>
                                <td  style="border-bottom:1px solid transparent;color:black"><input type="checkbox" name="dip_suace" > Dip Suace</td>

                                <td  style="border-bottom:1px solid transparent;color:black; font-size: 12px">+ PKR 50.0</td>
                            </tr>

                        </tbody>
                    </table>


                </div>



            </div>
            <div class="modal-footer">

                <button type="button" id="minus" class="btn text-warning" style="background-color: black; border: 1px solid #f6bf2d;" data-type="minus" data-field="">-</button>

                <input type="text" id="qty" name="quantity" style="width: 30px; text-align:center" class="input-number" value="0" min="1" max="100">

                <button id="qtyadd" type="button" class="quantity-right-plus btn text-warning btn-number" style="background-color: black; border: 1px solid #f6bf2d;" data-type="plus" data-field="">+</button>
                <a href="#" class="btn btn-sm btn-light" style=" color: black; font-weight: 600; background-color: #f6bf2d; margin-top:0px; border:2px solid #f6bf2d; margin-left:10px;"><b>ADD TO BUCKET</b></a>

            </div>
        </div>

    </div>
</div>