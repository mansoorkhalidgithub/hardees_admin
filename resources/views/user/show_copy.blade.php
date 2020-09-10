@extends('layouts.main')

@section('title', $title)

@section('content')

<div class="card">
	<div class="card-header">
		{{ $model->first_name }} {{$model->last_name}}
	</div>

	<div class="card-body">
		<div class="mb-2">
			<table class="table table-bordered table-striped">
				<tbody>
					<tr>
						<th>
							Name
						</th>
						<td>
							{{ $model->first_name }} {{$model->last_name}}
						</td>
					</tr>
					<tr>
						<th>
							Email
						</th>
						<td>
							{{ $model->email }}
						</td>
					</tr>
					<tr>
						<th>
							Phone Number
						</th>
						<td>
							{{ $model->phone_number }}
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