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

         <a href="{{ route('rider.status', $model->id) }}" class="btn {{ ($model->status === 1) ? 'btn-success' : 'btn-danger' }}" style=" color: white;width:6rem">
             @if($model->status === 1) Active @elseif($model->status === 0) In Active @endif
         </a>

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
                         <td>Online Status:</td>
                         <td>
                             @if($model->eStatus === 10) Yes @elseif($model->eStatus === 9) No @endif
                         </td>
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
                         <td>IOS</td>
                     </tr>
                     <tr>
                         <td>Device Name:</td>
                         <td>iPhone 6s</td>
                     </tr>
                     <tr>
                         <td>Device ID:</td>
                         <td>354F0795-4DD7-4C7A-8A10-B7D70CFBC503</td>
                     </tr>
                     <tr>
                         <td>Login with:</td>
                         <td>Normal</td>
                     </tr>
                     <tr>
                         <td>APP Version:</td>
                         <td>2</td>
                     </tr>
                     <tr>
                         <td>Authentication Key:</td>
                         <td>a65113043fb89476a2f26c8ef730e9cc</td>
                     </tr>

                 </tbody>

             </table>
         </div>

     </div>

 </div>






 @endsection