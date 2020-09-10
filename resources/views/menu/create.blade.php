@extends('layouts.main')

@section('title', 'Create Product')

@section('content')
<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-body cat-card-body">
                <form role="form" method="post" action="#" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="name" placeholder="Enter Product Name" class="form-control" required="">
                        </div>
                    </div>

                    <div class="row form-group category-table">

                        <div class="col col-12 col-md-6">

                            <input type="text" name="price" placeholder="Enter Price" class="form-control" required="">
                        </div>
                        <div class="col col-12 col-md-6">

                            <input type="text" name="quatity" placeholder="Enter Quantity" class="form-control" required="">
                        </div>
                    </div>


                    <div class="row form-group category-table">
                        <div class="col col-12 col-md-6">
                            <select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Select Category</option>
                                @foreach(Helper::getCategories() as $category)
                                <option value="{{ $category->id }}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col col-12 col-md-6">
                            <select name="category_id" id="category_id" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Select Restaurant</option>
                                @foreach(Helper::getRestaurants() as $restaurant)
                                <option value="{{ $restaurant->id }}">{{$restaurant->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col col-12 col-sm-6">
                        <div class="row form-group category-table">
                            <div class="col col-12 col-sm-12">
                                <label style="text-align: left">Upload Product Image</label>
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