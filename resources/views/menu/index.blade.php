 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Menu List</h3>
		@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
				@endif
                <a href="{{ route('create-menu-item') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Menu</a>

	</div>
	<div class="uper">
		@if(session()->get('success'))
		<div class="alert alert-success">{{ session()->get('success') }}</div>
		@endif

                <!-- Admin Role on Product List -->


                <table class="table table-striped table-hover" id="menu_list">
			<thead>
				<tr style="color:black">
                          <th scope="col">ID</th>
								<th scope="col">Name</th>
								<th scope="col"> Menu Category </th>
								<th scope="col">Restaurant</th>
								<th scope="col">Created By</th>
								<th scope="col">Price</th>
								<th scope="col">Discount</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($model as $key => $item)
							<tr>
								<th scope="row"> {{ ++$key }} </th>
								<td> {{ $item->name }} </td>
								<td> {{ $item->category->name }} </td>
								<td>
									@if(!empty($item->restaurant_id))
									{{ $item->getRestaurant->name }}
									@else
									Not set
									@endif
								</td>
								<td>
									@if(!empty($item->created_by))
									{{ $item->createdBy->username }}
									@else
									Not set
									@endif
								</td>
								<td> {{ $item->price }} </td>
								<td> {{ $item->discount }} </td>
								<td>
									@if($item->status == 1)
									<button class="btn" style="background-color:  #28a745;cursor: auto; color: white" type="submit">Activate</button>
									@else
				<button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactivate</button>
									 @endif

									</td>
								<td>


									 <a href="edit-menu/{{$item->id}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;cursor: pointer;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>



	<!-- 							 <a href="edit-menu/{{$item->id}}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a> -->
									<a href="show-menu-item/{{$item->id}}" class="btn  btn-sm"><i class="fas fa-eye"></a></i></td>
							</tr>
							@endforeach

                                        </tbody>
		</table>

        </div>
</div>
<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#menu_list').DataTable();
	});
</script>

		@endsection