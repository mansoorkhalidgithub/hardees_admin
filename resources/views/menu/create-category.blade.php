@extends('layouts.main')

@section('title', 'Menu Item')

@section('content')
<div class="container">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
                <a href="{{ route('menu-categories') }}"
            class="d-none d-sm-inline-block btn btn-sm  shadow-sm"  style="background-color: #ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-white-300"></i> <span style="font-weight: bold">Menu Category List</span></a>
    </div>
    <form role="form" method="post" action="add-category" enctype="multipart/form-data">
                @csrf
<fieldset>

<!-- Form Name -->
<legend style="color: black; font-family: serif; font-weight: bold">ADD NEW MENU CATEGORY</legend>
<hr>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="category_name">CATEGORY NAME</label>

  <input id="category_name" name="name" style="border-radius: 0px" class="form-control " required="" type="text">
@if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

</div>

<!-- Text input-->
<!-- <div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="ingredients">DESCRIPTION</label>

  <input id="description" name="description" style="border-radius: 0px"  class="form-control " required="" type="text">

</div> -->

 <!-- File Button -->
<!-- <div class="form-group">
  <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="category_image">CATEGORY IMAGE</label>
  <br>
  <input id="category_image" class="col-md-4" name="category_image" class="input-file" type="file">

</div> -->

<!-- Button -->
<div class="form-group text-center" style="margin-top: 3rem">

      <button id="add_category" name="add_category" class="btn" style="background-color: #F6BF2D; color: black; width: 70%; font-weight: bold">ADD CATEGORY</button>

  </div>
</fieldset>
</form>
</div>
@stop
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<!-- <script src="{{ asset('admin') }}/dist/js/mapInput.js"></script>
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
</script> -->