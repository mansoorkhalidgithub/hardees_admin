 @extends('layouts.form')
 @section('content')
 <style>
     * {
         margin: 0;
         padding: 0
     }

     p {
         color: grey
     }

     #heading {
         text-transform: uppercase;
         color: #673AB7;
         font-weight: normal
     }

     #msform {
         text-align: center;
         position: relative;
         margin-top: 20px
     }

     #msform fieldset {
         background: transparent;
         border: 0 none;
         border-radius: 0.5rem;
         box-sizing: border-box;
         width: 100%;
         margin: 0;
         padding-bottom: 20px;
         position: relative
     }

     .form-card {
         text-align: left
     }

     #msform fieldset:not(:first-of-type) {
         display: none
     }

     #msform input,
     #msform textarea,
     #msform select {
         padding: 8px 15px 8px 15px;
         border: 1px solid #ccc;
         border-radius: 0px;
         margin-bottom: 25px;
         margin-top: 2px;
         width: 100%;
         box-sizing: border-box;
         font-family: montserrat;
         color: #2C3E50;
         background-color: #ECEFF1;
         font-size: 16px;
         letter-spacing: 1px
     }

     #msform input:focus,
     #msform textarea:focus,
     #msform select:focus {
         -moz-box-shadow: none !important;
         -webkit-box-shadow: none !important;
         box-shadow: none !important;
         border: 1px solid #FEC52E;
         outline-width: 0
     }

     #msform .action-button {
         width: 100px;
         background: #FEC52E;
         font-weight: bold;
         color: white;
         border: 0 none;
         border-radius: 0px;
         cursor: pointer;
         padding: 10px 5px;
         margin: 10px 0px 10px 5px;
         float: right
     }

     #msform .action-button:hover,
     #msform .action-button:focus {
         background-color: #FEC52E
     }

     #msform .action-button-previous {
         width: 100px;
         background: #616161;
         font-weight: bold;
         color: white;
         border: 0 none;
         border-radius: 0px;
         cursor: pointer;
         padding: 10px 5px;
         margin: 10px 5px 10px 0px;
         float: right
     }

     #msform .action-button-previous:hover,
     #msform .action-button-previous:focus {
         background-color: #000000
     }

     .card {
         z-index: 0;
         border: none;
         position: relative
     }

     .fs-title {
         font-size: 18px;
         color: black;
         font-weight: normal;
         text-align: left
     }

     .purple-text {
         color: #FEC52E;
         font-weight: normal
     }

     .steps {
         font-size: 15px;
         color: black;
         margin-bottom: 6px;
         font-weight: normal;
         text-align: right
     }

     .fieldlabels {
         color: gray;
         text-align: left
     }

     #progressbar {
         margin-bottom: 18px;
         overflow: hidden;
         color: lightgrey
     }

     #progressbar .active {
         color: #FEC52E;
     }

     #progressbar li {
         list-style-type: none;
         font-size: 12px;
         width: 20%;
         float: left;
         position: relative;
         font-weight: 400
     }

     #progressbar #info:before {
         font-family: FontAwesome;
         content: "\f007"
     }

     #progressbar #menu:before {
         font-family: FontAwesome;
         content: "\f0f4"
     }

     #progressbar #dropoff:before {
         font-family: FontAwesome;
         content: "\f015"
     }

     #progressbar #summary:before {
         font-family: FontAwesome;
         content: "\f07a"
     }

     #progressbar #finish:before {
         font-family: FontAwesome;
         content: "\f00c"
     }

     #progressbar li:before {
         width: 50px;
         height: 50px;
         line-height: 45px;
         display: block;
         font-size: 20px;
         color: black;
         background: lightgray;
         border-radius: 50%;
         margin: 0 auto 10px auto;
         padding: 2px
     }

     #progressbar li:after {
         content: '';
         width: 100%;
         height: 2px;
         background: lightgray;
         position: absolute;
         left: 0;
         top: 25px;
         z-index: -1
     }

     #progressbar li.active:before,
     #progressbar li.active:after {
         background: #FEC52E;
     }

     .progress {
         height: 20px
     }

     .progress-bar {
         background-color: #FEC52E;
     }

     .fit-image {
         width: 50%;
         height: 100%;
         object-fit: cover;
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

     .col-sm-2 {
         margin: auto;
     }

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
         background-color: rgba(0, 0, 0, 0.8);
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
 </style>

 <div style="margin: 0px 10px 10px 10px; padding: 20px; background-color: white">
     <div>
         <div>
             <strong> Order Reference : </strong> {{ $order->order_reference }}
             <div class="card" style="background-color: transparent">
                 <form id="msform" method="post" action="{{route('resend-order')}}">
                     @csrf
                     <input type="hidden" value="{{$order->id}}" name="order_id">
                     <fieldset>
                         <div class="form-card">
                             <div class="row">
                                 <select name="rider" style="border-radius: 0px" class="form-control">
                                     <option selected="" disabled="" hidden="">Choose Rider</option>
                                     @foreach($riders as $key=> $rider)
                                     @if($rider->getRiderStatus->online_status == 'online')
                                     <option selected value="{{$rider->id}}">{{$rider->name}}</option>
                                     @endif
                                     @endforeach
                                 </select>
                             </div>
                             <div class="row">
                                 <div class="col-sm-7">
                                     <div class="cart_totals">
                                         <table cellspacing="0">
                                             <tr>
                                                 <th>Subtotal</th>
                                                 <td data-title="Subtotal">
                                                     <span>
                                                         <span>PKR </span> {{ $order->sub_total }}
                                                     </span>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <th>Estimated Time:</th>
                                                 <td data-title="Subtotal">

                                                     <span>10 - 15 mins</span>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <th>Service Tax</th>
                                                 <td data-title="Subtotal">
                                                     <span>
                                                         <span>PKR </span> 0
                                                     </span>
                                                 </td>
                                             </tr>
                                             <tr class="order-total border-0">
                                                 <th>Total</th>
                                                 <td data-title="Total">
                                                     <span>
                                                         <span>PKR </span> {{ $order->total }}
                                                     </span>
                                                 </td>

                                             </tr>

                                         </table>
                                     </div>
                                     <p><textarea placeholder="Note for Rider..." class="form-control" rows="3" style="border-radius: 0px" oninput="this.className = ''" name="rider_note"></textarea></p>
                                 </div>

                             </div>
                         </div>
                         <button type="submit" id="submit-btn" class="btn btn-primary btn-lg"> Submit </button>
                     </fieldset>

                 </form>
             </div>
         </div>
     </div>
 </div>

 @endsection

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@3/dark.css" rel="stylesheet">
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>

 <script>
     function sendNotification(orderId, restaurantId, riderId) {
         console.log(riderId)
         var deductionAmount = $("#deduction").val();
         $.ajax({
             type: "POST",
             url: "send-notification",
             data: {
                 order_id: orderId,
                 restaurant_id: restaurantId,
                 rider_id: riderId,
                 deduction_amount: deductionAmount
             },
             success: function(response) {
                 console.log(response);
                 Swal.fire({
                     title: 'Success',
                     text: "Order placed successfully.",
                     icon: 'success'
                 }).then((result) => {
                     window.location.href = "new-orders";
                 })
             },
             error: function(error) {
                 console.log(error);
             }
         });
     }
 </script>