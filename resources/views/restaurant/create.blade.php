@extends('layouts.main')

@section('title', 'Create Restaurant')

@section('content')
<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-body cat-card-body">
                <form role="form" method="post" action="{{ route('save-restaurant') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="name" placeholder="Enter Restuarant Name" class="form-control" required="">
                        </div>
                    </div>

                    <!--For entering post tags-->

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="tags" placeholder="Enter Restaurant Tags..." class="form-control" required="">
                        </div>
                    </div>

                    <!--For entering address-->

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" id="address" name="address" placeholder="Write Restaurant Address" class="form-control" required="">
                        </div>
                    </div>

                    <div class="row form-group category-table">

                        <div class="col col-12 col-md-6">
                            <!--<label>No of People Serving</label>-->
                            <input type="text" readonly id="latitude" name="latitude" placeholder="Enter Restaurant Latitude" class="form-control" required="">
                        </div>
                        <div class="col col-12 col-md-6">
                            <!--<label>Difficulty Level</label>-->
                            <input type="text" readonly id="longitude" name="longitude" placeholder="Enter Restaurant Longitude" class="form-control" required="">
                        </div>
                    </div>
                    <div class="row form-group category-table">
                        <div class="col col-12 col-md-6">
                            <!--<label>Min. Order Price</label>-->
                            <input type="text" class="form-control" name="min_order_price" placeholder="Min. Order Price">
                        </div>
                        <div class="col col-12 col-md-6">
                            <!--<label>Expense Type</label>-->
                            <input type="text" class="form-control" name="expense_type" placeholder="Expense Type">
                        </div>

                    </div>

                    <div class="row form-group category-table">

                        <div class="col col-12 col-md-6">
                            <!--<label>No of People Serving</label>-->
                            <input type="text" name="currency_symbol" placeholder="Currency Symbol e.g $" class="form-control">
                        </div>
                        <div class="col col-12 col-md-6">
                            <!--<label>Difficulty Level</label>-->
                            <input type="text" name="currency_name" placeholder="Currency Name e.g usd" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group category-table">

                        <div class="col col-12 col-md-6">
                            <!--<label>No of People Serving</label>-->
                            <input type="text" name="delivery_charges" placeholder="Delivery Charges e.g 100" class="form-control" required="">
                        </div>
                        <div class="col col-12 col-md-6">
                            <!--<label>Difficulty Level</label>-->
                            <input type="text" name="delivery_charges_km" placeholder="Charges per Km e.g 1 " class="form-control">
                        </div>
                    </div>

                    <div class="row form-group category-table">
                        <div class="col col-12 col-md-6">
                            <select name="payment_method_id" id="payment_method_id" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Select Payment Method</option>
                                @foreach(Helper::getPaymentMethods() as $method)
                                <option value="{{ $method->id }}"> {{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col col-12 col-md-6">
                            <select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Select Restaurant Category</option>
                                @foreach(Helper::getCategories() as $category)
                                <option value="{{ $category->id }}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row form-group category-table">

                        <div class="col col-12 col-md-6">
                            <!--<label>No of People Serving</label>-->
                            <input type="text" name="delivery_time" placeholder="45 min" class="form-control" required="">
                        </div>
						
						<div class="col col-12 col-md-6">
                            <!--<label>No of People Serving</label>-->
                            <input type="text" name="contact_number" placeholder="Contact Number" class="form-control" required="">
                        </div>

                    </div>

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <label style="text-align: left">Write Restaurant Categories </label>
                        </div>
                    </div>

                    <div id="restaurant_categories">
                    </div>

                    <div class="row form-group category-table">
                        <div class="col-sm-11">
                            <div class="form-group">
                                <input type="text" class="form-control" id="item" value="" placeholder="Restaurant Categories e.g 'Hot Deals' ">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="input-group-btn">
                                <button class="btn btn-success" onclick="restaurantCategories();" type="button"> <i class="fas fa-plus"></i> </button>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-4">
                            <label style="text-align: left">Write Restaurant Timings </label>
                        </div>
                    </div>

                    <div id="timing_fields">
                    </div>

                    <div class="row form-group category-table">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text" class="form-control" id="time" value="" placeholder="e.g Friday ">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="time" class="form-control" id="time_from" value="" placeholder="e.g Friday ">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="time" class="form-control" id="time_to" value="" placeholder="e.g Friday ">
                            </div>
                        </div>

                        <div class="col-sm-1">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button" onclick="timing_fields();"> <i class="fas fa-plus"></i> </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-12 col-sm-6">
                            <div class="row form-group category-table">
                                <div class="col col-12 col-sm-12">
                                    <label style="text-align: left">Upload Restaurant Logo</label>
                                </div>
                            </div>

                            <div class="row form-group category-table" id="ifYesForImage" style="display: flex;">
                                <div class="col col-12 col-sm-12">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="fileupload-new thumbnail" style="width: 100%">
                                            <img id="logoDisplay" src="{{ asset('/') }}images/ic_gallery.jpg" alt="" style="width: 25%">
                                        </div>

                                        <div class="fileupload-preview fileupload-exists" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>

                                        <div class="cat-select-img-btn">
                                            <span class="btn btn-theme02 btn-file  sel-img-text">
                                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                                                <!--<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>-->
                                                <input type="file" id="logo" accept="image/*" name="logo" class="default">
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-12 col-sm-6">
                            <div class="row form-group category-table">
                                <div class="col col-12 col-sm-12">
                                    <label style="text-align: left">Upload Restaurant Cover</label>
                                </div>
                            </div>

                            <div class="row form-group category-table" id="ifYesForVideo" style="display: flex;">

                                <div class="col col-12 col-sm-12">

                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="fileupload-new thumbnail" style="width: 100%">
                                            <img id="coverDisplay" src="{{ asset('/') }}images/ic_gallery.jpg" alt="" style="width: 25%">
                                        </div>

                                        <div class="fileupload-preview fileupload-exists " style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;"></div>

                                        <div class="cat-select-img-btn">
                                            <span class="btn btn-theme02 btn-file  sel-img-text">
                                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                                                <!--<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>-->
                                                <input type="file" id="cover" accept="image/*" name="cover" class="default">

                                            </span>

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
@stop
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/mapInput.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
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