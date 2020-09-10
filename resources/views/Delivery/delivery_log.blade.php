 @extends('layouts.main')
 @section('content')
 <style>
     .abc tr {
         line-height: 40px;
     }

     .table-bordered th {
         border: 1px solid transparent;
     }
 </style>
 <div style="margin: 0px 10px 10px 10px">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h3 style="color: black; font-family: serif; font-weight: bold">{{$order->order_reference}} Detail:</h3>

         <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #dc3545; color: white"><i class="fas fa-fw fa-1x fa-trash-alt fa-sm text-light-300"></i>Delete</a> -->

     </div>
     <hr>
     <div class="row" style="margin-bottom:2rem">
         <div class="col-sm-12">
             <table class="table-striped table-bordered abc" style="width:100%; font-size: 15px; color: black;">
                 <thead>
                     <tr>
                         <th colspan="2" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Booking Details:</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>Booking #:</td>
                         <td>Hardees{{$order->order_reference}}</td>
                     </tr>
                     <tr>
                         <td>Customer Name:</td>
                         <td>{{$order->customer->name}}</td>
                     </tr>
                     <tr>
                         <td>Customer Contact No:</td>
                         <td>{{$order->customer->phone_number}}</td>
                     </tr>
                     <tr>
                         <td>Customer Address:</td>
                         <td>{{$order->customer->address}}</td>
                     </tr>
                     <tr>
                         <td>Pickup Location:</td>
                         <td>{{$order->restaurant->name}}</td>
                     </tr>
                     <tr>
                         <td>Drop-off Location:</td>
                         <td>{{$order->address}}</td>
                     </tr>
                     <tr>
                         <td>Payment Mode:</td>
                         <td>{{$order->paymentType->name}}</td>
                     </tr>
                     <tr>
                         <td>Order Details:</td>
                         <td>@foreach($order->items as $key => $item)
                             {{++$key.":".$item}} <br>
                             @endforeach
                         </td>
                     </tr>
                     <tr>
                         <td>Order Amount:</td>
                         <td>{{$order->total}}</td>
                     </tr>
                     <tr>
                         <td>Order Taken By:</td>
                         <td>Call Center</td>
                     </tr>
                     <tr>
                         <td>Booking Time:</td>
                         <td>{{$order->created_at}}</td>
                     </tr>
                     <tr>
                         <td>Delivered Time:</td>
                         <td>{{$order->updated_at}}</td>
                     </tr>
                     <tr>
                         <td>Total Time:</td>
                         <td>{{$order->time}}</td>
                     </tr>
                 </tbody>

             </table>
         </div>


     </div>
     <hr>
     <div class="row" style="margin-bottom:2rem">

         <div class="col-sm-6">
             <table class="table-striped  abc" style="width:100%; font-size: 15px; color: black;">
                 <thead>
                     <tr>
                         <th colspan="3" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Delivery Log:</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>Trip Request:</td>
                         <td>{{$order->created_at}}</td>
                         <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                     </tr>
                     <tr>
                         <td>Trip Complete:</td>
                         <td>{{$order->updated_at}}</td>
                         <td><i class="fa fa-check-circle" style="color: #208637"></i></td>
                     </tr>

                 </tbody>

             </table>
         </div>
         <div class="col-sm-6">
             <table class="table-striped table-bordered abc" style="width:100%; font-size: 15px; color: black;">
                 <thead>
                     <tr>
                         <th colspan="2" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Delivery Boy Details:</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>Name:</td>
                         <td>{{$order->orderAssigned->rider->name}}</td>
                     </tr>
                     <tr>
                         <td>Contact #:</td>
                         <td>{{$order->orderAssigned->rider->phone_number}}</td>
                     </tr>
                     <tr>
                         <td>Rating:</td>
                         <td>{{$order->rating}}</td>
                     </tr>

                 </tbody>

             </table>
         </div>
     </div>

 </div>






 @endsection