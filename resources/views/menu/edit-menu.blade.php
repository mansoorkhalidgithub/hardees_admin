@extends('layouts.main')

@section('title', 'Edit Menu Item')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<style type="text/css">
			.error-coor {
				color: red;
			}
		</style>
		<div class="card">
			<div class="card-body cat-card-body">
				<form role="form" method="post" action="{{ route('update-menu-item') }}" enctype="multipart/form-data">
					@csrf
					<div class="row form-group category-table">
						<div class="col col-6 col-sm-6">
							<select placeholder="" name="menu_category_id" class="form-control" required>

								<option>select category</option>
								@foreach($Categories as $category)
								<option value="{{$category->id}}" {{$menuItem->menu_category_id ==$category->id?'selected':''}}>{{$category->name}}</option>
								@endforeach
							</select>
							@if ($errors->has('menu_category_id'))
							<span class="help-block error-coor">
								{{ $errors->first('menu_category_id') }}
							</span>
							@endif
						</div>
						<div class="col col-6 col-sm-6">
							<input type="hidden" name="menuItemId" value="{{$menuItem->id}}">
							<input type="text" value="{{ $menuItem->name }}" name="name" placeholder="name" class="form-control">
							@if ($errors->has('name'))
							<span class="help-block error-coor">
								{{ $errors->first('name') }}
							</span>
							@endif
						</div>
					</div>
					<div class="row form-group category-table">
						<div class="col col-6 col-sm-6">
							<select placeholder="" name="restaurant_id" placeholder="name" class="form-control" required="">
								<option>Select Restauarant Branch</option>
								@foreach($restaurants as $restaurant)
								<option value="{{$restaurant->id}}" {{$menuItem->restaurant_id ==$restaurant->id?'selected':''}}>{{$restaurant->name}}</option>
								@endforeach
							</select>
							@if ($errors->has('restaurant_id'))
							<span class="help-block error-coor">{{ $errors->first('restaurant_id') }}
							</span>
							@endif
						</div>
						<div class="col col-6 col-sm-6">
							<input type="text" value="{{ $menuItem->price }}" name="price" placeholder="price" class="form-control" required="">
							@if ($errors->has('price'))
							<span class="help-block error-coor">
								{{ $errors->first('price') }}
							</span>
							@endif
						</div>
					</div>
					<div class="row form-group category-table">
						<div class="col col-6 col-sm-6">
							<input type="text" value="{{ $menuItem->quantity }}" name="quantity" placeholder="quantity" class="form-control" required="">
							@if ($errors->has('quantity'))
							<span class="help-block">
								<strong>{{ $errors->first('quantity') }}</strong>
							</span>
							@endif
						</div>
						<div class="col col-6 col-sm-6">
							<input type="text" value="{{ $menuItem->discount }}" name="discount" placeholder="Discount" class="form-control" required="">
							@if ($errors->has('discount'))
							<span class="help-block">
								<strong>{{ $errors->first('discount') }}</strong>
							</span>
							@endif
						</div>
					</div>
					<div class="row form-group category-table">
						<div class="col col-6 col-sm-6">
							<input type="text" value="{{ substr($menuItem->weight, 0, -1)  }}" name="weight" placeholder="weight" class="form-control" required="">
							@if ($errors->has('weight'))
							<span class="help-block">
								<strong>{{ $errors->first('weight') }}</strong>
							</span>
							@endif
						</div>
						<div class="col col-6 col-sm-6">
							<select id="menuitems-status" class="form-control" name="status" aria-invalid="false">
								<option value="">Select Status</option>
								<option value="1">Active</option>
								<option value="0">InActive</option>
							</select>
							@if ($errors->has('status'))
							<span class="help-block">
								<strong>{{ $errors->first('status') }}</strong>
							</span>
							@endif
						</div>
					</div>

					<div class="row form-group category-table">
						<div class="col col-6 col-sm-6">
							<div class="row form-group category-table">
								<div class="col col-12 col-sm-12">
									<label style="text-align: left">Upload Image</label>
								</div>
							</div>

							<div class="row form-group category-table" id="ifYesForImage" style="display: flex;">
								<div class="col col-12 col-sm-12">
									<div class="fileupload fileupload-new" data-provides="fileupload">

										<div class="fileupload-new thumbnail" style="width: 100%">
											<img id="itemImgDisplay" src="{{ asset('/') }}images/ic_gallery.jpg" alt="" style="width: 25%">
										</div>

										<div class="fileupload-preview fileupload-exists" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>

										<div class="cat-select-img-btn">
											<span class="btn btn-theme02 btn-file  sel-img-text">
												<span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
												<!--<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>-->
												<input type="file" value="{{ old('itemImg') }}" id="itemImg" name="itemImg" class="form-control">
												@if ($errors->has('itemImg'))
												<span class="help-block">
													<strong>{{ $errors->first('itemImg') }}</strong>
												</span>
												@endif

											</span>
										</div>

									</div>
								</div>
							</div>
						</div>
						<div class="col col-6 col-sm-6">
							<label>Is Favourite</label> <br />
							<input type="checkbox" id="menuitems-is_favourite" name="is_favourite" checked="{{$menuItem->is_favourite == 1 ? 'checked':''}}" aria-invalid="false">
							@if ($errors->has('is_favourite'))
							<span class="help-block">
								<strong>{{ $errors->first('is_favourite') }}</strong>
							</span>
							@endif
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="card-footer text-right">
	<button type="submit" class="btn btn-success btn-lg"> <i class="fa fa-save"></i> Save</button>
</div>

</form>
</div>
</div>
</div>

</div>
</div>
@stop
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/mapInput.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
<script>
	$(document).ready(function() {
		$.noConflict();

		$("#itemImg").change(function(e) {
			var fileName = e.target.files[0].name;
			//$('#imageLabel').html(fileName);
			readURL(this);
		});
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('itemImgDisplay').src = e.target.result;
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>