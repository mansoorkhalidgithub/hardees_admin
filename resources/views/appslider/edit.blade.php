@extends('layouts.main')

@section('title', 'Update Slider Image')

@section('content')
<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-body cat-card-body">
                <form role="form" method="post" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <select name='status' class="form-control select2" data-placeholder="Select a State" style="width: 100%;">
                                <option selected="selected">Choose Status</option>
                                <option value="1" {{ ( $model->status == 1) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ ( $model->status == 0) ? 'selected' : '' }}>InActive</option>
                            </select>
                        </div>
                    </div>

                    <!--For entering post tags-->

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter Description ">{{$model->description}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-12 col-sm-12">
                            <div class="row form-group category-table">
                                <div class="col col-12 col-sm-12">
                                    <label style="text-align: left">Upload Slider Image</label>
                                </div>
                            </div>

                            <div class="row form-group category-table" id="ifYesForImage" style="display: flex;">
                                <div class="col col-12 col-sm-12">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="fileupload-new thumbnail" style="width: 100%">
                                            <img id="sliderDisplay" src="{{ ($model->slider_img) ? asset($model->slider_img) : asset('/images/ic_gallery.jpg') }}" alt="" style="width: 25%">
                                        </div>

                                        <div class="fileupload-preview fileupload-exists" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>

                                        <div class="cat-select-img-btn">
                                            <span class="btn btn-theme02 btn-file  sel-img-text">
                                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                                                <!--<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>-->
                                                <input type="file" id="slider" accept="image/*" name="slider" class="default">
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

        $("#slider").change(function(e) {
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
                document.getElementById('sliderDisplay').src = e.target.result;
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