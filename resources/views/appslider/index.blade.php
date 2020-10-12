@extends('layouts.main')

@section('title', 'Slider Images')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"> Manage @yield('title') </h3>
				<div class="card-tools">
					<a href="{{ route('slider.create') }}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Add @yield('title') </a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="">
					<table id="sliders" class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Sr No</th>
								<th scope="col">Slider Image</th>
								<th scope="col">Created By</th>
								<th scope="col">Description</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($model as $key => $slider)
							<tr>
								<th scope="row"> {{ ++$key }} </th>
								<td>
									<img src="{{ ($slider->slider_img) ? asset($slider->slider_img) : asset('/images/ic_gallery.jpg') }}" alt="" border=3 height=100 width=100>
									<!-- {{ $slider->slider_img }} -->
								</td>
								<td>
									@if(!empty($slider->created_by))
									{{ $slider->createdBy->username }}
									@else
									Not set
									@endif
								</td>
								<td> {{ $slider->description }} </td>
								<td> @if($slider->status===1)Active @else Inactive @endif </td>
								<td>
									<a href=" {{route('slider.edit', $slider->id)}}"><i class="fas fa-edit"></i></a>
									<a href="{{route('slider.show', $slider->id)}}"><i class="fas fa-eye"></i></a>
									<form action="{{ route('slider.destroy') }}" method="POST" onsubmit="return confirm('Please confirm you want to delete! {{$slider->name}}');" style="display: inline-block;">
										@csrf
										<input type="hidden" name="id" value="{{$slider->id}}">
										<button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
									</form>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@stop

<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#sliders').DataTable();
	});
</script>