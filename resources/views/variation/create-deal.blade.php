@extends('layouts.form')

@section('title', 'Add Variation')

@section('content')
<div style="margin: 0px 10px 10px 10px">
<style>
    .input_border{border-radius: 0px}
    .label-info{
        background: #5bc0de;
    padding: 2px 5px;
    border-radius: 3px;
}
.bootstrap-tagsinput {

    width: 100%;
  background-color: #fff;
  border: 1px solid #ccc;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  display: inline-block;
   border-radius: 0px;
    padding: 7px;
  color: #555;
  vertical-align: middle;
  max-width: 100%;
  line-height: 22px;
  cursor: text;
}
.bootstrap-tagsinput input {
  border: none;
  box-shadow: none;
  outline: none;
  background-color: transparent;
  padding: 0 6px;
  margin: 0;
  width: auto;
  max-width: inherit;
}
.bootstrap-tagsinput.form-control input::-moz-placeholder {
  color: #777;
  opacity: 1;
}
.bootstrap-tagsinput.form-control input:-ms-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput.form-control input::-webkit-input-placeholder {
  color: #777;
}
.bootstrap-tagsinput input:focus {
  border: none;
  box-shadow: none;
}
.bootstrap-tagsinput .tag {
  margin-right: 2px;
  color: white;
}
.bootstrap-tagsinput .tag [data-role="remove"] {
  margin-left: 8px;
  cursor: pointer;
}
.bootstrap-tagsinput .tag [data-role="remove"]:after {
  content: "x";
  padding: 0px 2px;
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
.bootstrap-tagsinput .tag [data-role="remove"]:hover:active {
  box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
}
.hidden{
	display: none;
}
</style>


<div class="card">
	<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold"> {{ $item->name }} </h1>
					<a href="{{ route('menu') }}"
					   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
							class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Menu List</span></a>

	</div>
	<div class="card-body">
		<form role="form" method="post" action="save-variation" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="item_id" value="{{ $item->id }}">
			@foreach($menuCategories as $key => $category)
				@if(count($category->menuItems) > 0)
				<div class="row">
					
					<div class="col-md-12">
						<h4> {{ $category->name }} </h4>
					</div>
					
				</div>
				
				<hr>
				
					<div class="row">
						
							@foreach($category->menuItems as $item)
							<div class="col-md-2">
								<div class="form-group">
									<input type="checkbox" id="deal_item[{{ $item->id }}]" name="deal_item[]" value="{{ $item->id }}">
									<label  style="color: black; font-size: 12px; font-weight: 700"> {{ $item->name }} </label> 
								</div>
							</div>
							@endforeach
						
					</div><br>
				@endif
			@endforeach
			
			@foreach($menuCategories as $key => $category)
				@if(count($category->menuItems) > 0)
				<div class="row">
					
					<div class="col-md-12">
						<h4> {{ $category->name }} </h4>
					</div>
					
				</div>
				
				<hr>
				
					<div class="row">
						
							@foreach($category->menuItems as $item)
							<div class="col-md-2">
								<div class="form-group">
									<input type="checkbox" id="deal_item[{{ $item->id }}]" name="deal_item[]" value="{{ $item->id }}">
									<label  style="color: black; font-size: 12px; font-weight: 700"> {{ $item->name }} </label> 
								</div>
							</div>
							@endforeach
						
					</div><br>
				@endif
			@endforeach
			
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<button type="button" onclick="newAddon();" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold"> <i class="fa fa-plus"></i> Addon </button>
                    </div>
				</div>
			</div>
			<div id="addon-container">
				
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group pull-right">
						<button type="submit" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold"> Submit </button>
                    </div>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>
	//$(document).ready(function() {
			$('#drinks').click(function() {
				if($(this).is(":checked")){
					$(this).val(1);
					$("#drinks-container").removeClass('hidden');
				} else {
					$(this).val(0);
					$("#drinks-container").addClass('hidden');
				}
			});
			$('#sides').click(function() {
				if($(this).is(":checked")){
					$(this).val(1);
					$("#side-container").removeClass('hidden');
				} else {
					$(this).val(0);
					$("#side-container").addClass('hidden');
				}
			});
			$('#extras').click(function() {
				if($(this).is(":checked")){
					$(this).val(1);
					$("#extra-container").removeClass('hidden');
				} else {
					$(this).val(0);
					$("#extra-container").addClass('hidden');
				}
			});
	//});
	
	var addonId = 0;
	function newAddon()
	{
		addonId++;
		var newAddon = '<div style="margin-top: 10px" id="row-'+ addonId +'" class="row">'+
					'<div class="col-md-6">'+
						'<input type="text" required name="names[]" class="form-control" placeholder="Enter Addon Name">'+
					'</div>'+
					'<div class="col-md-5">'+
						'<input type="text" required name="prices[]" class="form-control" placeholder="Enter Addon Price">'+
					'</div>'+
					'<div class="col-md-1">'+
						'<div class="input-group-btn">'+
							'<button class="btn btn-warning" onclick="removeAddon('+ addonId +');" type="button"> <i class="fas fa-minus"></i> </button>'+
						'</div>'+
					'</div>'+
				'</div>';
				
		$("#addon-container").append(newAddon);
	}
	
	function removeAddon(rowId) {
		$("#row-"+rowId).remove();
	}
</script>
@stop