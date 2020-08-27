@extends('layouts.main')

@section('title', 'Orders')

@section('content')

<div style="margin: 0px 10px 10px 10px">
	<div class="card">

		<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
			<h3 style="color: black; font-family: serif; font-weight: bold"> @yield('title') List </h3>
			@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
			@endif
			<a href="{{ route('booking') }}" class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i> Create Order </a>

		</div>
		<div class="card-body">
			@if(session()->get('success'))
			<div class="alert alert-success">{{ session()->get('success') }}</div>
			@endif

			<table class="table table-striped table-hover" id="orders">
				<thead>
					<tr style="color:black">
						<th scope="col">ID</th>
						<th scope="col"> Order Reference </th>
						<th scope="col"> Branch Name </th>
						<th scope="col">Status</th>
						<th scope="col"> Delivery Status </th>
						<th scope="col"> Rider Status </th>
						<th scope="col"> Resend </th>
						<th scope="col">Type</th>
					</tr>
				</thead>
				<tbody>
					@foreach($model as $key => $order)
					<tr>
						<th scope="row"> {{ ++$key }} </th>
						<td> {{ $order->order_reference }} </td>
						<td> {{ $order->restaurant->name }} </td>
						<td> {!! $order->status_html !!} </td>
						<td>
							<span class="btn btn-success btn-sm">
								@if(!empty($order->orderAssigned))
								{{ $order->orderAssigned->deliveryStatus->description }}
								@else NOTSET
								@endif
							</span>
						</td>

						<?php
						$status = (empty($order->orderAssigned)) ? '' // if
							: ($order->orderAssigned->trip_status_id == 1 && Carbon\Carbon::parse($order->orderAssigned->created_at)->addMinute(10) < Carbon\Carbon::now() ? ''
								: ($order->orderAssigned->trip_status_id == 8 || $order->orderAssigned->trip_status_id == 9 ? '' // elseif
									: 'disabled'));
						$riderstatus = (empty($order->orderAssigned)) ? 'disabled' // if
							: ($order->orderAssigned->trip_status_id == 2 || $order->orderAssigned->trip_status_id == 3 || $order->orderAssigned->trip_status_id == 4 ? '' // elseif
								: 'disabled');
						$tripstatus = (empty($order->orderAssigned)) ? 'Not Set' // if
							: ($order->orderAssigned->trip_status_id == 2 || $order->orderAssigned->trip_status_id == 3 || $order->orderAssigned->trip_status_id == 4 ? 'Ontrip' // elseif
								: 'Free');
						?>
						<td>
							<a href="{{ route('order.tripstatus', $order->id) }}" type="button" class="btn btn-danger {{$riderstatus}}" style="background-color:  #dc3545; color: white">
								<span style="font-size: 12px; font-weight: bold">
									{{$tripstatus}}
								</span>
							</a>
						</td>
						<td>
							<a href="{{route('resend',['id' => $order->id])}}" type="button" class="btn btn-danger {{$status}}" style="background-color:  #dc3545; color: white"><span style="font-size: 12px; font-weight: bold">Resend</span></a>
						</td>
						<td>
							<a type="button" class="btn {{($order->type->id == 1 ? 'btn-primary': 'btn-success')}}">
								<span style="font-size: 12px; font-weight: bold;color:white">
									{{$order->type->type}}
								</span>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#orders').DataTable();
	});
</script>

@endsection