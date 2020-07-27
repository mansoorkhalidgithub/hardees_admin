 @extends('layouts.main') @section('content')
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
         <h3 style="color: black; font-family: serif; font-weight: bold">{{$model->first_name}} {{$model->last_name}} :</h3>

         <td>
             <a href="{{ route('rider.status', $model->id) }}" class="btn {{ ($model->status === 1) ? 'btn-success' : 'btn-danger' }}" style=" color: white;width:6rem">
                 {{($model->status == 1) ? 'Active' : 'Deactive'}}
             </a>
         </td>

     </div>
     <hr>
     <div class="row" style="margin-bottom:2rem">
         <div class="col-sm-6">
             <table class="table-striped table-bordered abc" style="width:100%; font-size: 15px; color: black;">
                 <thead>
                     <tr>
                         <th colspan="2" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Personal Details:</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>Profile Picture:</td>
                         <td>0000</td>
                     </tr>
                     <tr>
                         <td>Name:</td>
                         <td>{{$model->first_name}} {{$model->last_name}}</td>
                     </tr>
                     <tr>
                         <td>Contact No:</td>
                         <td>{{$model->phone_number}}</td>
                     </tr>
                     <tr>
                         <td>Email:</td>
                         <td>{{$model->email}}</td>
                     </tr>
                     <tr>
                         <td>City Name:</td>
                         <td>
                             @if(!empty($model->city_id))
                             {{ $model->city->name }}
                             @else
                             Not set
                             @endif
                         </td>
                     </tr>
                     <tr>
                         <td>State Name:</td>
                         <td>
                             @if(!empty($model->state_id))
                             {{ $model->state->name }}
                             @else
                             Not set
                             @endif
                         </td>
                     </tr>
                     <tr>
                         <td>Country:</td>
                         <td>
                             @if(!empty($model->country_id))
                             {{ $model->country->name }}
                             @else
                             Not set
                             @endif
                         </td>
                     </tr>
                     <tr>
                         <td>Avg. Rating:</td>
                         <td>1</td>
                     </tr>
                     <tr>
                         <td>Vehicle Number:</td>
                         <td>
                             @if(!empty($model->vehicle->vehicle_number))
                             {{ $model->vehicle->vehicle_number }}
                             @else
                             Not set
                             @endif
                         </td>
                     </tr>
                     <tr>
                         <td>Online Status:</td>
                         <td>
                             {{($model->getRiderStatus->online_status == 'online') ? 'Online' : 'Offline'}} </td>
                     </tr>

                     <tr>
                         <td>Trip Status:</td>
                         <td>
                             {{($model->getRiderStatus->trip_status == 'free') ? 'Free' : 'On Trip'}} </td>
                     </tr>
                     <tr>
                         <td>Created Date:</td>
                         <td>{{$model->created_at}}</td>
                     </tr>
                 </tbody>

             </table>
         </div>
         <div class="col-sm-6">
             <table class="table-striped table-bordered abc" style="width:100%; font-size: 15px; color: black;">
                 <thead>
                     <tr>
                         <th colspan="2" style="color: red; font-weight: bold; font-size: 20px; font-family: serif; min-height:  500px">Device Details:</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>Device Type:</td>
                         <td>{{$model->device_type}}</td>
                     </tr>
                     <tr>
                         <td>Device Name:</td>
                         <td>{{$model->device_name}}</td>
                     </tr>
                     <tr>
                         <td>Device ID:</td>
                         <td>{{$model->device_id}}</td>
                     </tr>
                     <tr>
                         <td>Login with:</td>
                         <td>Normal</td>
                     </tr>
                     <tr>
                         <td>APP Version:</td>
                         <td>{{$model->app_version}}</td>
                     </tr>

                 </tbody>

             </table>
         </div>

     </div>

 </div>






 @endsection