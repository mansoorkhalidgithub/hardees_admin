@extends('layouts.main')
@section('title', 'Menu Item')
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
							Menu Image
						</th>
						<td>
							<img src="{{ asset($model->image) }}" alt="" height=100 width=100>
						</td>
					</tr>
					<tr>
						<th>
							Created By
						</th>
						<td>
							{{$model->createdBY->username}}
						</td>
					</tr>
					@if($model->ingredients)
					<tr>
						<th>
							Ingredients
						</th>



						<td>

							@foreach ($model->ingredients as $item)
							{{ $item.',' }}
							@endforeach
						</td>

					</tr>
					@endif


				</tbody>
			</table>
			<a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
				Back To List
			</a>
		</div>


	</div>
</div>
@endsection