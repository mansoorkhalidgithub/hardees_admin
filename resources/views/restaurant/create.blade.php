@extends('layouts.main')
@section('title', 'Create Restaurant')
@section('content')

<div style="margin: 0px 10px 10px 10px; padding: 10px">
    <div class="card">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">ADD NEW RESTAURANT</h1>
            <a href="{{ route('restaurants') }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #ffc107; color: black"><i class="fas fa-fw fa-1x fa-arrow-circle-left fa-sm text-dark-300"></i>Restaurant List</a>

        </div>
        <div class="card-body">
            <form role="form" method="post" action="{{ route('save-restaurant') }}" enctype="multipart/form-data">
                @csrf
                <fieldset>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_name">RESTAURANT NAME</label>
                                <input type="text" name="name" value="{{ old('name') }}" style="border-radius: 0px" class="form-control" required="">
                                @if($errors->has('name'))
                                <small class="text-danger ml-2">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_address">RESTAURANT ADDRESS</label>
                                <input type="text" id="address" value="{{ old('address') }}" name="address" style="border-radius: 0px" class="form-control" required="">
                                @if($errors->has('address'))
                                <small class="text-danger ml-2">{{ $errors->first('address') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="latitude">LATITUDE</label>
                                <input type="text" readonly id="latitude" style="border-radius: 0px" name="latitude" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="longitude">LONGITUDE</label>
                                <input type="text" readonly id="longitude" style="border-radius: 0px" name="longitude" class="form-control" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_tags">RESTAURANT TAGS</label>
                                <input type="text" name="tags" value="{{ old('tags') }}" style="border-radius: 0px" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="country">Region</label>
                                <select id="region" name="region_id" style="border-radius: 0px" class="form-control">
                                    <option selected="" disabled="" hidden="">Select Region</option>
                                    @foreach(Helper::getRegions() as $key=> $region)
                                    <option value="{{$region->id}}" value="@if(old('region')) {{ old('region') }} @endif" @if(old('region')) {{ 'selected' }} @endif>{{$region->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('region_id'))
                                <small class="text-danger ml-2">{{ $errors->first('region_id') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="state">STATE</label>

                                <select id="state" name="state_id" style="border-radius: 0px" class="form-control">
                                    <option selected="" disabled="" hidden="">Select State</option>
                                    @foreach(Helper::getStates() as $key=> $state)
                                    <option value="{{$state->id}}" value="@if(old('state_id')) {{ old('state_id') }} @endif" @if(old('state_id')) {{ 'selected' }} @endif>{{$state->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('state_id'))
                                <small class="text-danger ml-2">{{ $errors->first('state_id') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="city">CITY</label>

                                <select id="city" name="city_id" style="border-radius: 0px" class="form-control">
                                    <option selected="" disabled="" hidden="">Select City</option>
                                </select>
                                @if($errors->has('city_id'))
                                <small class="text-danger ml-2">{{ $errors->first('city_id') }}</small>
                                @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="min_order_price">MINIMUM ORDER PRICE</label>

                                <input type="text" class="form-control" style="border-radius: 0px" value="{{ old('min_order_price') }}" name="min_order_price">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="expense_type">EXPENSE TYPE</label>
                                <input type="text" class="form-control" style="border-radius: 0px" value="{{ old('expense_type') }}" name="expense_type">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="currency_symbol">CURRENCY SYMBOL</label>
                                <input type="text" value="{{ old('currency_symbol') }}" name="currency_symbol" style="border-radius: 0px" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="currency_name">CURRENCY NAME</label>
                                <input type="text" value="{{ old('currency_name') }}" name="currency_name" style="border-radius: 0px" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="delivery_charges">DELIVERY CHARGES</label>

                                <input type="text" value="{{ old('delivery_charges') }}" name="delivery_charges" style="border-radius: 0px" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="delivery_charges_km">CHARGES Per KM</label>

                                <input type="text" value="{{ old('delivery_charges_km') }}" name="delivery_charges_km" style="border-radius: 0px" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="payment_method_id">PAYMENT METHOD</label>

                                <select name="payment_methods" id="payment_method_id" style="border-radius: 0px" class="form-control">
                                    <option selected="" disabled="" hidden="">Select Payment Method</option>

                                    @foreach(Helper::getPaymentMethods() as $method)
                                    <option value="{{ $method->id }}"> {{ $method->name }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="category_id">RESTAURANT CATEGORY</label>

                                <select name="category_id" id="category_id" class="form-control" style="border-radius: 0px">
                                    <option selected="" disabled="" hidden="">Select Restaurant Category</option>
                                    @foreach(Helper::getCategories() as $category)
                                    <option value="{{ $category->id }}">{{$category->title}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="delivery_time">ESTIMATED TIME</label>

                                <input type="text" value="{{ old('delivery_time') }}" name="delivery_time" placeholder="in Mins..." style="border-radius: 0px" class="form-control" required="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="contact_number">CONTACT NO.</label>
                                <input type="tel" value="{{ old('contact_number') }}" name="contact_number" style="border-radius: 0px" class="form-control" required="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_category">RESTAURANT CATEGORY</label>
                            </div>
                            <div class="row">
                                <div id="restaurant_categories">
                                </div>
                                <div class="col-sm-11">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="item" name="categories[]" style="border-radius: 0px" placeholder=" e.g 'Hot Deals' ">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning" onclick="restaurantCategories();" type="button"> <i class="fas fa-plus"></i> </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_timing">RESTAURANT TIMINGS</label>
                            </div>
                            <div id="timing_fields">
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="time" style="border-radius: 0px" value="" placeholder="e.g Friday ">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="time" class="form-control" id="time_from" style="border-radius: 0px" value="" placeholder="e.g Friday ">
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="time" class="form-control" id="time_to" style="border-radius: 0px" value="" placeholder="e.g Friday ">
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning" type="button" onclick="timing_fields();"> <i class="fas fa-plus"></i> </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant_image">UPLOAD RESTAURANT IMAGE</label>
                        <br>
                        <input id="logo" class="col-md-4" name="logo" class="input-file" type="file">

                    </div>
                    <hr>
                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-7">
                            <label style="text-align: left">Write Restaurant Credentials</label>
                        </div>
                    </div>

                    <div class="row form-group category-table">

                        <div class="col col-12 col-md-6">
                            <input type="text" name="email" placeholder="Restaurant Email" class="form-control" required="">
                            @if($errors->has('email'))
                            <small class="text-danger ml-2">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                        <div class="col col-12 col-md-6">
                            <input type="password" name="password" placeholder="Restaurant Password" class="form-control" required="">
                            @if($errors->has('password'))
                            <small class="text-danger ml-2">{{ $errors->first('password') }}</small>
                            @endif
                        </div>

                    </div>
                    <hr>
                    <!-- Button -->
                    <div class="form-group text-right" style="margin-top: 1rem">

                        <button id="add_restaurant" name="add_restaurant" class="btn" style="background-color: #F6BF2D; color: black;  font-weight: bold">ADD RESTAURANT</button>

                    </div>
                </fieldset>


            </form>



        </div>
    </div>
</div>
@endsection
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/mapInput.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl-jpsktXKHLD7rFQo9NT3Hfgm16b27C0&libraries=places&callback=initialize" async defer></script>
<script>
    $(document).ready(function() {
        $.noConflict();

        initialize();

        $("#logo").change(function(e) {
            var fileName = e.target.files[0].name;
            //$('#imageLabel').html(fileName);
            readURL(this);
        });

        $("#cover").change(function(e) {
            var fileName = e.target.files[0].name;
            //$('#imageLabel').html(fileName);
            readURLCover(this);
        });
        $("#state").change(function() {
            var id = $(this).val();
            console.log(id)
            $.ajax({
                type: "post",
                url: "{{ URL::route('getCities') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(data) {
                    console.log(data)
                    $('#city').html(data.html);
                }
            });
        });
    });

    function initialize() {

        var options = {
            componentRestrictions: {
                country: "pk"
            }
        };

        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input, options);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            $('#latitude').val(place.geometry['location'].lat());
            $('#longitude').val(place.geometry['location'].lng());
        });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoDisplay').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLCover(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('coverDisplay').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>