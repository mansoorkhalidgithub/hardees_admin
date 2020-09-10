 @extends('layouts.main') @section('content')

<div  style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 style="color: black; font-family: serif; font-weight: bold">Menu List</h3>
                
                <a href="{{ route('product.create') }}"
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
                                        <th>Sr. #</th>
					<th>Name</th>
					<th>Menu Category</th>
					<th>Price</th>
					<th>Status</th>
					<th>Action</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $item)
				<tr>
                                        <td>{{$item->id}}</td>
					<td>{{$item->name}}</td>
					<td>{{$item->brand_id}}</td>
					<td>{{$item->price}}</td>
					<td @if($item->status == "1")
                                             class="font-weight-bold text-success"
                                             @endif
                                             @if($item->status == "2")
                                             class="font-weight-bold text-danger"
                                             @endif>{{$item->status}}</td>
                                        <td>
                                             @if($item->status == "2")
						<form action="{{ route('activate', $item->id)}}" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #28a745; color: white" type="submit">Activate</button>
						</form>
                                             @endif
                                             @if($item->status == "1")
						<form action="{{ route('deactivate', $item->id)}}" method="post">
							@csrf @method('POST')
							<button class="btn" style="background-color:  #dc3545; color: white" type="submit">Deactivate</button>
						</form>
                                             @endif
					</td>
                                        <td>
                                            <a href="#" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                                            <a href="#" style="background-color: #F6BF2D;" class="d-none d-sm-inline btn btn-sm shadow-sm" title="Delete"><i class="fas fa-trash-alt" style="color: #dc3545"></i></a>
					
					</td>
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