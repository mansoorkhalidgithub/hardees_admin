@extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Menu Category List</h3>
             
                <a href="{{ route('brand.create') }}"
                   class="d-none d-sm-inline-block btn btn-sm font-weight-bold shadow-sm" style="background-color: #ffc107; color: black"><i
			class="fas fa-fw fa-1x fa-plus fa-sm text-dark-300"></i>Add New Category</a>
                      
	</div>
	<div class="uper">
		@if(session()->get('success'))
		<div class="alert alert-success">{{ session()->get('success') }}</div>
		@endif
                <table class="table table-striped table-hover" id="menu_category">
			<thead>
				<tr style="color:black">
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th>Status</th>
					<th>Action you can Take</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($brands as $brand)
				<tr>
					<td>{{$brand->id}}</td>
					<td>{{$brand->brand_name}}</td>
					<td>{{$brand->description}}</td>
					<td @if($brand->status == "1")
                                             class="font-weight-bold text-success"
                                             @endif
                                             @if($brand->status == "2")
                                             class="font-weight-bold text-danger"
                                             @endif>{{$brand->status}}</td>
					 
					@if(Auth::user()->role == "admin")
					
                                        <td>
                                             @if($brand->status == "2")
						<form action="{{ route('approved', $brand->id)}}" method="post">
							@csrf @method('POST')
							<button class="btn " style="background-color:  #28a745; color: white"  type="submit">Activate</button>
						</form>
                                             @endif
                                             @if($brand->status == "1")
						<form action="{{ route('rejection', $brand->id)}}" method="post">
							@csrf @method('POST')
							<button class="btn " style="background-color:  #dc3545; color: white" type="submit">Deactivate</button>
						</form>
                                             @endif
					</td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					
					</td>
                                        @endif
				</tr>
				@endforeach
			</tbody>
		</table>
        </div>
                <script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
	$(document).ready(function() {
		$.noConflict();
		var table = $('#menu_category').DataTable();
	});
</script>
		@endsection