 @extends('layouts.main')
 @section('content')
 <style>
     .input-controls {
         margin-top: 10px;
         border: 1px solid transparent;
         border-radius: 2px 0 0 2px;
         box-sizing: border-box;
         -moz-box-sizing: border-box;
         height: 32px;
         outline: none;
         box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
     }

     #searchInput {
         background-color: #fff;
         font-family: Roboto;
         font-size: 15px;
         font-weight: 300;
         /*margin-left: 12px;*/
         padding: 0 11px 0 13px;
         text-overflow: ellipsis;
         width: 50%;
     }

     #searchInput:focus {
         border-color: #4d90fe;
     }

     .textInput {
         background-color: #fff;
         font-family: Roboto;
         font-size: 15px;
         font-weight: 300;
         /*margin-left: 12px;*/
         padding: 0 11px 0 13px;
         text-overflow: ellipsis;
         width: 50%;
     }

     #results {
         width: 100%;
         display: none;
         border-bottom: 1px solid black;
         border-left: 1px solid black;
         border-right: 1px solid black;
     }

     #results #item {
         box-sizing: border-box;
         padding: 10px;
         font-size: 18px;
         width: 100%;
         background: white;
         border-bottom: 1px solid #bdbdbd;
     }
 </style>
 <div class="row" style="padding: 20px;">
     <div class="col-sm-12">
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
             <h1 class="h3 mb-0 text-gray-800">New Booking</h1>
             <a href="" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-fw fa-1x fa-arrow-circle-left fa-sm text-white-50"></i>Booking history</a>

         </div>

         <div class="card" style="border: none; background-color: transparent; width: 50%">
             <div class="card-header">Step 1</div>
             <div class="card-body cat-card-body">
                 <form role="form" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="row form-group">
                         <div class="col-sm-10">
                             <input id="searchbox" class="input-controls textInput" style="width: 100% !important;" type="search" name="keyword" placeholder="Search Old Customer by Name, Number" value="" autofocus>
                         </div>
                         <div class="col-sm-2" style="margin-top:8px;">
                             <input type="reset" name="Reset" value="Reset" class="btn btn-success btn-md btncustom" style="margin-left: 5px; width: 100%; border-color:#f6bf2d; background:#f6bf2d">
                         </div>
                     </div>
                     <div class="clearfix"></div>
                     <div class="col-sm-12">
                         <div id="results"></div>
                     </div>
                     <div class="row form-group category-table">
                         <div class="col-sm-6">
                             <input id="UserName" name="user_name" class="input-controls textInput" type="text" placeholder="First Name" style="width: 100%;">
                         </div>
                         <div class="col-sm-6">
                             <input id="UserLastName" name="user_last_name" class="input-controls textInput" type="text" placeholder=" Last Name" style="width: 100%;">
                         </div>
                     </div>

                     <!--For entering post tags-->

                     <div class="row form-group category-table">
                         <div class="col-sm-12">
                             <input id="UserPhone" name="user_phone" class="input-controls textInput" type="text" placeholder="Phone Number" style="width: 100%;">
                         </div>
                         <div class="col-sm-12">
                             <input id="address" name="user_address" class="input-controls textInput" type="text" placeholder="Address" style="width: 100%;">
                         </div>
                     </div>

                     <!--For entering address-->

                     <div class="row form-group category-table">
                         <div class="col-sm-12">
                             <label style="color: darkgray; font-family: Roboto;">Booking details :</label>
                         </div>
                         <div class="col-sm-12">
                             <select class="selectpicker input-controls textInput" data-live-search="true" data-width="100%" style="width: 100%" id="ct_id" name="Trip[iVehicleTypeId]">

                                 <option>Delivery Lahore</option>
                                 <option>Delivery Multan</option>
                                 <option>Delivery Gujranwala</option>
                                 <option>Delivery Rawalpindi</option>
                                 <option>Delivery Islamabad</option>
                                 <option>Delivery Karachi</option>
                                 <option>Delivery Peshawar</option>


                             </select>
                         </div>
                     </div>
                 </form>


                 <br>
                 <div class="row form-group category-table">
                     <div class="col-sm-12">
                         <input type="submit" name="next" value="Next" class="btn btn-success btn-md btn custom ml-auto" style=" float: right; width: 15%;margin-right:20px; border-color:#f6bf2d; background:#f6bf2d; padding: 8px 15px 8px 15px">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 @endsection