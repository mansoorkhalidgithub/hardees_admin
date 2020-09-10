@extends('layouts.main')
@section('title', 'App Slider')
@section('content')

<div class="card">
	<div class="card-header">
		@yield('title')
	</div>

	<div class="card-body">
		<div class="mb-2">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<th>
							Slider Image
						</th>
						<td>
							<img src="{{ asset($model->slider_img) }}" alt="" height=100 width=100>
						</td>
					</tr>
					<tr>
						<th>
							Created By
						</th>
						<td>
							{{ $model->description }}
						</td>
					</tr>
					<tr>
						<th>
							Description
						</th>
						<td>
							{{ $model->description }}
						</td>
					</tr>


				</tbody>
			</table>
			<a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
				Back To List
			</a>
		</div>


	</div>
</div>
@endsection