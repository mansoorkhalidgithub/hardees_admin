@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
    @if(session()->get('success'))
		<div class="alert alert-success">
		  {{ session()->get('success') }}
		</div><br>
	@endif

	<div class="card">
		<div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0"style="color: black; font-family: serif; font-weight: bold">ADD Extra Pattie</h1>
            <a href="{{ route('pattie.index') }}"
				class="d-none d-sm-inline-block btn btn-sm  shadow-sm"  style="background-color: #ffc107; color: black"><i
				class="fas fa-fw fa-1x fa-arrow-left fa-sm text-white-300"></i> <span style="font-weight: bold">Extra Pattie List</span></a>

		</div>
		<div class="card-body">
			<form role="form" method="post" action="{{route('pattie.update',$extra->id)}}">
                @csrf
                @method('PUT')
				<fieldset>
					<div class="row">
    					<div class="col-sm-6">
							<div class="form-group">
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="name">Extra Pattie</label>

								<input id="extra_name" name="name" value="{{ $extra->name ? $extra->name:old('name') }}"  style="border-radius: 0px" class="form-control " required="" type="text">
								@if ($errors->has('name'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="active">Extra Pattie Status</label>
								<select required class="form-control" name="active" style="border-radius: 0px">
									<option value="1" {{$extra->active == 1 ? 'selected' : ''}} > Active </option>
									<option value="0" {{$extra->active == 0 ? 'selected' : ''}}> Not Active </option>
								</select>
								@if ($errors->has('active'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('active') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</div>

					
					<div class="form-group">
						<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="restaurant">Select Restaurant</label>
						<select required class="form-control" name="restaurant" style="border-radius: 0px">
							@foreach($restaurants as $key => $restaurant)
                                <option value="{{ $restaurant->id }}" {{ $restaurant->id == $extra->restaurant_id ? 'selected' : '' }} > {{ $restaurant->name?$restaurant->name:old('restaurant') }} </option>
                            @endforeach
						</select>
						@if ($errors->has('restaurant'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('restaurant') }}</strong>
							</span>
						@endif
					</div>

					<div class="row">
    					<div class="col-sm-6">
							<div class="form-group">
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="price">Extra Pattie Price</label>

								<input id="extra_price" name="price" value="{{ $extra->price?$extra->price:old('price') }}"  style="border-radius: 0px" class="form-control " required="" type="text">
								@if ($errors->has('price'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('price') }}</strong>
									</span>
								@endif
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="quantity">Quantity</label>

								<input id="extra_quantity" name="quantity" value="{{ $extra->quantity?$extra->quantity:old('quantity') }}"  style="border-radius: 0px" class="form-control " type="text">
								@if ($errors->has('quantity'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('quantity') }}</strong>
									</span>
								@endif
								
							</div>
						</div>
					</div>
					
					<!-- Button -->
					<div class="form-group text-right" style="margin-top: 1rem">
						<button id="add_extra" name="add_extra" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">Update Extra Pattie</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
@endsection
