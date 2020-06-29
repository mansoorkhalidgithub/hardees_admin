@extends('layouts.main')
@section('content')

<div class="card">
	<div class="card-header">
		{{ $restaurant->name }}
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
							{{ $restaurant->name }}
						</td>
					</tr>
					<tr>
						<th>
							Address
						</th>
						<td>
							{{ $restaurant->address }}
						</td>
					</tr>
					<tr>
						<th>
							Created By
						</th>
						<td>
							{{ $restaurant->createdBy->email }}
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