@extends('layouts.main')

@section('title', 'App Slider')

@section('content')
<div class="row">
    <div class="col-sm-12">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div>{{$error}}</div>
        @endforeach
        @endif
        <div class="card">
            <div class="card-body cat-card-body">
                <form role="form" method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <select name="status" class="form-control select2" required>
                                <option selected="selected">Choose Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                            @if($errors->has('status'))
                            <small class="text-danger ml-2">{{ $errors->first('status') }}</small>
                            @endif
                        </div>

                    </div>

                    <!--For entering post tags-->

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <textarea class="form-control" rows="3" name="description" placeholder="Enter ..."></textarea>
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
                                            <img id="sliderDisplay" src="{{ asset('/') }}images/ic_gallery.jpg" alt="" style="width: 25%">
                                        </div>

                                        <div class="fileupload-preview fileupload-exists" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>

                                        <div class="cat-select-img-btn">
                                            <span class="btn btn-theme02 btn-file  sel-img-text">
                                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                                                <!--<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>-->
                                                <input type="file" id="slider" accept="image/*" name="slider" class="default">
                                                @if($errors->has('slider'))
                                                <small class="text-danger ml-2">{{ $errors->first('slider') }}</small>
                                                @endif
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

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('sliderDisplay').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>