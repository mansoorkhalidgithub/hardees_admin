 @extends('layouts.main') @section('content')
 <style>
     .abc tr {
         line-height: 40px;
     }
 </style>
 <div style="margin: 0px 10px 10px 10px">
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h3 style="color: black; font-family: serif; font-weight: bold">{{ $model->first_name }} {{$model->last_name}}:</h3>

         <a href="#" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #dc3545; color: white">Delete</a>

     </div>
     <hr>
     <div class="row" style="margin-bottom:2rem">
         <div class="col-sm-12">
             <table class="table-striped abc" style="width:100%; font-size: 18px; color: black;">
                 <tbody>
                     <tr>
                         <td style="font-weight: bold">Profile Pic:</td>
                         <td>0000</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Name:</td>
                         <td>{{ $model->first_name }} {{$model->last_name}}</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Country:</td>
                         <td>
                             @if(!empty($model->country_id))
                             {{ $model->country->name }}
                             @else
                             Not set
                             @endif
                         </td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">State:</td>
                         <td>
                             @if(!empty($model->state_id))
                             {{ $model->state->name }}
                             @else
                             Not set
                             @endif
                         </td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">City:</td>
                         <td>
                             @if(!empty($model->city_id))
                             {{ $model->city->name }}
                             @else
                             Not set
                             @endif
                         </td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Contact No.:</td>
                         <td>{{ $model->phone_number }}</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Email:</td>
                         <td>{{ $model->email }}</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">UserName:</td>
                         <td>{{ $model->username }}</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Group Name:</td>
                         <td>Country Admin</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Login IP:</td>
                         <td>103.255.4.11</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Status:</td>
                         <td>@if($model->status === 0) Active @elseif($model->status === 1) In Active @endif</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Last Login Date:</td>
                         <td>11-05-2020 07:39 PM</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Modify Date:</td>
                         <td>12-05-2020 01:09 AM</td>
                     </tr>
                     <tr>
                         <td style="font-weight: bold">Created Date:</td>
                         <td>30-01-2020 08:52 AM</td>
                     </tr>
                 </tbody>

             </table>
         </div>


     </div>
 </div>




 @endsection