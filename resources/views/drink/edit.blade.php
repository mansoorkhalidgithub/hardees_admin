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
			<h1 class="h3 mb-0"style="color: black; font-family: serif; font-weight: bold">ADD Drink</h1>
            <a href="{{ route('drink.index') }}"
				class="d-none d-sm-inline-block btn btn-sm  shadow-sm"  style="background-color: #ffc107; color: black"><i
				class="fas fa-fw fa-1x fa-arrow-left fa-sm text-white-300"></i> <span style="font-weight: bold">Drink List</span></a>

		</div>
		<div class="card-body">
			<form role="form" method="post" action="{{route('drink.update',$drink->id)}}">
                @csrf
                @method('PUT')
				<fieldset>
					<div class="row">
    					<div class="col-sm-6">
							<div class="form-group">
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="name">Drink Name</label>

								<input id="drink_name" name="name" value="{{ $drink->name ? $drink->name:old('name') }}"  style="border-radius: 0px" class="form-control " required="" type="text">
								@if ($errors->has('name'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('name') }}</strong>
									</span>
								@endif
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="active">Drink Status</label>
								<select required class="form-control" name="active" style="border-radius: 0px">
									<option value="1" {{$drink->active == 1 ? 'selected' : ''}} > Active </option>
									<option value="0" {{$drink->active == 0 ? 'selected' : ''}}> Not Active </option>
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
                                <option value="{{ $restaurant->id }}" {{ $restaurant->id == $drink->restaurant_id ? 'selected' : '' }} > {{ $restaurant->name?$restaurant->name:old('restaurant') }} </option>
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
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="price">Drink Price</label>

								<input id="drink_price" name="price" value="{{ $drink->update_price?$drink->update_price:old('price') }}"  style="border-radius: 0px" class="form-control " required="" type="text">
								@if ($errors->has('price'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('price') }}</strong>
									</span>
								@endif
								
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="default">Price Status</label>
								<select required class="form-control" name="default" style="border-radius: 0px">
									<option value=" " {{$drink->default == '' ? 'selected' : ''}} > Show Price </option>
									<option value="1" {{$drink->default == '1' ? 'selected' : ''}}> Not Show Price </option>
								</select>
								@if ($errors->has('default'))
									<span class="help-block text-danger">
										<strong>{{ $errors->first('default') }}</strong>
									</span>
								@endif
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="quantity">Quantity</label>

						<input id="drink_quantity" name="quantity" value="{{ $drink->quantity?$drink->quantity:old('quantity') }}"  style="border-radius: 0px" class="form-control " type="text">
						@if ($errors->has('quantity'))
							<span class="help-block text-danger">
								<strong>{{ $errors->first('quantity') }}</strong>
							</span>
						@endif
						
					</div>


					<!-- Button -->
					<div class="form-group text-right" style="margin-top: 1rem">
						<button id="add_category" name="add_category" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">Update Drink</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
@endsection
